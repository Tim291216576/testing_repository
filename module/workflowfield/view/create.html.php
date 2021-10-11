<?php
/**
 * The create view file of workflowfield module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowfield
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form method='post' id='ajaxForm' action='<?php echo inlink('create', "module=$flow->module");?>'>
  <table class='table table-form' id='fieldTable'>
    <tr>
      <th class='w-100px'><?php echo $lang->workflowfield->name;?></th>
      <td>
        <div class='input-group'>
          <?php echo html::input('name', '', "class='form-control'");?>
          <span class='input-group-addon fix-border'><?php echo $lang->workflowfield->position;?></span>
          <?php $fieldsKey = array_keys($fields);?>
          <?php echo html::select('order', $fields, reset($fieldsKey), "class='form-control'");?>
          <span class='input-group-addon'><?php echo $lang->workflowfield->positionList['after'];?></span>
        </div>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowfield->field;?></th>
      <td>
        <div class='input-group'>
          <?php echo html::input('field', '', "class='form-control' placeholder='{$lang->workflowfield->placeholder->code}'");?>
          <span class='input-group-addon fix-border'><?php echo $lang->workflowfield->type;?></span>
          <select id='type' name='type' class='form-control'>
            <?php foreach($lang->workflowfield->typeGroup as $type => $group):?>
            <optgroup label='<?php echo $group;?>'>
              <?php foreach($config->workflowfield->typeList[$type] as $key => $value):?>
              <option value='<?php echo $key;?>' <?php if($key == 'varchar') echo "selected='selected'";?> ><?php echo $value;?></option>
              <?php endforeach;?>
            </optgroup>
            <?php endforeach;?>
          </select>
          <span class='input-group-addon fix-border length'><?php echo $lang->workflowfield->length;?></span>
          <?php echo html::input('length', '', "class='form-control length'");?>
        </div>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowfield->control;?></th>
      <td>
        <div class='input-group'>
          <?php echo html::select('control', $lang->workflowfield->controlTypeList, 'input', "class='form-control'");?>
          <span class='input-group-addon fix-border optionType'><?php echo $lang->workflowfield->dataSource;?></span>
          <?php echo html::select('optionType', $datasources, '', "class='form-control optionType'");?>
        </div>
      </td>
    </tr>
    <tr class='sqlTR'>
      <th><?php echo $lang->workflowfield->sql;?></th>
      <td><?php echo html::textarea('sql', '', "rows='4' class='form-control' placeholder='{$lang->workflowfield->placeholder->sql}'");?></td>
    </tr>
    <tr class='hide' id='varsTR'>
      <th><?php echo $lang->workflowfield->vars;?></th>
      <td id='varsTD'></td>
    </tr>
    <tr class='hide'>
      <th></th>
      <td><?php echo baseHTML::a(inlink('addSqlVar'), $lang->workflowfield->addVar, "class='btn' data-toggle='modal'");?></td>
    </tr>
    <tr id='optionTR'>
      <th><?php echo $lang->workflowfield->options;?></th>
      <td>
        <div class="input-group">
          <span class='statusKey input-group-addon'><?php echo $lang->workflowfield->key;?></span>
          <?php echo html::input('options[code][]', '', "class='form-control' placeholder='{$lang->workflowfield->placeholder->optionCode}'");?>
          <span class='input-group-addon'><?php echo $lang->workflowfield->value;?></span>
          <?php echo html::input('options[name][]', '', "class='form-control'");?>
          <span class='input-group-btn'>
            <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
          </span>
          <span class='input-group-btn'>
            <a href='javascript:;' class='btn btn-default delItem'><i class='icon-minus'></i></a>
          </span>
        </div> 
        <div id='optionsDIV'></div>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowfield->defaultValue;?></th>
      <td><?php echo html::input('default', '', "class='form-control' placeholder='{$lang->workflowfield->placeholder->defaultValue}'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowfield->rules;?></th>
      <td><?php echo html::select('rules[]', $rules, '', "multiple class='form-control chosen'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowfield->isKeyValue;?></th>
      <td>
        <label class="checkbox-inline">
          <input type="checkbox" name="isValue" value="1" id="isValue"><?php echo $lang->workflowfield->keyValueList['value'];?>
        </label>
      </td>
    </tr>
    <tr>
      <th></th>
      <td><span class='text-important'><?php echo $lang->workflowfield->tips->keyValue;?></span></td>
    </tr>
    <tr>
      <th></th>
      <td class='form-actions'>
        <?php echo baseHTML::submitButton();?>
      </td>
    </tr>
  </table>
</form>
<div id='varGroup' class='hide'>
  <div id='key' class='w-p45 varControl'>
    <div class='input-group'>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.modal.html.php';?>
