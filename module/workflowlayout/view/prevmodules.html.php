<div id='prevModules-list'>
  <?php /* Begin foreach of prevModules. */ ?>
  <?php foreach($prevModules as $prevModule => $prevFields):?>
  <div class='prev cols-list prev-<?php echo $prevModule;?>' data-module="<?php echo $prevModule;?>">

    <?php /* Block Title */ ?>
    <?php $blockTitle = $lang->workflowrelation->prev . $lang->colon . zget($flowPairs, $prevModule);?>
    <div class='panel-heading'>
      <i class='icon-check'></i>
      <?php if($mode == 'edit'):?>
      <span class='title'><span class='title-bar'><strong><?php echo $blockTitle;?></strong><i class='icon-move'></i></span></span>
      <?php else:?>
      <strong><?php echo $blockTitle;?></strong>
      <?php endif;?>
    </div>

    <?php /* Begin foreach of prevFields. */ ?>
    <?php foreach($prevFields as $key => $field):?>
    <?php if($mode == 'view' && !$field->show) continue;?>
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
        <?php echo html::hidden("prevModules[$prevModule][show][$key]",  $show ? '1' : '0');?>

      </div>
    </div>
    <?php endforeach;?>
    <?php /* End foreach of prevFields. */ ?>
  </div>
  <?php endforeach;?>
  <?php /* End foreach of prevModules. */ ?>
</div>
