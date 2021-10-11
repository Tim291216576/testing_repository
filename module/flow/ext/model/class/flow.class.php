<?php
class flowFlow extends flowModel
{
    /**
     * Construct for get not empty rule.
     * 
     * @param  string $appName 
     * @access public
     * @return void
     */
    public function __construct($appName = '')
    {
        parent::__construct($appName);
        $this->notEmptyRule = $this->loadModel('workflowrule')->getByTypeAndRule('system', 'notempty');
    }

    /**
     * Get menu of a flow.
     *
     * @param  object $flow
     * @param  array  $labels
     * @access public
     * @return void
     */
    public function getModuleMenu($flow, $labels)
    {
        if($flow->navigator == 'primary' && isset($this->lang->{$flow->module}->menu)) $this->lang->flow->menu = $this->lang->{$flow->module}->menu;
        if($flow->navigator == 'secondary' && isset($this->lang->{$flow->app}->menu))  $this->lang->flow->menu = $this->lang->{$flow->app}->menu;
        return false;
    }

    /**
     * Post data of a flow.
     *
     * @param  object $flow
     * @param  object $action
     * @param  int    $dataID
     * @param  string $prevModule
     * @access public
     * @return array
     */
    public function post($flow, $action, $dataID = 0, $prevModule = '')
    {
        $result = parent::post($flow, $action, $dataID, $prevModule);

        if(isset($result['result']) and $result['result'] == 'success' && $action->open == 'modal' && helper::isAjaxRequest())
        {
            $result['locate'] = 'parent';
        }
        elseif(isset($result['result']) and $result['result'] == 'success' && $flow->buildin == 1)
        {
            if($dataID > 0)
            {
                $result['locate'] = helper::createLink($flow->module, 'view', "id={$dataID}");
            }
            elseif($flow->module == 'story' or $flow->module == 'task')
            {
                $locate = $flow->module == 'story' ? helper::createLink('product', 'browse') : helper::createLink('project', 'browse');
            }
        }

        return $result;
    }

    /**
     * Print workflow defined fields for view and form page.
     * 
     * @param  string $moduleName 
     * @param  string $methodName 
     * @param  object $object       bug | build | feedback | product | productplan | project | release | story | task | testcase | testsuite | testtask
     * @param  string $type         The parent component which fileds displayed in. It should be table or div.
     * @param  string $extras       The extra params.
     *                              columns=1|2|3|5         Number of the columns merged to display the fields. The default is 1.
     *                              position=left|right     The position which the fields displayed in a page.
     *                              inForm=0|1              The fields displayed in a form or not. The default is 1.
     *                              inCell=0|1              The fields displayed in a div with class cell or not. The default is 0.
     * @access public
     * @return string
     */
    public function printFields($moduleName, $methodName, $object, $type, $extras = '')
    {
        $action = $this->loadModel('workflowaction')->getByModuleAndAction($moduleName, $methodName);
        if(empty($action) or $action->extensionType == 'none') return null;

        parse_str(str_replace(array(',', ' '), array('&', ''), $extras), $params);

        $function = "printFieldsIn" . $type;
        $fields   = $this->workflowaction->getFields($moduleName, $methodName);
        $layouts  = $this->loadModel('workflowlayout')->getFields($moduleName, $methodName);

        $allFields = $this->dao->select('*')->from(TABLE_WORKFLOWFIELD)->where('module')->eq($moduleName)->fetchAll('field');
        foreach($fields as $fieldName => $field)
        {
            if(isset($allFields[$fieldName])) $field->default = $allFields[$fieldName]->default;
        }

        $html = $this->$function($object, $layouts, $fields, $params);
        if($action->linkages) $html .= $this->getLinkageScript($action, $fields);

        return $html;
    }

