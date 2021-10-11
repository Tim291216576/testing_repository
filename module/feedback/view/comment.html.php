<?php
/**
 * The comment view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     feedback
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $title;?></h2>
  </div>
  <form method='post' target='hiddenwin' enctype='multipart/form-data'>
    <table class='table table-form'>
      <?php if($type == 'replied'):?>
      <tr>
        <th><?php echo $lang->feedback->faq;?></th>
        <td><?php echo html::select('faq', $faqs, '',  "class='form-control chosen'");?></td>
      </tr>
      <?php endif;?>
      <tr class='hide'>
        <th><?php echo $lang->feedback->status;?></th>
        <td><?php echo html::hidden('status', $type);?></td>
      </tr>
      <?php if($type != 'commented') $this->printExtendFields($feedback, 'table');?>
      <tr>
        <th><?php echo $title;?></th>
        <td colspan='2'><?php echo html::textarea('comment', '',"rows='5' class='w-p100'");?></td>
      </tr>
      <?php if($type == 'asked'):?>
      <tr>
        <th><?php echo $lang->feedback->files;?></th>
        <td colspan='2'><?php echo $this->fetch('file', 'buildform');?></td>
      </tr>
      <?php endif;?>
      <tr>
        <td colspan='3' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php echo html::backButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.lite.html.php';?>
