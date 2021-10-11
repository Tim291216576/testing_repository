<?php
/**
 * The batch edit view of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     task
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php
unset($lang->feedback->statusList['replied']);
unset($lang->feedback->statusList['asked']); 
unset($lang->feedback->statusList['tobug']);
unset($lang->feedback->statusList['tostory']);
unset($lang->feedback->statusList['commenting']);
?>
<div id='mainContent' class='main-content fade'>
  <div class='main-header'>
    <h2>
      <?php echo $lang->feedback->common . $lang->colon . $lang->feedback->batchEdit;?>
    </h2>
  </div>
  <form id='batchEditForm' class='main-form' method='post' target='hiddenwin' action="<?php echo inLink('batchEdit')?>">
    <div class="table-responsive">
      <table class='table table-form table-fixed with-border'>
        <thead>
          <tr>
            <th class='w-50px'><?php echo $lang->idAB;?></th>
            <th class='w-300px'><?php echo $lang->feedback->module?></th>
            <th class='required w-300px'><?php echo $lang->feedback->product?></th>
            <th class='required'><?php echo $lang->feedback->title?></th>
            <th class='w-150px'><?php echo $lang->feedback->assignedTo;?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($feedbacks as $feedback):?>
          <tr>
            <td><?php echo $feedback->id;?></td>
            <td style='overflow:visible'><?php echo html::select("modules[$feedback->id]",  $modules, $feedback->module, "class='form-control chosen'")?></td>
            <td style='overflow:visible'><?php echo html::select("products[$feedback->id]", $products, $feedback->product, "class='form-control chosen'")?></td>
            <td title='<?php echo $feedback->title;?>'><?php echo html::input("titles[$feedback->id]", $feedback->title, "class='form-control' autocomplete='off'");?></td>
            <td style='overflow:visible'><?php echo html::select("assignedTos[$feedback->id]", $users, $feedback->assignedTo, "class='form-control chosen'");?></td>
          </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan='4' class='text-center form-actions'>
              <?php echo html::submitButton();?>
              <?php echo html::backButton();?>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </form>
</div>
<script>
$(function()
{
    $('select[id^=status]').change(function()
    {
        $(this).parent().find('div.closedReason').addClass('hidden');
        if($(this).val() == 'closed')
        {
            $(this).parent().find('div.closedReason').removeClass('hidden');
        }
    })
})
</script>
<?php include '../../common/view/footer.html.php';?>