    /**
     * Print fields in table.
     * 
     * @param  object   $object 
     * @param  array    $layouts 
     * @param  array    $fields
     * @param  array    $params
     * @access public
     * @return string
     */
    public function printFieldsInTable($object, $layouts, $fields, $params = '')
    {
        $html    = '';
        $columns = zget($params, 'columns', 1);
        $inForm  = zget($params, 'inForm', 1);
        $colspan = $columns > 1 ? "colspan='$columns'" : '';

        if(!is_object($object)) $object = (object)$object;
        if(!$object) $object = new stdclass();

        foreach($fields as $field)
        {
            if($field->buildin or !$field->show or !isset($layouts[$field->field])) continue;

            if($field->default and empty($field->defaultValue)) $field->defaultValue = $field->default;
            if(empty($object->{$field->field})) $object->{$field->field} = $field->defaultValue;

            $require = '';
            if($inForm && !$field->readonly && $this->notEmptyRule && strpos(",$field->rules,", ",{$this->notEmptyRule->id},") !== false) $require = "class='required'";

            if(($field->control == 'textarea' or $field->control == 'richtext') and empty($colspan) and $inForm) $colspan = "colspan='2'";

            $content = $inForm ? $this->getFieldControl($field, $object) : $this->getFieldValue($field, $object);
            $html .= "<tr><th>{$field->name}</th>"; 
            $html .= "<td $colspan $require>{$content}</td></tr>"; 
        }

        return $html;
    }

    /**
     * Print fields in div.
     * 
     * @param  object $object 
     * @param  array  $layouts 
     * @param  array  $fields 
     * @param  array  $params 
     * @access public
     * @return string
     */
    public function printFieldsInDiv($object, $layouts, $fields, $params = '')
    {
        $html     = '';
        $position = zget($params, 'position', 'right');
        $inCell   = zget($params, 'inCell', 0);
        $inForm   = zget($params, 'inForm', 1);

        if($position == 'right')
        {
            if($inCell) $html .= "<div class='cell'>"; 

            $html .= "<div class='detail'>"; 
            $html .= "<div class='detail-title'>{$this->lang->extInfo}</div>"; 
            $html .= $inCell ? "<table class='table table-data'>" : "<table class='table table-form'>"; 

            $tableContent = '';
            foreach($fields as $field)
            {
                if($field->buildin or !$field->show or !isset($layouts[$field->field]) or $field->position != 'basic') continue;

                $require = '';
                if($inForm && !$field->readonly && $this->notEmptyRule && strpos(",$field->rules,", ",{$this->notEmptyRule->id},") !== false) $require = "class='required'";

                $content = $inForm ? $this->getFieldControl($field, $object) : $this->getFieldValue($field, $object);

                $tableContent .= "<tr><th class='thWidth'>{$field->name}</th>"; 
                $tableContent .= "<td $require>{$content}</td></tr>"; 
            }

            if(!$tableContent) return false;

            $html .= $tableContent;
            $html .= '</table>'; 
            $html .= '</div>'; 

            if($inCell) $html .= '</div>'; 
        }

        if($position == 'left')
        {
            foreach($fields as $field)
            {
                if($field->buildin or !$field->show or !isset($layouts[$field->field]) or $field->position != 'info') continue;

                $require = '';
                if($inForm && !$field->readonly && $this->notEmptyRule && strpos(",$field->rules,", ",{$this->notEmptyRule->id},") !== false) $require = "required";

                $content = $inForm ? $this->getFieldControl($field, $object) : $this->getFieldValue($field, $object);

                if($inCell) $html .= "<div class='cell'>"; 

                $html .= "<div class='detail'>"; 
                $html .= "<div class='detail-title'>{$field->name}</div>"; 
                $html .= "<div class='detail-content $require'>{$content}</div>"; 
                $html .= '</div>'; 

                if($inCell) $html .= '</div>'; 
            }
        }

        return $html;
    }

