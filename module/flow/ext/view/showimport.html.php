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
<?php include $app->getModuleRoot() . 'common/view/header.html.php';?>
<?php js::set('module', $flow->module);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo $lang->flow->showImport;?></strong>
  </div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post'>
      <?php $insert = true;?>
      <?php if($mode == 'template') include '../../view/templateimport.html.php';?>
      <?php
      if($mode == 'auto')
      {
          include '../../view/autoimport.html.php';
          foreach($dataList as $key => $data)
          {
              if(!empty($data['id']))
              {
                  $insert = false;
                  break;
              }
          }
      }
      ?>
      <div class='form-actions text-center'>
        <?php
        if(!$insert)
        {
            echo "<button type='button' data-toggle='modal' data-target='#importNoticeModal' class='btn btn-primary btn-wide'>{$lang->save}</button>";
        }
        else
        {
            echo baseHTML::submitButton($lang->import);
        }
        ?>
        <?php echo html::backButton();?>
      </div>
      <?php if(!$insert) include $app->getModuleRoot() . 'common/view/noticeimport.html.php';?>
    </form>
  </div>
</div>
<script>
$.fn.extend(
{
    datatable:function(e,s){return false;}
});
</script>
<?php include $app->getModuleRoot() . 'common/view/footer.html.php';?>
