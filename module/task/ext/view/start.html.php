<?php $message = $this->task->checkDepend($task->id, 'begin');?>
<?php if($message):?>
<?php include '../../../common/view/header.lite.html.php';?>
<div id='mainContent' class='main-content'>
  <div class="alert with-icon">
    <i class="icon-exclamation-sign"></i>
    <div class="content">
      <p><?php echo str_replace('\n', '<br />', $message);?></p>  
    </div>
  </div>
</div>
<?php include '../../../common/view/footer.lite.html.php';?>
<?php else:?>
<?php
$oldDir = getcwd();
chdir(dirname(dirname(dirname(__FILE__))) . '/view');
include './start.html.php';
chdir($oldDir);
?>
<?php endif;?>
