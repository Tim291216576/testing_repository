<?php
/**
 * The feedback view file of custom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     custom
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$oldDir = getcwd();
chdir('../../view/');
include './header.html.php';
chdir($oldDir);
?>
<div id='mainContent' class='main-row'>
  <div class='side-col' id='sidebar'>
    <div class='cell'>
      <div class='list-group'>
        <?php echo html::a(inlink('feedback'), $lang->custom->feedbackReview, '', "class='active'");?>
      </div>
    </div>
  </div>
  <div class='main-col main-content'>
    <form class="load-indicator main-form form-ajax" method='post'>
      <div class='main-header'>
        <div class='heading'>
          <strong><?php echo $lang->custom->feedback . $lang->arrow . $lang->custom->feedbackReview;?></strong>
        </div>
      </div>
      <table class='table table-form mw-900px'>
        <tr>
          <th class='thWidth'><?php echo $lang->custom->feedbackReview;?></th>
          <td class='w-350px'><?php echo html::radio('needReview', $lang->custom->reviewList, $needReview);?></td>
          <td></td>
        </tr>
        <tr <?php if($needReview) echo "class='hidden'"?>>
          <th><?php echo $lang->custom->forceReview;?></th>
          <td><?php echo html::select('forceReview[]', $users, $forceReview, "class='form-control chosen' multiple");?></td>
          <td><?php printf($lang->custom->notice->forceReview, $lang->feedback->common);?></td>
        </tr>
        <tr <?php if(!$needReview) echo "class='hidden'"?>>
          <th><?php echo $lang->custom->forceNotReview;?></th>
          <td><?php echo html::select('forceNotReview[]', $users, $forceNotReview, "class='form-control chosen' multiple");?></td>
          <td><?php printf($lang->custom->notice->forceNotReview, $lang->feedback->common);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->feedback->reviewedByAB;?></th>
          <?php $users[''] = $lang->feedback->deptManager;?>
          <td><?php echo html::select('reviewer', $users, $reviewer, "class='form-control chosen'");?></td>
        </tr>
        <tr>
          <td colspan='2' class='text-center'><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<script>
$(function()
{
    $('#feedbackTab').addClass('btn-active-text');
    $("input[name='needReview']").change(function()
    {
        if($(this).val() == 0)
        {
            $('#forceReview').closest('tr').removeClass('hidden');
            $('#forceNotReview').closest('tr').addClass('hidden');
        }
        else
        {
            $('#forceReview').closest('tr').addClass('hidden');
            $('#forceNotReview').closest('tr').removeClass('hidden');
        }
    })
})
</script>
<?php include '../../../common/view/footer.html.php';?>
