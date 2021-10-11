<?php
/**
 * The mail file of leave module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chu Jilu <chujilu@cnezsoft.com>
 * @package     customer
 * @version     $Id: sendmail.html.php 867 2010-06-17 09:32:58Z yuren_@126.com $
 * @link        http://www.ranzhi.org
 */
?>
<?php $mailTitle = "{$lang->leave->common}#{$leave->id} " . zget($users, $leave->createdBy) . ' ' . formatTime($leave->begin, DT_DATE1) . '~' . formatTime($leave->end, DT_DATE1);?>
<?php include '../../common/view/mail.header.html.php';?>
<tr>
  <td>
    <table cellpadding='0' cellspacing='0' width='600' style='border: none; border-collapse: collapse;'>
      <tr>
        <td style='padding: 10px; background-color: #F8FAFE; border: none; font-size: 14px; font-weight: 500; border-bottom: 1px solid #e5e5e5;'>
          <?php echo $mailTitle;?>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style='padding: 10px; border: none;'>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $lang->leave->common;?></legend>
      <div style='padding:5px;'>
        <p><?php echo $lang->leave->createdBy . ':' . zget($users, $leave->createdBy)?></p>
        <p><?php echo $lang->leave->status . ':' . zget($lang->leave->statusList, $leave->status)?></p>
        <p><?php echo $lang->leave->type . ':' . zget($lang->leave->typeList, $leave->type)?></p>
        <p><?php echo $lang->leave->date . ':' . formatTime($leave->begin . ' ' . $leave->start, DT_DATETIME2) . '~' . formatTime($leave->end . ' ' . $leave->finish, DT_DATETIME2);?></p>
        <p><?php echo $lang->leave->desc?></p>
        <p><?php echo $leave->desc?></p>
      </div>
    </fieldset>
  </td>
</tr>
<?php include '../../common/view/mail.footer.html.php';?>
