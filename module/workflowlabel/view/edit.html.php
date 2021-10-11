<?php
/**
 * The edit view file of workflowlabel module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowlabel
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('module', $label->module);?>
<form id='ajaxForm' method='post' action='<?php echo inlink('edit', "id=$label->id");?>'>
  <table class='table table-form'>
    <tr class='hide'>
      <td class='w-90px'></td>
      <td></td>
      <td class='w-80px'></td>
      <td></td>
      <td class='w-120px'></td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowlabel->label;?></th>
      <td colspan='3'><?php echo html::input('label', $label->label, "class='form-control'")?></td>
      <td></td>
    </tr>
    <?php $i = 1;?>
    <?php foreach($label->params as $param):?>
    <tr>
      <?php if($i == 1):?>
      <th class='params'><?php echo $lang->workflowlabel->params;?></th>
      <?php else:?>
      <th></th>
      <?php endif;?>
      <?php if($param['field'] == 'deleted'):?>
      <td>
        <?php echo html::select('fields[]', $fields, 'deleted', "class='form-control' disabled")?>
        <?php echo html::hidden('fields[]', 'deleted');?>
      </td>
      <td>
        <?php echo html::select('operators[]', $config->workflowlabel->operatorList, '=', "class='form-control' disabled");?>
        <?php echo html::hidden('operators[]', '=');?>
      </td>
      <td class='value'>
        <?php echo html::select('values[]', $lang->workflowfield->default->options->deleted, '0', "class='form-control' disabled")?>
        <?php echo html::hidden('values[]', '0');?>
      </td>
      <td>
        <a href='javascript:;' class='btn addItem'><i class='icon icon-plus'></i></a>
      </td>
      <?php else:?>
      <td><?php echo html::select('fields[]', $fields, $param['field'], "class='form-control'")?></td>
      <td><?php echo html::select('operators[]', $config->workflowlabel->operatorList, $param['operator'], "class='form-control'");?></td>
      <td class='value'>
        <?php $value = helper::safe64Encode(urlencode($param['value']));?>
        <?php echo $this->fetch('workflowfield', 'ajaxGetFieldControl', "module=$label->module&field=" . $param['field'] . "&value=$value");?>
      </td>
      <td>
        <a href='javascript:;' class='btn addItem'><i class='icon icon-plus'></i></a>
        <a href='javascript:;' class='btn delItem'><i class='icon icon-close'></i></a>
      </td>
      <?php endif;?>
    </tr>
    <?php $i++;?>
    <?php endforeach;?>
    <tr>
      <th></th>
      <td class='form-actions' colspan='4'><?php echo baseHTML::submitButton();?></td>
    <tr>
  </table>
</form>

<?php
$field    = html::select("fields[]", $fields, '', "class='form-control chosen'");
$operator = html::select('operators[]', $config->workflowlabel->operatorList, '', "class='form-control'");
$value    = html::input('values[]', '', "class='form-control'");
$itemRow  = <<<EOT
  <tr>
    <th></th>
    <td>{$field}</td>
    <td> {$operator}</td>
    <td class='value'>{$value}</td>
    <td>
      <a href='javascript:;' class='btn addItem'><i class='icon icon-plus'></i></a>
      <a href='javascript:;' class='btn delItem'><i class='icon icon-close'></i></a>
    </td>
  </tr>
EOT;
js::set('itemRow', $itemRow);
?>
<?php include '../../common/view/footer.modal.html.php';?>
