<?php
/**
 * The batch operate view file of flow module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     flow 
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include $app->getModuleRoot($flow->app) . 'common/view/header.html.php';?>
<?php if(!empty($flow->css)) css::internal($flow->css);?>
<?php if(!empty($action->css)) css::internal($action->css);?>
<?php js::set('module', $flow->module);?>
<?php js::set('action', $action->action);?>
<?php js::set('batchMode', $action->batchMode);?>
<?php if(!empty($flow->js)) js::execute($flow->js);?>
<?php if(!empty($action->js)) js::execute($action->js);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo str_replace('-', '', $title);?></strong>
  </div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post' action='<?php echo $actionURL;?>'>
      <?php if($action->batchMode == 'same')      include 'samebatch.html.php';?>
      <?php if($action->batchMode == 'different') include 'differentbatch.html.php';?>
    </form>
  </div>
</div>
<?php include $app->getModuleRoot($flow->app) . 'common/view/footer.html.php';?>
