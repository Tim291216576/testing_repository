<?php
/**
 * The edit view file of workflowhook module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowhook
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('module', $flow->module);?>
<form id='editHookForm' class='hookForm' method='post' action='<?php echo inlink('edit', "action=$action->id&key=$key");?>'>
  <?php $hook  = $action->hooks[$key];?>
  <?php $class = empty($hook->conditions) ? 'hide' : '';?>
  <div id='conditionDIV' class='detail <?php echo $class;?>'>
    <div class='detail-heading'>
      <strong><?php echo $lang->workflowhook->condition;?></strong>
    </div>
    <div class='detail-content'>
      <table class='table table-form'>
        <tr>
          <th class='w-80px'></th>
          <td class='w-160px'></td>
          <td class='w-60px'></td>
          <td class='w-200px'></td>
          <td></td>
          <td class='w-100px'></td>
        </tr>
        <tr>
          <th><?php echo $lang->workflowhook->type;?></th>
          <td colspan='4'><?php echo html::select('conditionType', $lang->workflowhook->typeList, zget($hook, 'conditionType', 'data'), "class='form-control'");?></td>
          <td></td>
        </tr>
        <?php if(is_object($hook->conditions)):?>
        <tr class='sqlTR'>
          <th><?php echo $lang->workflowhook->sql;?></th>
          <td colspan='4'><?php echo html::textarea('sql', $hook->conditions->sql, "rows='5' class='form-control' placeholder='{$lang->workflowhook->placeholder->sql}'");?></td>
          <td></td>
        </tr>
        <?php foreach($hook->conditions->sqlVars as $sqlVar):?>
        <tr class='sqlTR'>
          <th><?php echo $lang->workflowhook->varName;?></th>
          <td><?php echo html::input('varName[]', $sqlVar->varName, "id='varName' class='form-control' autocomplete='off'");?></td>
          <th><?php echo $lang->workflowhook->varValue;?></th>
          <td class='nopaddingright'>
            <?php echo html::select('paramType[]', $datasources, $sqlVar->paramType, "id='paramType' class='form-control'");?>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('param[]', $sqlVar->param, "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('param[]', array($sqlVar->param => ''), $sqlVar->param, "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addVar'><i class='icon-plus icon-large'></i></a>
            <a href='javascript:;' class='btn delVar'><i class='icon-close icon-large'></i></a>
          </td>
        </tr>
        <?php endforeach;?>
        <?php if(empty($hook->conditions->sqlVars)):?>
        <tr class='sqlTR'>
          <th><?php echo $lang->workflowhook->varName;?></th>
          <td><?php echo html::input('varName[]', '', "id='varName' class='form-control' autocomplete='off'");?></td>
          <th><?php echo $lang->workflowhook->varValue;?></th>
          <td class='nopaddingright'>
            <?php echo html::select('paramType[]', $datasources, 'custom', "id='paramType' class='form-control'");?>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('param[]', '', "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('param[]', '', '', "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addVar'><i class='icon-plus icon-large'></i></a>
            <a href='javascript:;' class='btn delVar'><i class='icon-close icon-large'></i></a>
          </td>
        </tr>
        <?php endif;?>
        <tr class='sqlTR'>
          <th><?php echo $lang->workflowhook->result;?></th>
          <td colspan='4'><?php echo html::select('sqlResult', $lang->workflowhook->resultList, $hook->conditions->sqlResult, "class='form-control'");?></td>
          <td></td>
        </tr>
        <?php elseif(is_array($hook->conditions)):?>
        <tr class='sqlTR'>
          <th><?php echo $lang->workflowhook->sql;?></th>
          <td colspan='4'><?php echo html::textarea('sql', '', "rows='5' class='form-control' placeholder='{$lang->workflowhook->placeholder->sql}'");?></td>
          <td></td>
        </tr>
        <tr class='sqlTR'>
          <th><?php echo $lang->workflowhook->varName;?></th>
          <td><?php echo html::input('varName[]', '', "id='varName' class='form-control' autocomplete='off'");?></td>
          <th><?php echo $lang->workflowhook->varValue;?></th>
          <td class='nopaddingright'>
            <?php echo html::select('paramType[]', $datasources, 'custom', "id='paramType' class='form-control'");?>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('param[]', '', "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('param[]', '', '', "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addVar'><i class='icon-plus icon-large'></i></a>
            <a href='javascript:;' class='btn delVar'><i class='icon-close icon-large'></i></a>
          </td>
        </tr>
        <tr class='sqlTR'>
          <th><?php echo $lang->workflowhook->result;?></th>
          <td colspan='4'><?php echo html::select('sqlResult', $lang->workflowhook->resultList, 'empty', "class='form-control'");?></td>
          <td></td>
        </tr>
        <?php $conditionDatasources = $datasources;?>
        <?php unset($conditionDatasources['form']);?>
        <?php unset($conditionDatasources['record']);?>
        <?php foreach($hook->conditions as $key => $condition):?>
        <tr class='dataTR'>
          <th>
            <?php if($key == 0):?>
            <?php echo $lang->workflowhook->field;?>
            <?php echo html::hidden("conditions[logicalOperator][]", $condition->logicalOperator);?>
            <?php else:?>
            <?php echo html::select("conditions[logicalOperator][]", $lang->workflowhook->logicalOperatorList, $condition->logicalOperator, "class='form-control'");?>
            <?php endif;?>
          </th>
          <td><?php echo html::select('conditions[field][]', $fields, $condition->field, "id='conditionsfield' class='form-control chosen'");?></td>
          <td colspan='2' class='nopaddingright'>
            <div class='input-group'>
              <?php echo html::select('conditions[operator][]', $config->workflowhook->operatorList, $condition->operator, "class='form-control'");?>
              <span class='input-group-addon fix-border fix-padding'></span>
              <?php echo html::select('conditions[paramType][]', $conditionDatasources, $condition->paramType, "id='paramType' class='form-control'");?>
            </div>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('conditions[param][]', $condition->param, "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('conditions[param][]', array($condition->param => ''), $condition->param, "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addCondition'><i class='icon-plus icon-large'></i></a>
            <?php if($key > 0):?>
            <a href='javascript:;' class='btn delCondition'><i class='icon-close icon-large'></i></a>
            <?php endif;?>
          </td>
        </tr>
        <?php endforeach;?>
        <?php endif;?>
        <?php if(is_object($hook->conditions) || (is_array($hook->conditions) && empty($hook->conditions))):?>
        <tr class='dataTR'>
          <th>
            <?php echo $lang->workflowhook->field;?>
            <?php echo html::hidden("conditions[logicalOperator][]", 'and');?>
          </th>
          <td><?php echo html::select('conditions[field][]', $fields, '', "id='conditionsfield' class='form-control chosen'");?></td>
          <td colspan='2' class='nopaddingright'>
            <div class='input-group'>
              <?php echo html::select('conditions[operator][]', $config->workflowhook->operatorList, 'equal', "class='form-control'");?>
              <span class='input-group-addon fix-border fix-padding'></span>
              <?php echo html::select('conditions[paramType][]', $conditionDatasources, 'custom', "id='paramType' class='form-control'");?>
            </div>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('conditions[param][]', '', "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('conditions[param][]', '', '', "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addCondition'><i class='icon-plus icon-large'></i></a>
          </td>
        </tr>
        <?php endif;?>
      </table>
    </div>
  </div>
  <div class='detail'>
    <div class='detail-heading'>
      <strong><?php echo $lang->workflowhook->common;?></strong>
    </div>
    <div class='detail-content'>
      <table class='table table-form'>
        <tr>
          <th class='w-80px'><?php echo $lang->workflowhook->action;?></th>
          <td class='w-160px'><?php echo html::select('action', $lang->workflowhook->actionList, $hook->action, "class='form-control'");?></td>
          <th class='w-30px'><?php echo $lang->workflowhook->table;?></th>
          <td class='w-200px nopaddingright'><?php echo html::select('table', $tables, $hook->table, "class='form-control chosen'");?></td>
          <td></td>
          <td class='w-100px'></td>
        </tr>
        <?php foreach($hook->fields as $key => $field):?>
        <tr class='fieldTR'>
          <th><?php echo $lang->workflowhook->field;?></th>
          <td><?php echo html::select('fields[field][]', $hookFields, $field->field, "id='fieldsfield' class='form-control chosen field'");?></td>
          <th><?php echo $lang->workflowhook->value;?></th>
          <td class='nopaddingright'>
            <?php echo html::select('fields[paramType][]', $datasources, $field->paramType, "id='paramType' class='form-control'");?>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('fields[param][]', $field->param, "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('fields[param][]', array($field->param => ''), $field->param, "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addField'><i class='icon-plus icon-large'></i></a>
            <?php if($key > 0):?>
            <a href='javascript:;' class='btn delField'><i class='delField icon-close icon-large'></i></a>
            <?php endif;?>
          </td>
        </tr>
        <?php endforeach;?>
        <?php if(empty($hook->fields)):?>
        <tr class='fieldTR'>
          <th><?php echo $lang->workflowhook->field;?></th>
          <td><?php echo html::select('fields[field][]', $hookFields, '', "id='fieldsfield' class='form-control chosen field'");?></td>
          <th><?php echo $lang->workflowhook->value;?></th>
          <td class='nopaddingright'>
            <?php echo html::select('fields[paramType][]', $datasources, 'custom', "id='paramType' class='form-control'");?>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('fields[param][]', '', "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('fields[param][]', '', '', "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addField'><i class='icon-plus icon-large'></i></a>
          </td>
        </tr>
        <?php endif;?>
        <?php foreach($hook->wheres as $key => $where):?>
        <tr class='whereTR'>
          <th>
            <?php if($key == 0):?>
            <?php echo $lang->workflowhook->where;?>
            <?php echo html::hidden("wheres[logicalOperator][]", $where->logicalOperator);?>
            <?php else:?>
            <?php echo html::select("wheres[logicalOperator][]", $lang->workflowhook->logicalOperatorList, $where->logicalOperator, "class='form-control'");?>
            <?php endif;?>
          </th>
          <td><?php echo html::select('wheres[field][]', $hookFields, $where->field, "id='wheresfield' class='form-control chosen field'");?></td>
          <th></th>
          <td class='nopaddingright'>
            <div class='input-group'>
              <?php echo html::select('wheres[operator][]', $config->workflowhook->operatorList, $where->operator, "class='form-control'");?>
              <span class='input-group-addon fix-border fix-padding'></span>
              <?php echo html::select('wheres[paramType][]', $datasources, $where->paramType, "id='paramType' class='form-control'");?>
            </div>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('wheres[param][]', $where->param, "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('wheres[param][]', array($where->param => ''), $where->param, "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addWhere'><i class='icon-plus icon-large'></i></a>
            <?php if($key > 0):?>                      
            <a href='javascript:;' class='btn delWhere'><i class='icon-close icon-large'></i></a>
            <?php endif;?>
          </td>
        </tr>
        <?php endforeach;?>
        <?php if(empty($hook->wheres)):?>
        <tr class='whereTR'>
          <th>
            <?php echo $lang->workflowhook->where;?>
            <?php echo html::hidden("wheres[logicalOperator][]", 'and');?>
          </th>
          <td><?php echo html::select('wheres[field][]', $hookFields, '', "id='wheresfield' class='form-control chosen field'");?></td>
          <th></th>
          <td class='nopaddingright'>
            <div class='input-group'>
              <?php echo html::select('wheres[operator][]', $config->workflowhook->operatorList, '', "class='form-control'");?>
              <span class='input-group-addon fix-border fix-padding'></span>
              <?php echo html::select('wheres[paramType][]', $datasources, 'custom', "id='paramType' class='form-control'");?>
            </div>
          </td>
          <td class='nopaddingleft'>
            <?php echo html::input('wheres[param][]', '', "id='param' class='form-control' autocomplete='off'");?>
            <span class='param'><?php echo html::select('wheres[param][]', '', '', "id='param' class='form-control chosen'");?></span>
          </td>
          <td class='nopaddingleft'>
            <a href='javascript:;' class='btn addWhere'><i class='icon-plus icon-large'></i></a>
          </td>
        </tr>
        <?php endif;?>
        <tr>
          <th><?php echo $lang->workflowhook->message;?></th>
          <td colspan='4'><?php echo html::input('message', zget($hook, 'message', ''), "class='form-control' autocomplete='off'");?></td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->comment;?></th>
          <td colspan='4'><?php echo html::textarea('comment', zget($hook, 'comment', ''), "class='form-control' rows='3'");?></td>
          <td></td>
        </tr>
        <tr>
          <th></th>
          <td class='form-actions' colspan='5'>
            <?php echo html::hidden('condition', empty($hook->conditions) ? 0 : 1);?>
            <?php echo baseHTML::a('javascript:;', $lang->workflowhook->condition, "class='btn btn-primary toggleCondition'");?>
            <?php echo baseHTML::submitButton();?>
          </td>
        </tr>
      </table>
    </div>
  </div>
</form>

<div id='recordFieldsDIV' class='hide'>
  <option></option>
  <?php 
  foreach($fields as $field => $name)
  {
      echo "<option value='{$field}'>{$name}</option>";
  }
  ?>
</div>
<div id='formFieldsDIV' class='hide'>
  <option></option>
  <?php 
  foreach($layoutFields as $field => $name)
  {
      echo "<option value='{$field}'>{$name}</option>";
  }
  ?>
</div>

<?php
$varName   = html::input('varName[]', '', "class='form-control' autocomplete='off'");
$paramType = html::select('paramType[]', $datasources, 'custom', "id='paramType' class='form-control'");
$input     = html::input('param[]', '', "id='param' class='form-control' autocomplete='off'");
$select    = html::select('param[]', '', '', "id='param' class='form-control chosen'");
$varRow = <<<EOT
  <tr class="sqlTR">
    <th>{$lang->workflowhook->varName}</th>
    <td>{$varName}</td>
    <th>{$lang->workflowhook->varValue}</th>
    <td class="nopaddingright">{$paramType}</td>
    <td class="nopaddingleft">
      {$input}
      <span class="param">{$select}</span>
    </td>
    <td class="nopaddingleft">
      <a href="javascript:;" class="btn addVar"><i class="icon-plus icon-large"></i></a>
      <a href="javascript:;" class="btn delVar"><i class="icon-close icon-large"></i></a>
    </td>
  </tr>
EOT;

$logicOperater = html::select('conditions[logicalOperator][]', $lang->workflowhook->logicalOperatorList, '', "class='form-control'");
$field         = html::select('conditions[field][]', $fields, '', "class='form-control chosen'");
$operator      = html::select('conditions[operator][]', $config->workflowhook->operatorList, 'equal', "class='form-control'");
$paramType     = html::select('conditions[paramType][]', $conditionDatasources, 'custom', "id='paramType' class='form-control'");
$input         = html::input('conditions[param][]', '', "id='param' class='form-control' autocomplete='off'");
$select        = html::select('conditions[param][]', '', '', "id='param' class='form-control chosen'");
$conditionRow = <<<EOT
  <tr>
    <th>{$logicOperater}</th>
    <td>{$field}</td>
    <td colspan="2" class="nopaddingright">
      <div class="input-group">
        {$operator}
        <span class="input-group-addon fix-border fix-padding"></span>
        {$paramType}
      </div>
    </td>
    <td class="nopaddingleft">
      {$input}
      <span class="param">{$select}</span>
    </td>
    <td class="nopaddingleft">
      <a href="javascript:;" class="btn addCondition"><i class="icon-plus icon-large"></i></a>
      <a href="javascript:;" class="btn delCondition"><i class="icon-close icon-large"></i></a>
    </td>
  </tr>
EOT;

$field     = html::select('fields[field][]', $fields, '', "class='form-control chosen field'");
$paramType = html::select('fields[paramType][]', $datasources, 'custom', "id='paramType' class='form-control'");
$input     = html::input('fields[param][]', '', "id='param' class='form-control' autocomplete='off'");
$select    = html::select('fields[param][]', '', '', "id='param' class='form-control chosen'");
$fieldRow = <<<EOT
  <tr class="fieldTR">
    <th>{$lang->workflowhook->field}</th>
    <td>{$field}</td>
    <th>{$lang->workflowhook->value}</th>
    <td class="nopaddingright">{$paramType}</td>
    <td class="nopaddingleft">
      {$input}
      <span class="param">{$select}</span>
    </td>
    <td class="nopaddingleft">
      <a href="javascript:;" class="btn addField"><i class="icon-plus icon-large"></i></a>
      <a href="javascript:;" class="btn delField"><i class="icon-close icon-large"></i></a>
    </td>
  </tr>
EOT;

$logicOperater = html::select('wheres[logicalOperator][]', $lang->workflowhook->logicalOperatorList, '', "class='form-control'");
$field         = html::select('wheres[field][]', $fields, '', "class='form-control chosen field'");
$operator      = html::select('wheres[operator][]', $config->workflowhook->operatorList, 'equal', "class='form-control'");
$paramType     = html::select('wheres[paramType][]', $datasources, 'custom', "id='paramType' class='form-control'");
$input         = html::input('wheres[param][]', '', "id='param' class='form-control' autocomplete='off'");
$select        = html::select('wheres[param][]', '', '', "id='param' class='form-control chosen'");
$whereRow = <<<EOT
  <tr class="whereTR">
    <th>{$logicOperater}</th>
    <td>{$field}</td>
    <th></th>
    <td class="nopaddingright">
      <div class="input-group">
        {$operator}
        <span class="input-group-addon fix-border fix-padding"></span>
        {$paramType}
      </div>
    </td>
    <td class="nopaddingleft">
      {$input}
      <span class="param">{$select}</span>
    </td>
    <td class="nopaddingleft">
      <a href="javascript:;" class="btn addWhere"><i class="icon-plus icon-large"></i></a>
      <a href="javascript:;" class="btn delWhere"><i class="icon-close icon-large"></i></a>
    </td>
  </tr>
EOT;

js::set('varRow', $varRow);
js::set('conditionRow', $conditionRow);
js::set('fieldRow', $fieldRow);
js::set('whereRow', $whereRow);
?>
<?php include '../../common/view/footer.modal.html.php';?>
