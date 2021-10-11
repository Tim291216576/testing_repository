<?php
/**
 * The edit view file of wordflowfield module of ZDOO.
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
<?php js::set('fieldID', $field->id);?>
<form method='post' id='ajaxForm' action='<?php echo inlink('edit', "module=$field->module&id=$field->id");?>'>
  <table class='table table-form' id='fieldTable'>
    <?php
    /* 内置字段中subStatus可以编辑，其他不可编辑。默认字段中status、subStatus可以编辑，其他不可编辑。非内置且非默认字段可以编辑。*/
    /* The subStatus in the built-in field can be edited, and the others cannot be edited. The status, status, and status in the default field can be edited, and others cannot be edited. Non-built-in and non-default fields can be edited. */
    ?>
    <tr>
      <th class='w-100px'><?php echo $lang->workflowfield->name;?></th>
      <td>
        <div class='input-group'>
          <?php echo html::input('name', $field->name, "class='form-control'");?>
          <?php if(!$field->readonly):?>
          <span class='input-group-addon fix-border'><?php echo $lang->workflowfield->position;?></span>
          <?php echo html::select('order', $fields, $field->order, "class='form-control'");?>
          <span class='input-group-addon'><?php echo $lang->workflowfield->positionList['after'];?></span>
          <?php endif;?>
        </div>
      </td>
    </tr>
    <?php if(!$field->readonly):?>
    <tr>
      <th><?php echo $lang->workflowfield->field;?></th>
      <td>
        <?php $disabled = ($field->field == 'status' or $field->field == 'subStatus') ? "disabled='disabled'" : '';?>
        <?php if($disabled) echo html::hidden('field', $field->field);?>
        <?php if($disabled) echo html::hidden('type', $field->type);?>
        <?php if($disabled) echo html::hidden('length', $field->length);?>
        <div class='input-group'>
          <?php echo html::input('field', $field->field, "class='form-control' placeholder='{$lang->workflowfield->placeholder->code}' $disabled");?>
          <span class='input-group-addon fix-border'><?php echo $lang->workflowfield->type;?></span>
            <select id='type' name='type' <?php echo $disabled;?> class='form-control'>
            <?php foreach($lang->workflowfield->typeGroup as $type => $group):?>
            <optgroup label='<?php echo $group;?>'>
              <?php foreach($config->workflowfield->typeList[$type] as $key => $value):?>
              <option <?php if($key == $field->type) echo "selected";?> value='<?php echo $key;?>'><?php echo $value;?></option>
              <?php endforeach;?>
            </optgroup>
            <?php endforeach;?>
          </select>
          <span class='input-group-addon fix-border length'><?php echo $lang->workflowfield->length;?></span>
          <?php echo html::input('length', $field->length, "class='form-control length' $disabled");?>
        </div>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowfield->control;?></th>
      <td>
        <div class='input-group'>
          <?php $optionType = is_array($field->options) ? 'custom' : $field->options;?>
          <?php $disabled = ($field->field == 'status' or $field->field == 'subStatus') ? "disabled='disabled'" : '';?>
          <?php if($disabled) echo html::hidden('control', $field->control);?>
          <?php echo html::select('control', $lang->workflowfield->controlTypeList, $field->control, "class='form-control' $disabled");?>
          <span class='input-group-addon fix-border optionType'><?php echo $lang->workflowfield->dataSource;?></span>
          <?php $disabled = $field->field == 'subStatus' ? "disabled='disabled'" : '';?>
          <?php if($disabled) echo html::hidden('optionType', $optionType);?>
          <?php echo html::select('optionType', $datasources, $optionType, "class='form-control optionType' $disabled");?>
        </div>
      </td>
    </tr>
    <tr class='sqlTR'>
      <th><?php echo $lang->workflowfield->sql;?></th>
      <td><?php echo html::textarea('sql', $field->sql, "rows='4' class='form-control' placeholder='{$lang->workflowfield->placeholder->sql}'");?></td>
    </tr>
    <tr class='hide' id='varsTR'>
      <th><?php echo $lang->workflowfield->vars;?></th>
      <td id='varsTD'>
        <?php foreach($field->sqlVars as $var):?>
        <div id='<?php echo $var->varName;?>' class='w-p45 varControl'>
          <div class='input-group'>
            <?php echo $this->fetch('workflow', 'buildVarControl', "varName={$var->varName}");?>
          </div>
        </div>
        <?php endforeach;?>
      </td>
    </tr>
    <tr class='hide'>
      <th></th>
      <td><?php echo baseHTML::a(inlink('addSqlVar'), $lang->workflowfield->addVar, "class='btn' data-toggle='modal'");?></td>
    </tr>
    <?php if($field->field == 'subStatus'):?>
    <tr id='optionTR'>
      <th><?php echo $lang->workflowfield->options;?></th>
      <td>
        <?php $statusList  = array();?>
        <?php $statusField = $this->workflowfield->getByField($flow->module, 'status');?>
        <?php if($statusField) $statusList = $this->workflowfield->getFieldOptions($statusField, $emptyOption = false);?>
        <?php if(!$statusList):?>
        <strong class='text-red'><?php echo $lang->workflowfield->tips->emptyStatus;?></strong>
        <?php else:?>
        <table class='table table-form table-bordered'>
          <thead>
            <tr class='text-center'>
              <th class='w-100px'><?php echo $lang->workflowfield->status;?></th>
              <th><?php echo $lang->workflowfield->subStatus;?></th>
            </tr>
          </thead>
          <?php foreach($statusList as $parentCode => $parentName):?>
          <?php if(!$parentName) continue;?>
          <tr>
            <td class='text-center'>
              <?php echo $parentName;?>
              <?php echo html::hidden('parentCode[]', $parentCode);?>
              <?php echo html::hidden('parentName[]', $parentName);?>
            </td>
            <td>
              <?php $subStatus = zget($field->options, $parentCode, null);?>
              <?php $default   = zget($subStatus, 'default', '');?>
              <?php $options   = zget($subStatus, 'options', array());?>
              <?php if(empty($options)) $options = array('' => '');?>
              <?php if(is_array($options)):?>
              <?php foreach($options as $code => $name):?>
              <div class='input-group'>
                <span class='statusKey input-group-addon'><?php echo $lang->workflowfield->key;?></span>
                <?php echo html::input("optionCode[$parentCode][]", $code, "class='form-control' placeholder='{$lang->workflowfield->placeholder->optionCode}'");?>
                <span class='input-group-addon'><?php echo $lang->workflowfield->value;?></span>
                <?php echo html::input("optionName[$parentCode][]", $name, "class='form-control'");?>
                <span class='input-group-btn'>
                  <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
                </span>
                <span class='input-group-btn'>
                  <a href='javascript:;' class='btn btn-default delItem'><i class='icon-minus'></i></a>
                </span>
                <span class='input-group-addon'>
                  <?php echo html::radio("optionDefault[$parentCode]", array($code => $lang->workflowfield->defaultSubStatus), $default);?>
                </span>
              </div>
              <?php endforeach;?>
              <?php else:?>
              <div class='input-group'>
                <span class='statusKey input-group-addon'><?php echo $lang->workflowfield->key;?></span>
                <?php echo html::input("optionCode[$parentCode][]", '', "class='form-control' placeholder='{$lang->workflowfield->placeholder->optionCode}'");?>
                <span class='input-group-addon'><?php echo $lang->workflowfield->value;?></span>
                <?php echo html::input("optionName[$parentCode][]", '', "class='form-control'");?>
                <span class='input-group-btn'>
                  <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
                </span>
                <span class='input-group-btn'>
                  <a href='javascript:;' class='btn btn-default delItem'><i class='icon-minus'></i></a>
                </span>
                <span class='input-group-addon'>
                  <?php echo html::radio("optionDefault[$parentCode]", array('default' => $lang->workflowfield->defaultSubStatus));?>
                </span>
              </div>
              <?php endif;?>
              <div id='optionDefault<?php echo $parentCode;?>'></div>
            </td>
          </tr>
          <?php endforeach;?>
        </table>
        <?php endif;?>
        <div id='optionsDIV'></div>
      </td>
    </tr>
    <?php else:?>
    <tr id='optionTR'>
      <th><?php echo $lang->workflowfield->options;?></th>
      <td>
        <?php $options = array('' => '');?>
        <?php if(is_array($field->options)) $options = $field->options + array('' => '');?>
        <?php foreach($options as $code => $name):?>
        <div class="input-group">
          <span class='statusKey input-group-addon'><?php echo $lang->workflowfield->key;?></span>
          <?php echo html::input('options[code][]', $code, "class='form-control' placeholder='{$lang->workflowfield->placeholder->optionCode}'");?>
          <span class='input-group-addon'><?php echo $lang->workflowfield->value;?></span>
          <?php echo html::input('options[name][]', $name, "class='form-control'");?>
          <span class='input-group-btn'>
            <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
          </span>
          <span class='input-group-btn'>
            <a href='javascript:;' class='btn btn-default delItem'><i class='icon-minus'></i></a>
          </span>
        </div> 
        <?php endforeach;?>
        <div id='optionsDIV'></div>
      </td>
    </tr>
    <?php endif;?>
    <tr>
      <th><?php echo $lang->workflowfield->defaultValue;?></th>
      <td><?php echo html::input('default', $field->default, "class='form-control' placeholder='{$lang->workflowfield->placeholder->defaultValue}'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowfield->rules;?></th>
      <td><?php echo html::select('rules[]', $rules, $field->rules, "multiple class='chosen form-control'");?></td>
    </tr>
    <?php endif;?>
    <tr>
      <th><?php echo $lang->workflowfield->isKeyValue;?></th>
      <td>
        <label class="checkbox-inline">
          <input type="checkbox" name="isValue" id="isValue" <?php if($field->isValue == 1) echo "checked='checked'";?> value="1"><?php echo $lang->workflowfield->keyValueList['value'];?>
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
        <?php echo html::hidden('oldOrder', $field->order);?>
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