    /**
     * Get control of a field.
     * 
     * @param  object    $field 
     * @param  object    $object 
     * @access public
     * @return string
     */
    public function getFieldControl($field, $object, $controlName = '')
    {
        $control  = '';
        $readonly = $field->readonly ? 'disabled' : '';

        if($field->control == 'checkbox' or $field->control == 'radio' and isset($field->options[''])) unset($field->options['']);

        if($field->control == 'input')        $control = html::input($controlName    ? $controlName : $field->field, $object ? $object->{$field->field} : '', "class='form-control' $readonly"); 
        if($field->control == 'textarea')
        {
            $control = html::textarea($controlName ? $controlName : $field->field, $object ? $object->{$field->field} : '', "class='form-control' $readonly"); 
        }
        if($field->control == 'decimal')      $control = html::input($controlName    ? $controlName : $field->field, $object ? $object->{$field->field} : '', "class='form-control' $readonly"); 
        if($field->control == 'integer')      $control = html::input($controlName    ? $controlName : $field->field, $object ? $object->{$field->field} : '', "class='form-control' $readonly"); 
        if($field->control == 'select')       $control = html::select($controlName   ? $controlName : $field->field, $field->options, $object ? $object->{$field->field} : '', "class='form-control chosen' $readonly"); 
        if($field->control == 'multi-select') $control = html::select($controlName   ? $controlName : $field->field . '[]', $field->options, $object ? $object->{$field->field} : '', "class='form-control chosen' multiple $readonly"); 
        if($field->control == 'checkbox')     $control = html::checkbox($controlName ? $controlName : $field->field, $field->options, $object ? $object->{$field->field} : '', "class='form-control' $readonly"); 
        if($field->control == 'radio')        $control = html::radio($controlName    ? $controlName : $field->field, $field->options, $object ? $object->{$field->field} : '', "$readonly"); 
        if($field->control == 'richtext')
        {
            $object = $this->loadModel('file')->replaceImgURL($object, $field->field);
            $control = html::textarea($controlName ? $controlName : $field->field, $object ? $object->{$field->field} : '', "class='form-control' $readonly"); 
            if($readonly) $control = $object ? $object->{$field->field} : '';
        }
        if($field->control == 'date')         $control = html::input($controlName    ? $controlName : $field->field, $object ? $object->{$field->field} : '', "class='form-control form-date' $readonly"); 
        if($field->control == 'datetime')     $control = html::input($controlName    ? $controlName : $field->field, $object ? $object->{$field->field} : '', "class='form-control form-datetime' $readonly"); 

        if($field->field == 'subStatus')  $control .= $this->getSubStatusScript($field);

        return $control;
    }

    /**
     * Get value string of one field.
     * 
     * @param  object    $field 
     * @param  object    $object 
     * @access public
     * @return string
     */
    public function getFieldValue($field, $object)
    {
        if($field->control == 'richtext')
        {
            $object = $this->loadModel('file')->replaceImgURL($object, $field->field);
            return $object->{$field->field};
        }
        if($field->control != 'checkbox' and $field->control != 'multi-select') return zget($field->options, $object->{$field->field}, $object->{$field->field});

        $content = '';
        $values  = json_decode($object->{$field->field}, true);
        if(empty($values)) $values = explode(',', str_replace(' ', '', $object->{$field->field}));
        foreach($values as $value) $content .= ' ' . zget($field->options, $value, $value);

        return $content;
    }

    /**
     * Print workflow defined fields from browse page.
     * 
     * @param string $module
     * @param object $object
     * @param string $fieldCode
     * @access public
     * @return void
     */
    public function printFlowCell($module, $object, $fieldCode)
    {
        static $fields  = array();
        static $options = array();

        $fieldKey = $module . '_' . $fieldCode;

        if(isset($fields[$fieldKey]))
        {
            $field = $fields[$fieldKey];
        }
        else
        {
            $field = $this->loadModel('workflowfield')->getByField($module, $fieldCode);

            $fields[$fieldKey] = $field;
        }

        if(isset($field->buildin) && $field->buildin == 0)
        {
            if(strpos('select,radio,checkbox', $field->control) === false) 
            {
                echo $object->{$field->field};
            }
            else
            {
                if(isset($options[$fieldKey]))
                {
                    $field->options = $options[$fieldKey];
                }
                else
                {
                    $field->options = $this->loadModel('workflowfield')->getFieldOptions($field);

                    $options[$fieldKey] = $field->options;
                }

                echo zget($field->options, $object->{$field->field});
            }
        }
    }

