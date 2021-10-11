<?php
/**
 * The model file of workflowdatasource module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflow
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
class workflowdatasourceModel extends model
{
    /**
     * Get modules of an app.
     *
     * @param  string $app
     * @access public
     * @return array
     */
    public function getAppModules($app)
    {
        $modules = array('');
        if(!$app) return $modules;

        if(isset($this->config->workflowdatasource->modules[$app]) && is_array($this->config->workflowdatasource->modules[$app]))
        {
            foreach($this->config->workflowdatasource->modules[$app] as $module)
            {
                $this->app->loadLang($module, $app);
                $modules[$module] = isset($this->lang->$module->common) ? $this->lang->$module->common : $module;
            }
        }
        return $modules;
    }

    /**
     * Get methods of a module in an app.
     *
     * @param  string $app
     * @param  string $module
     * @access public
     * @return array
     */
    public function getModuleMethods($app, $module)
    {
        $methods = array('');
        if(!$app) return $methods;

        if(isset($this->config->workflowdatasource->methods[$app][$module]) && is_array($this->config->workflowdatasource->methods[$app][$module]))
        {
            foreach($this->config->workflowdatasource->methods[$app][$module] as $method)
            {
                $methods[$method] = $method;
            }
        }
        return $methods;
    }

    /**
     * Get comments of a method.
     *
     * @param  string $app
     * @param  string $module
     * @param  string $method
     * @param  int    $methodDescOnly
     * @access public
     * @return array
     */
    public function getMethodComments($app, $module, $method, $methodDescOnly = false)
    {
        $model = $this->loadModel($module, $app);
        $methodReflect = new ReflectionMethod($model, $method);
        $comment = $methodReflect->getDocComment();

        /* Strip the opening and closing tags of the docblock. */
        $comment = substr($comment, 3, -2);

        /* Split into arrays of lines. */
        $comment = preg_split('/\r?\n\r?/', $comment);

        /* Group the lines together by @tags */
        $blocks = array();
        $b = -1;
        foreach ($comment as $line)
        {
            /* Trim asterisks and whitespace from the beginning and whitespace from the end of lines. */
            $line = ltrim(rtrim($line), "* \t\n\r\0\x0B");
            if (isset($line[1]) && $line[0] == '@' && ctype_alpha($line[1]))
            {
                $b++;
                $blocks[] = array();
            } else if($b == -1) {
                $b = 0;
                $blocks[] = array();
            }
            $blocks[$b][] = $line;
        }

        $result = array();
        /* Parse the blocks */
        foreach ($blocks as $block => $body)
        {
            $body = trim(implode("\n", $body));
            if($block == 0 && !(isset($body[1]) && $body[0] == '@' && ctype_alpha($body[1])))
            {
                /* This is the description block */
                if($methodDescOnly) return $body;

                $result['desc'] = $body;
                continue;
            }
            else
            {
                /* This block is tagged */
                if(preg_match('/^@[a-z0-9_]+/', $body, $matches))
                {
                    $tag  = substr($matches[0], 1);
                    $body = substr($body, strlen($tag)+2);
                    if($tag == 'param')
                    {
                        $parts          = preg_split('/\s+/', trim($body), 3);
                        $parts          = array_pad($parts, 3, null);
                        $property       = array('type', 'var', 'desc');
                        $param          = array_combine($property, $parts);
                        $param['var']   = substr($param['var'], 1);
                        $result['param'][$param['var']] = $param;
                    }
                    else
                    {
                        $result[$tag][] = $body;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Get default params of a method.
     *
     * @param  string $app
     * @param  string $module
     * @param  string $method
     * @access public
     * @return array
     */
    public function getDefaultParams($app, $module, $method)
    {
        $params = array();

        $defaultValueFiles = glob($this->app->getTmpRoot() . "defaultvalue/*.php");
        if($defaultValueFiles) foreach($defaultValueFiles as $file) include $file;

        $model = $this->loadModel($module, $app);
        $methodReflect = new reflectionMethod($model, $method);

        foreach($methodReflect->getParameters() as $param)
        {
            $name    = $param->getName();
            $default = '';
            if(isset($paramDefaultValue[$app][$module][$method][$name]))
            {
                $default = $paramDefaultValue[$app][$module][$method][$name];
            }
            elseif($param->isDefaultValueAvailable())
            {
                $default = $param->getDefaultValue();
            }
            $params[$name] = $default;
        }
        return $params;
    }

    /**
     * Get a datasource by id.
     *
     * @param  int    $id
     * @access public
     * @return objcet
     */
    public function getByID($id)
    {
        $datasource = $this->dao->select('*')->from(TABLE_WORKFLOWDATASOURCE)->where('id')->eq($id)->fetch();
        if($datasource)
        {
            $datasource->options = array();
            $datasource->app        = '';
            $datasource->module     = '';
            $datasource->method     = '';
            $datasource->methodDesc = '';
            $datasource->params     = array();
            $datasource->sql        = '';
            $datasource->lang       = '';

            if($datasource->type == 'option')
            {
                $datasource->options = json_decode($datasource->datasource, true);
            }
            elseif($datasource->type == 'system')
            {
                $data = json_decode($datasource->datasource);
                $datasource->app        = $data->app;
                $datasource->module     = $data->module;
                $datasource->method     = $data->method;
                $datasource->methodDesc = $data->methodDesc;
                $datasource->params     = $data->params;
            }
            elseif($datasource->type == 'sql')
            {
                $datasource->sql = $datasource->datasource;
            }
            elseif($datasource->type == 'lang')
            {
                $datasource->lang = $datasource->datasource;
            }
            elseif($datasource->type == 'func')
            {
            }
        }
        return $datasource;
    }

    /**
     * Get datasource list.
     *
     * @param  string $orderBy
     * @param  objcet $pager
     * @access public
     * @return array
     */
    public function getList($orderBy = 'id_desc', $pager = null)
    {
        return $this->dao->select('*')->from(TABLE_WORKFLOWDATASOURCE)->orderBy($orderBy)->page($pager)->fetchAll();
    }

    /**
     * Get datasource pairs.
     *
     * @param  string $params
     * @access public
     * @return array
     */
    public function getPairs($params = '')
    {
        $datasources = $this->dao->select('id, name')->from(TABLE_WORKFLOWDATASOURCE)->fetchPairs();

        foreach($this->lang->workflowdatasource->default->options as $key => $name) $datasources[$key] = $name;

        if(strpos($params, 'noempty') === false) $datasources = array('' => '') + $datasources;

        return $datasources;
    }

    /**
     * Create a datasource.
     *
     * @access public
     * @return int
     */
    public function create()
    {
        $datasource = fixer::input('post')
            ->setDefault('datasource', '')
            ->add('createdBy', $this->app->user->account)
            ->add('createdDate', helper::now())
            ->skipSpecial('sql')
            ->get();

        $result = $this->fix($datasource);
        if(!empty($result))
        {
            dao::$errors = $result;
            return;
        }

        $this->dao->insert(TABLE_WORKFLOWDATASOURCE)->data($datasource, $skip = 'options, app, module, method, methodDesc, paramName, paramType, paramDesc, paramValue, sql, lang')
            ->autoCheck()
            ->check('datasource', 'notempty')
            ->exec();

        return $this->dao->lastInsertId();
    }

    /**
     * Update a datasource.
     *
     * @param  int    $id
     * @access public
     * @return array
     */
    public function update($id)
    {
        $oldDatasource = $this->getByID($id);

        $datasource = fixer::input('post')
            ->setDefault('datasource', '')
            ->add('editedBy', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->skipSpecial('sql')
            ->get();

        $result = $this->fix($datasource);
        if(!empty($result))
        {
            dao::$errors = $result;
            return;
        }

        $this->dao->update(TABLE_WORKFLOWDATASOURCE)->data($datasource, $skip = 'options, app, module, method, methodDesc, paramName, paramType, paramDesc, paramValue, sql, lang')
            ->where('id')->eq($id)
            ->autoCheck()
            ->check('datasource', 'notempty')
            ->exec();

        unset($oldDatasource->options);
        unset($datasource->options);

        return commonModel::createChanges($oldDatasource, $datasource);
    }

    /**
     * Fix a datasource.
     *
     * @param  object $datasource
     * @access public
     * @return array
     */
    public function fix($datasource = object)
    {
        $errors = array();

        if(!$datasource->name) $errors['name'] = sprintf($this->lang->error->notempty, $this->lang->workflowdatasource->name);
        if($datasource->type == 'option')
        {
            $options = array();
            foreach($datasource->options['value'] as $key => $value)
            {
                if(empty($value)) continue;
                if(empty($datasource->options['text'][$key])) continue;

                $options[$value] = $datasource->options['text'][$key];
            }

            if(empty($options)) $errors['options'] = $this->lang->workflowdatasource->error->emptyOptions;

            $datasource->datasource = helper::jsonEncode($options);
        }
        elseif($datasource->type == 'system')
        {
            if(!$datasource->method) $errors['method'] = sprintf($this->lang->error->notempty, $this->lang->workflowdatasource->method);
            if(!$datasource->module) $errors['module'] = sprintf($this->lang->error->notempty, $this->lang->workflowdatasource->module);
            if(!$datasource->app)    $errors['app']    = sprintf($this->lang->error->notempty, $this->lang->workflowdatasource->app);

            $params = array();
            if($this->post->paramName)
            {
                foreach($this->post->paramName as $key => $name)
                {
                    $param = new stdclass();
                    $param->name  = $name;
                    $param->type  = $this->post->paramType[$key];
                    $param->desc  = $this->post->paramDesc[$key];
                    $param->value = $this->post->paramValue[$key];

                    $params[$key] = $param;
                }
            }

            $data = new stdclass();
            $data->app        = $datasource->app;
            $data->module     = $datasource->module;
            $data->method     = $datasource->method;
            $data->methodDesc = $datasource->methodDesc;
            $data->params     = $params;

            $datasource->datasource = helper::jsonEncode($data);
        }
        elseif($datasource->type == 'sql')
        {
            if(!$datasource->sql)
            {
                $errors['sql'] = sprintf($this->lang->error->notempty, $this->lang->workflowdatasource->sql);
            }
            else
            {
                $result = $this->loadModel('workflowfield', 'flow')->checkSqlAndVars($datasource->sql);
                if($result !== true) $errors['sql'] = $result;

                $datasource->datasource = $datasource->sql;
            }
        }
        elseif($datasource->type == 'lang')
        {
            $datasource->datasource = $datasource->lang;
        }
        elseif($datasource->type == 'func')
        {
        }

        return $errors;
    }
}
