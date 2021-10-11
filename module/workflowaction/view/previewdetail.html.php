<?php
/**
 * The preview detail view file of flow module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     flow 
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<style>
.preview-content {margin-top: 10px;}
</style>
<div class='preview-content'>
  <div class='main-row'>
    <div class='main-col col-7'>
      <div class='panel panel-block'>
        <div class='panel-heading'><strong><?php echo $lang->workflowlayout->positionList['view']['info'];?></strong></div>
        <div class='panel-body'>
          <?php
          $children = array();
          foreach($fields as $field)
          {
              if(!$field->show) continue;
              if($field->position != 'info') continue;
  
              if(isset($childFields[$field->field]))
              {
                  $children[$field->field] = $field->name;
                  continue;
              }
  
              echo "<p>";
              echo "<strong>{$field->name}</strong>{$lang->colon}{$lang->workflowaction->previewData}";
              echo '</p>';
          }
          ?>
        </div>
      </div>
  
      <?php foreach($children as $child => $childName):?>
      <div class='panel panel-block'>
        <div class='panel-heading'><strong><?php echo $childName;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-fixed'>
            <tr>
            <?php foreach($childFields[$child] as $childField):?>
            <?php if(!$childField->show) continue;?>
            <th style='width: <?php echo $childField->width;?>px'><?php echo $childField->name;?></th>
            <?php endforeach;?>
            </tr>
            <?php for($i = 0; $i < 3; $i++):?>
            <tr>
              <?php
              foreach($childFields[$child] as $childField)
              {
                  if(!$childField->show) continue;
                  echo "<td>{$lang->workflowaction->previewData}</td>";
              }
              ?>
            </tr>
            <?php endfor;?>
          </table>
        </div>
      </div>
      <?php endforeach;?>
  
      <div class='panel panel-block histories'>
        <div class='panel-heading'>
          <strong class='title'><?php echo $lang->history?></strong>
          <button type='button' class='btn btn-mini only-icon btn-reverse' title='<?php echo $lang->reverse;?>'><i class='icon icon-arrow-up'></i></button>
          <button type='button' class='btn btn-mini only-icon btn-expand-all' title='<?php echo $lang->switchDisplay;?>'><i class='icon icon-plus'></i></button>
        </div>
        <div class='panel-body'>
          <ol class='histories-list'>
            <li><?php echo str_replace(array('$date', '$actor'), array(date(DT_DATETIME1), $this->app->user->realname), $lang->action->desc->created);?></li>
          </ol>
        </div>
      </div>
  
      <?php echo $this->flow->buildOperateMenu($flow, $data = null, $type = 'view');?>
    </div>
    <div class='side-col col-5'>
      <div class='panel panel-block'>
        <div class='panel-heading'><strong><?php echo $lang->workflowlayout->positionList['view']['basic'];?></strong></div>
        <div class='panel-body'>
          <table class='table table-data'>
          <?php foreach($fields as $field):?>
          <?php
          if(!$field->show) continue;
          if($field->position != 'basic') continue;
          if(isset($childFields[$field->field])) continue;
          ?>
          <tr>
            <th class='w-80px'><?php echo $field->name;?></th>
            <td><?php echo $lang->workflowaction->previewData;?></td>
          </tr>
          <?php endforeach;?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$('.preview-content a').attr('href', 'javascript:;').removeAttr('onclick').removeClass('deleter');
$('.preview-content a[data-toggle=modal]').removeAttr('data-toggle');
$('.preview-content .main-actions a').attr('class', 'btn');
</script>
