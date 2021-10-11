<div class='cols-list cols-list-origin'>
  <?php
  $index           = 1;
  $disabledFields  = in_array($action->action, $config->workflowaction->defaultActions) ? $config->workflowlayout->disabledFields[$action->action] : $config->workflowlayout->disabledFields['custom'];
  $controlList     = array('select', 'multi-select', 'checkbox', 'radio', 'date', 'datetime');
  $dateControlList = array('date', 'datetime');
  ?>

  <?php /* Begin foreach of fields. */ ?>
  <?php foreach($fields as $key => $field):?>
  <?php
  if($mode == 'view' && !$field->show) continue;
  if(strpos(",{$disabledFields},", ",{$key},") !== false) continue;
  $required = $key == 'actions';
  $fixed    = $required ? 'required' : 'enabled';
  $show     = $field->show == '1';
  $subTable = isset($subTables[$key]);
  $disabled = $mode == 'edit' ? '' : "disabled='disabled'";
  ?>

  <div class='clearfix col <?php echo (!$show ? ' disabled' : '') . ($required ? ' required' : '') . (' fixed-' . $fixed) . ($subTable ? " module-{$key}" : '');?>' <?php echo $subTable ? "data-child={$key}" : '';?> data-fixed='<?php echo $fixed;?>'  data-key='<?php echo $key;?>'>
    <i class='icon-check'></i>

    <?php /* Row title. */ ?>
    <?php if($mode == 'edit'):?>
    <span class='title'><span class='title-bar'><strong><?php echo $field->name;?></strong><i class='icon-move'></i></span></span>
    <?php else:?>
    <strong><?php echo $field->name;?></strong>
    <?php endif;?>

    <?php /* Row Actions. */ ?>
    <div class='actions pull-right'>
      <?php if($required):?>
      <span class='text-muted'><?php echo '(' . $lang->workflowlayout->require . ')';?></span>
      <?php endif;?>
      <?php if($action->action != 'browse' && $action->action != 'view' && !is_numeric($key)):?>

      <?php /* Layout rules. */ ?>
      <span>
        <span class='text-muted'><?php echo $lang->workflowlayout->layoutRules;?></span>
        <?php echo html::select("layoutRules[$key][]", $rules, $field->layoutRules, "class='form-control chosen' multiple='multiple' $disabled");?>
      </span>

      <?php if($key != 'file'):?>
      <?php /* Default value. */ ?>
      <span>
        <span class='text-muted'><?php echo $lang->workflowlayout->defaultValue;?></span>
        <?php
        if($field->control == 'multi-select' or $field->control == 'checkbox')
        {
            echo html::select("defaultValue[$key][]", $field->options, $field->defaultValue, "class='form-control chosen' multiple='multiple' $disabled");
        }
        else
        {
            echo html::select("defaultValue[$key]", array('' => '') + $field->options, $field->defaultValue, "class='form-control chosen' $disabled");
        }
        if(in_array($field->control, $dateControlList))
        {
            $class = 'form-' . $field->control;
            echo html::input("defaultValue[$key]", ($field->defaultValue && $field->defaultValue != 'currentTime') ? $field->defaultValue : '', "class='form-control $class' $disabled");
        }
        else
        {
            echo html::input("defaultValue[$key]", ($field->defaultValue && strpos(',currentUser,currentDept,currentTime,', ",$field->defaultValue,") === false) ? $field->defaultValue : '', "class='form-control' disabled='disabled'");
        }
        $checked = '';
        if(!in_array($field->control, $controlList)) $checked  = "checked='checked' disabled='disabled'";
        if(in_array($field->control, $controlList) && !empty($field->defaultValue) && !isset($field->options[$field->defaultValue])) $checked = "checked='checked'";
        ?>
        <input type='checkbox' name="custom[<?php echo $key;?>]" value='1' <?php echo "$checked $disabled";?>/> <?php echo $lang->workflowlayout->custom;?>
      </span>
      <?php else:?>
      <span>
        <span class='text-muted'><?php echo $lang->workflowlayout->defaultValue;?></span>
        <?php echo html::select("defaultValue[$key]", array('' => ''), '', "class='form-control chosen' disabled='disabled'");?>
        <input type='checkbox' name="custom[<?php echo $key;?>]" value='1' disabled='disabled'/> <?php echo $lang->workflowlayout->custom;?>
      </span>
      <?php endif;?>

      <?php endif;?>

      <?php /* Summary. */ ?>
      <?php if($action->action == 'browse' && in_array($field->type, array_keys($config->workflowfield->typeList['number'])) && strpos(",{$config->workflowlayout->noTotalFields},", ",{$field->field},") === false):?>
      <span>
        <span class='text-muted'><?php echo $lang->workflowlayout->totalShow;?></span>
        <?php echo html::select("totalShow[$key]", $lang->workflowlayout->totalList, !empty($field->totalShow) ? $field->totalShow : 0, "class='form-control' $disabled");?>
      </span>
      <?php endif;?>

      <?php /* Width. */ ?>
      <?php if($action->action == 'browse' or ($action->type == 'batch' && $action->batchMode == 'different')):?>
      <span>
        <span class='text-muted'><?php echo $lang->workflowlayout->width;?></span>
        <?php echo html::input("width[$key]", $field->width, "class='form-control' $disabled");?>
      </span>

      <?php /* Display in mobile device. */ ?>
      <span>
        <span class='text-muted'><?php echo $lang->workflowlayout->mobileShow;?></span>
        <?php echo html::select("mobileShow[$key]", $lang->workflowlayout->mobileList, !empty($field->mobileShow) ? $field->mobileShow : 0, "class='form-control' $disabled");?>
      </span>
      <?php endif;?>

      <?php /* Position. */ ?>
      <?php if($action->action == 'view' or $action->action == 'browse' or $action->layout == 'side'):?>
      <span>
        <span class='text-muted'><?php echo $lang->workflowlayout->position;?></span>
        <?php if($action->action == 'view' and $index == 1):?>
        <a data-toggle='tooltip' class='position-tips' title='<?php echo $lang->workflowlayout->tips->position;?>'><i class='icon-question-sign'></i></a>
        <?php endif;?>
        <?php echo html::select("position[$key]", $lang->workflowlayout->positionList[$action->action], !empty($field->position) ? $field->position : zget($defaultPositions, $field->field, ''), "class='form-control' $disabled");?>
      </span>
      <?php endif;?>

      <?php /* Readonly. */ ?>
      <?php if($action->type == 'single' && !in_array($action->action, $config->workflowaction->readonlyActions) && $field->field != 'actions'):?>
      <span>
        <?php $checked  = $field->readonly ? "checked='checked'" : '';?>
        <input type='checkbox' name="readonly[<?php echo $key;?>]" value='1' <?php echo "$checked $disabled";?>/> <?php echo $lang->workflowlayout->readonly;?>
      </span>
      <?php endif;?>

      <?php /* Display or not. */ ?>
      <?php if($mode == 'edit'):?>
      <button type='button' class='btn btn-link show-hide'>
        <span class='label-show'><?php echo $lang->workflowlayout->show;?></span>
        <span class='text-muted'>/</span>
        <span class='label-hide'><?php echo $lang->workflowlayout->hide;?></span>
      </button>
      <?php else:?>
      <?php echo $show ? $lang->workflowlayout->show : $lang->workflowlayout->hide;?>
      <?php endif;?>
      <?php echo html::hidden("show[$key]",  $show ? '1' : '0');?>

    </div>
  </div>
  <?php $index++;?>
  <?php endforeach;?>
  <?php /* End foreach of fields. */ ?>
</div>