    /**
     * Import from excel
     * 
     * @param  object $flow 
     * @access public
     * @return array
     */
    public function import($flow)
    {
        $this->loadModel('action');

        $errorList  = array();
        $recordList = array();
        $actionList = array();
        $dataList   = $this->post->dataList;
        $dataList   = $this->deleteEmpty($dataList);

        $subTables = $this->dao->select('module, `table`')->from(TABLE_WORKFLOW)
            ->where('type')->eq('table')
            ->andWhere('parent')->eq($flow->module)
            ->fetchPairs();

        /* 导入数据。*/
        foreach($dataList as $key => $data)
        {
            if(!empty($this->post->dataList[$key]['id']) and empty($_POST['insert']))
            {
                $this->dao->update($flow->table)->data($data, 'sub_tables')->where('id')->eq($this->post->dataList[$key]['id'])->exec();

                $dataID   = $this->post->dataList[$key]['id'];
                $actionID = $this->action->create($flow->module, $dataID, 'edited');
            }
            else
            {

                $data['createdBy']   = $this->app->user->account;
                $data['createdDate'] = helper::now();

                /* 导入主流程数据。*/
                $this->dao->insert($flow->table)->data($data, 'sub_tables')->autoCheck()->exec();

                if(dao::isError())
                {
                    $daoErrors = dao::getError();
                    if(is_string($daoErrors)) $errorList['error' . $key] = $daoErrors;
                    if(is_array($daoErrors))
                    {
                        foreach($daoErrors as $field => $message)
                        {
                            /* Set error key. */
                            $errorKey = '';
                            $errorKey = 'dataList' . $key . $field;

                            $errorList[$errorKey] = $message;
                        }
                    }

                    break;
                }

                $dataID   = $this->dao->lastInsertId();
                $actionID = $this->action->create($flow->module, $dataID, 'import');
            }

            $recordList[] = $dataID;
            $actionList[] = $actionID;

            /* 导入明细表数据。*/
            if(isset($data['sub_tables']))
            {
                foreach($data['sub_tables'] as $subModule => $subDatas)
                {
                    if(!isset($subTables[$subModule])) continue;

                    $subTable = $subTables[$subModule];

                    foreach($subDatas as $subKey => $subData)
                    {
                        $subData['parent']      = $dataID;
                        $subData['createdBy']   = $this->app->user->account;
                        $subData['createdDate'] = helper::now();

                        $this->dao->insert($subTable)->data($subData)->autoCheck()->exec();

                        if(dao::isError())
                        {
                            $daoErrors = dao::getError();
                            if(is_string($daoErrors)) $errorList['error' . $key] = $daoErrors;
                            if(is_array($daoErrors))
                            {
                                foreach($daoErrors as $field => $message)
                                {
                                    /* Set error key. */
                                    $errorKey = '';
                                    $errorKey = 'dataList' . $key . 'sub_tables' . $subTable->module . $subKey . $field;

                                    $errorList[$errorKey] = $message;
                                }
                            }
                            break;
                        }
                    }

                    if(dao::isError()) break;
                }
            }

            if(dao::isError()) break;
        }

        /* 如果存在错误则把已导入的数据删除并返回错误信息。*/
        if($errorList)
        {
            $this->dao->delete()->from($flow->table)->where('id')->in($recordList)->exec();
            $this->dao->delete()->from(TABLE_ACTION)->where('id')->in($actionList)->exec();

            foreach($subTables as $subTable)
            {
                $this->dao->delete()->from($subTable)->where('parent')->in($recordList)->exec();
            }

            return array('result' => 'fail', 'message' => $errorList);
        }

        $locate = helper::createLink($flow->module, 'browse');
        return array('result' => 'success', 'message' => $this->lang->saveSuccess, 'recordList' => $recordList, 'actionList' => $actionList, 'locate' => $locate);
    }

