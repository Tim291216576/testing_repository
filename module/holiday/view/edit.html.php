<?php
/**
 * The create view file of holiday module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     attend
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<div class='panel-body'>
    <form id='ajaxForm' method='post' action="<?php echo $this->createLink('holiday', 'edit', "id=$holiday->id")?>">
    <table class='table table-form table-condensed'>
      <tr>
        <th class='w-80px'><?php echo $lang->holiday->type;?></th>
        <td><?php echo html::radio('type', $lang->holiday->typeList, $holiday->type);?></td>
        <td></td>
      </tr>
      <tr>
        <th class='w-80px'><?php echo $lang->holiday->name?></th>
        <td><?php echo html::input('name', $holiday->name, "class='form-control'")?></td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->holiday->begin?></th>
        <td><?php echo html::input('begin', $holiday->begin, "class='form-control form-date'")?></td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->holiday->end?></th>
        <td><?php echo html::input('end', $holiday->end, "class='form-control form-date'")?></td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->holiday->desc?></th>
        <td><?php echo html::textarea('desc', $holiday->desc, "class='form-control'")?></td>
        <td></td>
      </tr> 
      <tr><th></th><td clospan='2'><?php echo baseHTML::submitButton();?></td></tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.modal.html.php';?>
