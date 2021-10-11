<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php if(isset($ganttType)):?>
    <?php echo html::a('javascript:updateCriticalPath()', $lang->project->gantt->showCriticalPath, '', "class='btn btn-link' id='criticalPath'");?>
    <?php echo html::a('###', $lang->project->gantt->fullScreen, '', "class='btn btn-link' id='fullScreenBtn'");?>
    <div class='btn btn-link'>
      <strong><?php echo $lang->project->gantt->format . '：';?></strong>
      <?php echo html::radio('zooming', $lang->project->gantt->zooming, 'day', "onchange='zoomTasks(this)'");?>
    </div>
    <div class='btn btn-link' id='ganttPris'>
      <strong><?php echo $lang->task->pri . " : "?></strong>
      <?php foreach($lang->project->gantt->color as $pri => $color):?>
      <span style="background:#<?php echo $color?>"><?php echo $pri;?></span> &nbsp;
      <?php endforeach;?>
    </div>
    <?php else:?>
    <?php echo html::a($this->createLink('project', 'gantt', "projectID=$projectID"), $lang->project->gantt->common, '', "class='btn btn-link'");?>
    <?php endif;?>
  </div>
  <div class="btn-toolbar pull-right">
    <?php if(common::hasPriv('project', 'relation')) echo html::a($this->createLink('project', 'relation', "projectID=$projectID"), "<i class='icon icon-list-alt muted'></i> " . $lang->project->gantt->relation, '', "class='btn btn-link'");?>
    <div class="btn-group">
      <button class="btn btn-link" data-toggle="dropdown"><i class="icon icon-export muted"></i> <span class="text"><?php echo $lang->export ?></span> <span class="caret"></span></button>
      <ul class="dropdown-menu" id='exportActionMenu'>
        <li><a href='javascript:exportGantt()'><?php echo $lang->project->gantt->exportImg;?></a></li>
        <li><a href='javascript:exportGantt("pdf")'><?php echo $lang->project->gantt->exportPDF;?></a></li>
      </ul>
    </div>
    <?php
    $checkObject = new stdclass();
    $checkObject->project = $projectID;
    $misc = common::hasPriv('task', 'create', $checkObject) ? "class='btn btn-primary iframe' data-width='1200px'" : "class='btn btn-primary disabled'";
    $link = common::hasPriv('task', 'create', $checkObject) ?  $this->createLink('task', 'create', "project=$projectID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : ''), '', true) : '#';
    echo html::a($link, "<i class='icon icon-plus'></i>" . $lang->task->create, '', $misc);
    ?>
  </div>
</div>