    /**
     * Get extend fields.
     * 
     * @param  string $moduleName 
     * @param  string $methodName 
     * @access public
     * @return array
     */
    public function getExtendFields($moduleName, $methodName)
    {
        $action = $this->loadModel('workflowaction')->getByModuleAndAction($moduleName, $methodName);
        if(empty($action) or $action->extensionType == 'none') return array();

        $fields  = $this->workflowaction->getFields($moduleName, $methodName);
        $layouts = $this->loadModel('workflowlayout')->getFields($moduleName, $methodName);

        $extendFields = array();
        foreach($fields as $field)
        {
            if($field->buildin or !$field->show or !isset($layouts[$field->field])) continue;
            $extendFields[] = $field;
        }

        return $extendFields;
    }

    /**
     * Check flow field rule.
     * 
     * @param  object $field 
     * @param  string $value 
     * @access public
     * @return false|string
     */
    public function checkRule($field, $value)
    {
        $rules = trim($field->rules, ',');
        if(empty($rules)) return false;

        $rules = $this->dao->select('*')->from(TABLE_WORKFLOWRULE)->where('id')->in($rules)->orderBy('id_desc')->fetchAll('id');
        foreach($rules as $rule)
        {
            if($rule->type == 'system' and $rule->rule == 'notempty')
            {
                if($value === '') return sprintf($this->lang->error->notempty, $field->name);
                if(strpos($field->type, 'int') !== false and $field->control == 'select' and empty($value)) return sprintf($this->lang->error->notempty, $field->name);
                if($field->control == 'radio' or $field->control == 'checkbox') return sprintf($this->lang->error->notempty, $field->name);

            }   
            elseif($rule->type == 'system')
            {
                $checkFunc = 'check' . $rule->rule;
                if(!validater::$checkFunc($value))
                {
                    $error = zget($this->lang->error, $rule->rule, '');
                    if($error) $error = sprintf($error, $field->name);
                    if(empty($error)) $error = sprintf($this->lang->error->reg, $field->name, $rule->rule);

                    return $error;
                }   
            }   
            elseif($rule->type == 'regex')
            {
                if(!validater::checkREG($value, $rule->rule)) return sprintf($this->lang->error->reg, $field->name, $rule->rule);
            }
        }

        return false;
    }

    public function buildControl($field, $fieldValue, $element = '', $childModule = '', $emptyValue = false, $preview = false)
    {
        if(!empty($fieldValue))
        {
            if($field->control == 'date' && $fieldValue != '0000-00-00') $fieldValue = date('Y-m-d', strtotime($fieldValue));
            if($field->control == 'datetime' && $fieldValue != '0000-00-00 00:00:00') $fieldValue = date('Y-m-d H:i:s', strtotime($fieldValue));
            if($field->control == 'select' or $field->control == 'multi-select' or $field->control == 'checkbox' or $field->control == 'radio')
            {
                if(!is_array($fieldValue)) $fieldValue = explode(',', $fieldValue);

                $options = $this->loadModel('workflowfield')->getFieldOptions($field);
                foreach($fieldValue as $i => $value)
                {
                    $fieldKey = array_search($value, $options);
                    if($fieldKey) $fieldValue[$i] = $fieldKey;
                }

                $fieldValue = join(',', $fieldValue);
            }
        }
        if($field->control == 'multi-select' and $element) $element .= '[]';

        return parent::buildControl($field, $fieldValue, $element, $childModule, $emptyValue, $preview);
    }

    public function getDataByID($flow, $dataID, $decode = true)
    {
        $data = parent::getDataByID($flow, $dataID, $decode);
        if(!$decode) return $data;

        $table  = $flow->table;
        $fields = $this->loadModel('workflowfield')->getList($flow->module);

        $tableData = $this->dao->select('*')->from($table)->where('id')->eq($dataID)->fetch();
        if($tableData)
        {
            foreach($fields as $field)
            {
                $fieldControl = $field->control;
                $fieldName    = $field->field;
                if($decode and ($fieldControl == 'multi-select' or $fieldControl == 'checkbox') and $tableData->$fieldName and empty($data->$fieldName))
                {
                    $data->$fieldName = explode(',', str_replace(' ', '', $tableData->$fieldName));
                }
            }
        }

        return $data;
    }
}
