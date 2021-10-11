<?php
/**
 * The task group view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Guangming Sun <sunguangming@cnezsoft.com>
 * @package     project
 * @version     $Id: taskeffort.html.php 7713 2019-03-27 09:41:06Z sunguangming@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datatable.html.php';?>
<?php js::set('left', $lang->task->leftAB);?>
<?php js::set('consumed', $lang->task->consumedAB);?>
<?php $weekend = $type == 'noweekend' ? 'withweekend' : 'noweekend'?>
<?php $countDays = 0;?>
<div id="mainMenu" class="clearfix table-row">
  <div class="btn-toolbar pull-left">
    <?php common::printLink('project', 'computeTaskEffort', 'reload=yes', '<i class="icon icon-refresh"></i> ' . $lang->project->computeTaskEffort, 'hiddenwin', "title='{$lang->project->computeTaskEffort}' class='btn btn-primary' id='computeBurn'");?>
    <?php echo html::a($this->createLink('project', 'taskeffort', "projectID=$projectID&group=story&type=$weekend"), $lang->project->$weekend, '', "class='btn btn-link'");?>
  </div>
  <div class="btn-toolbar pull-right">
    <?php
    $checkObject = new stdclass();
    $checkObject->project = $projectID;
    $link = $this->createLink('task', 'create', "project=$projectID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : ''));
    if(common::hasPriv('task', 'create', $checkObject)) echo html::a($link, "<i class='icon icon-plus'></i> {$lang->task->create}", '', "class='btn btn-primary'");
    ?>
  </div>
</div>
<div id='tasksTable' class='main-table load-indicator loading' data-ride='table' data-checkable='false' data-group='true' data-hot='true'>
  <?php if(empty($tasks)):?>
  <div class="table-empty-tip">
    <p>
      <span class="text-muted"><?php echo $lang->task->noTask;?></span>
      <?php if(common::hasPriv('task', 'create', $checkObject)):?>
      <?php echo html::a($this->createLink('task', 'create', "project=$projectID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : '')), "<i class='icon icon-plus'></i> " . $lang->task->create, '', "class='btn btn-info'");?>
      <?php endif;?>
    </p>
  </div>
  <?php else:?>
  <?php if($day < 0):?>
  <div class="table-empty-tip">
    <p>
      <span class="text-muted"><?php echo $lang->project->noStart;?></span>
    </p>
  </div>
  <?php else:?>
  <div class='scroll-table scrollbar-hover'>
    <table class="table table-grouped text-center datatable table-bordered" data-fixed-left-width='400'>
      <thead>
        <tr>
          <th class='has-btn group-menu' rowspan='2'>
            <div class="dropdown">
              <a href="" data-toggle="dropdown" class="btn text-left btn-block btn-link clearfix">
                <span class='pull-left'><?php echo zget($lang->project->groups, $groupBy, null);?></span>
                <i class="icon icon-caret-down hl-primary text-primary pull-right"></i>
              </a>
              <ul class="dropdown-menu">
                <?php foreach($lang->project->groups as $key => $value):?>
                <?php
                if(empty($key)) continue;
                if($project->type == 'ops' && $key == 'story') continue;
                $active = $key == $groupBy ? "class='active'" : '';
                echo "<li $active>"; common::printLink('project', 'taskeffort', "project=$projectID&groupBy=$key", $value); echo '</li>';
                ?>
                <?php endforeach;?>
              </ul>
            </div>
          </th>
          <th class="w-200px text-center" data-flex='false' data-width='auto' rowspan='2'><?php echo $lang->task->common;?></th>
          <?php $date = $project->begin;?>
          <?php for($j = 0; $j <= $day; $j++):?>
          <?php 
          $isWeekend = $this->project->judgeWeekend($date, $type); 
          if($isWeekend) 
          {
              $date = date("Y-m-d", strtotime($date) + 3600 * 24);
              continue;
          }
          ?>
          <th class="date text-center" data-flex='true' data-width='115' colspan='2'><?php echo substr($date, 5, 11);?></th>
          <?php $date = date("Y-m-d", strtotime($date) + 3600 * 24);?>
          <?php if($j > 0) $countDays ++;?>
          <?php endfor;?>
        </tr>
      </thead>
      <tbody>
        <?php $groupIndex = 1;?>
        <?php foreach($tasks as $groupKey => $groupTasks):?>
        <?php
        $groupName = $groupKey;
        if($groupBy == 'story') $groupName = empty($groupName) ? $this->lang->task->noStory : zget($groupByList, $groupKey);
        if($groupBy == 'assignedTo' and $groupName == '') $groupName = $this->lang->task->noAssigned;
        ?>
        <?php
        $groupSum = 0;
        $groupSum = count($groupTasks);
        ?>
        <?php $i = 0;?>
        <?php foreach($groupTasks as $task):?>
        <?php $assignedToClass = $task->assignedTo == $app->user->account ? "style='color:red'" : '';?>
        <?php $taskLink        = $this->createLink('task','view',"taskID=$task->id"); ?>
        <tr data-id='<?php echo $groupIndex?>'>
          <td class='group-content'>
            <div class='group-header'>
              <?php echo html::a('###', $groupName, '', "class='text-primary' title='$groupName'");?>
              <div class='groupSummary small'>

              <?php if($groupBy == 'assignedTo' and isset($members[$task->assignedTo])) printf($lang->project->memberHoursAB, $users[$task->assignedTo], $members[$task->assignedTo]->totalHours);?>
              </div>
            </div>
          </td>
          <td class='c-name'>
          <?php
            if(isset($task->multiple)) echo '<span class="label label-light label-badge">' . $lang->task->multipleAB . '</span> ';
            if($task->parent > 0) echo '<span class="label label-light label-badge">' . $lang->task->childrenAB . '</span> ';
            if($task->parent == -1) echo '<span class="label">' . $lang->task->parentAB . '</span> ';
            if(!common::printLink('task', 'view', "task=$task->id", $task->name)) echo $task->name;
          ?>
          </td>
          <?php $date = $project->begin;?>
          <?php for($j = 0; $j <= $day; $j++):?>
          <?php 
          $isWeekend = $this->project->judgeWeekend($date, $type); 
          if($isWeekend) 
          {
              $date = date("Y-m-d", strtotime($date) + 3600 * 24);
              continue;
          }
          ?>
          <td class='c-date text-center'>
            <?php echo isset($task->$date) ? ($task->$date->consumed ? $task->$date->consumed : 0) : '';?> 
            <?php echo html::hidden("left[$j]", isset($task->$date) ? ($task->$date->left ? $task->$date->left : 0) : '')?> 
          </td>
          <?php $date = date("Y-m-d", strtotime($date) + 3600 * 24);?>
          <?php endfor;?>
        </tr>
        <?php $i++;?>
        <?php endforeach;?>
        <?php $groupIndex ++;?>
        <?php endforeach;?>
        <tr>
          <td class='group-content text-center' colspan='2'> <?php echo $lang->team->totalHours?></td>
          <?php $date = $project->begin;?>
          <?php for($j = 0; $j <= $day; $j++):?>
          <?php 
          $isWeekend = $this->project->judgeWeekend($date, $type); 
          if($isWeekend) 
          {
              $date = date("Y-m-d", strtotime($date) + 3600 * 24);
              continue;
          }
          ?>
          <td class='c-date text-center'>
          <?php echo isset($counts->$date) ? (!empty($counts->$date->countConsumed) ? $counts->$date->countConsumed : 0) : '';?>
          <?php echo html::hidden("countLeft[$j]", isset($counts->$date) ? (!empty($counts->$date->countLeft) ? $counts->$date->countLeft : 0) : '')?> 
          </td>
          <?php $date = date("Y-m-d", strtotime($date) + 3600 * 24);?>
          <?php endfor;?>
        </tr>
      </tbody>
    </table>
  </div>
  <?php endif;?>
  <?php endif;?>
</div>
<?php js::set('day', $countDays)?>
<?php include '../../../common/view/footer.html.php';?>
