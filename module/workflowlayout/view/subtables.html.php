<div id='subTables-list'>
  <?php $disabledFields = $config->workflowlayout->disabledFields['subTables'];?>
  <?php /* Begin foreach of sub tables. */ ?>
  <?php foreach($subTables as $childModule => $childFields):?>
  <div class='child cols-list child-<?php echo $childModule;?>' data-module="<?php echo $childModule;?>">

    <?php /* Block Title */ ?>
    <?php $blockTitle = $lang->workflow->subTable . $lang->colon . zget($flowPairs, str_replace('sub_', '', $childModule));?>
    <div class='panel-heading'>
      <i class='icon-check'></i>
      <?php if($mode == 'edit'):?>
      <span class='title'><span class='title-bar'><strong><?php echo $blockTitle;?></strong><i class='icon-move'></i></span></span>
      <?php else:?>
      <strong><?php echo $blockTitle;?></strong>
      <?php endif;?>
    </div>

    <?php /* Begin foreach of childFields. */ ?>
    <?php foreach($childFields as $key => $field):?>
    <?php if($mode == 'view' && !$field->show) continue;?>
    <?php if($action->action != 'view' && strpos(",{$disabledFields},", ",{$key},") !== false) continue;?>
    <?php $show = $field->show == '1';?>
    <div class='clearfix col <?php echo ($show ? '' : ' disabled');?>' data-fixed='<?php echo $fixed;?>' data-key='<?php echo $key;?>'>
      <i class='icon-check'></i>

      <?php /* Row title. */ ?>
      <?php if($mode == 'edit'):?>
      <span class='title'><span class='title-bar'><strong><?php echo $field->name;?></strong><i class='icon-move'></i></span></span>
      <?php else:?>
      <strong><?php echo $field->name;?></strong>
      <?php endif;?>

      <?php /* Row actions. */ ?>
      <div class='actions pull-right'>

        <?php if($required):?>
        <span class='text-muted'><?php echo '(' . $lang->workflowlayout->require . ')';?></span>
        <?php endif;?>

        <?php if($action->action == 'view'):?>
        <?php /* Width. */ ?>
        <span>
          <span class='text-muted'><?php echo $lang->workflowlayout->width;?></span>
          <?php echo html::input("subTables[$childModule][width][$key]", $field->width, "class='form-control' $disabled");?>
        </span>

        <?php /* Display in mobile device. */ ?>
        <span>
          <span class='text-muted'><?php echo $lang->workflowlayout->mobileShow;?></span>
          <?php echo html::select("subTables[$childModule][mobileShow][$key]", $lang->workflowlayout->mobileList, zget($field, 'mobileShow', 0), "class='form-control' $disabled");?>
        </span>
        <?php endif;?>

        <?php if($key != 'file' and !is_numeric($key) and $action->action != 'view'):?>
        <?php /* Layout rules. */ ?>
        <span>
          <span class='text-muted'><?php echo $lang->workflowlayout->layoutRules;?></span>
          <?php echo html::select("subTables[$childModule][layoutRules][$key][]", $rules, $field->layoutRules, "id='layoutRules' class='form-control chosen' multiple='multiple' $disabled");?>
        </span>

        <?php /* Default value. */ ?>
        <span>
          <span class='text-muted'><?php echo $lang->workflowlayout->defaultValue;?></span>
          <?php
          if($field->control == 'checkbox')
          {
              echo html::select("subTables[$childModule][defaultValue][$key][]", $field->options, $field->defaultValue, "id='defaultValue' class='form-control chosen' multiple='multiple' $disabled");
          }
          else
          {
              echo html::select("subTables[$childModule][defaultValue][$key]", array('' => '') + $field->options, $field->defaultValue, "id='defaultValue' class='form-control chosen' $disabled");
          }
          if(in_array($field->control, $dateControlList))
          {
              $class = 'form-' . $field->control;
              echo html::input("subTables[$childModule][defaultValue][$key]", ($field->defaultValue && $field->defaultValue != 'currentTime') ? $field->defaultValue : '', "id='defaultValue' class='form-control $class' $disabled");
          }
          else
          {
              echo html::input("subTables[$childModule][defaultValue][$key]", ($field->defaultValue && strpos(',currentUser,currentDept,currentTime,', ",$field->defaultValue,") === false) ? $field->defaultValue : '', "id='defaultValue' class='form-control' disabled='disabled'");
          }
          $checked = '';
          if(!in_array($field->control, $controlList)) $checked = "checked='checked'";
          if(in_array($field->control, $dateControlList) && !empty($field->defaultValue) && !isset($field->options[$field->defaultValue])) $checked = "checked='checked'";
          ?>
          <input type='checkbox' name="subTables[<?php echo $childModule;?>][custom][<?php echo $key;?>]" value='1' <?php echo "$checked $disabled";?>/> <?php echo $lang->workflowlayout->custom;?>
        </span>
        <?php endif;?>

        <?php /* Readonly. */ ?>
        <?php if($action->type == 'single' && !in_array($action->action, $config->workflowaction->readonlyActions) && $field->field != 'actions'):?>
        <span>
          <?php $checked  = $field->readonly ? "checked='checked'" : '';?>
          <input type='checkbox' name="subTables[<?php echo $childModule;?>][readonly][<?php echo $key;?>]" value='1' <?php echo "$checked $disabled";?>/> <?php echo $lang->workflowlayout->readonly;?>
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
        <?php echo html::hidden("subTables[$childModule][show][$key]",  $show ? '1' : '0');?>

      </div>
    </div>
    <?php endforeach;?>
    <?php /* End foreach of childFields. */ ?>
  </div>
  <?php endforeach;?>
  <?php /* End foreach of subTables. */ ?>
</div>
