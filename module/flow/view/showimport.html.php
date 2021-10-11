<?php
/**
 * The show import view file of flow module of ZDOO.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     flow
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include $app->getModuleRoot($flow->app) . 'common/view/header.html.php';?>
<?php js::set('module', $flow->module);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo $lang->flow->showImport;?></strong>
  </div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post'>
      <?php if($mode == 'template') include 'templateimport.html.php';?>
      <?php if($mode == 'auto') include 'autoimport.html.php';?>
      <div class='form-actions text-center'>
        <?php echo baseHTML::submitButton($lang->import);?>
        <?php echo html::backButton();?>
      </div>
    </form>
  </div>
</div>
<?php include $app->getModuleRoot($flow->app) . 'common/view/footer.html.php';?>
