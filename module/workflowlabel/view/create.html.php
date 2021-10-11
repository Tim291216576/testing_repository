<?php
/**
 * The create view file of workflowlabel module of ZDOO.
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
<?php js::set('module', $module);?>
<form id='ajaxForm' method='post' action='<?php echo inlink('create', "module=$module");?>'>
  <?php if(empty($config->workflowlabel->featureTipsClosers) || strpos($config->workflowlabel->featureTipsClosers, ",{$this->app->user->account},") === false):?>
  <div class='alert alert-dismissable'>
    <span class='text-muted'><i class='icon-alert icon-md'></i> <?php echo $lang->workflowlabel->placeholder->features;?></span>
    <span class='pull-right remove' data-dismiss='alert' aria-hidden='true'><?php echo $lang->workflowlabel->placeholder->known;?></span>
  </div>
  <?php endif;?>

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
      <td colspan='3'><?php echo html::input('label', '', "class='form-control'")?></td>
      <td></td>
    </tr>
    <tr>
      <th class='params'><?php echo $lang->workflowlabel->params;?></th>
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
      <td><a href='javascript:;' class='btn addItem'><i class='icon icon-plus'></i></a></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::select('fields[]', $fields, '', "class='form-control chosen'")?></td>
      <td><?php echo html::select('operators[]', $config->workflowlabel->operatorList, '', "class='form-control'");?></td>
      <td class='value'><?php echo html::input('values[]', '', "class='form-control'")?></td>
      <td>
        <a href='javascript:;' class='btn addItem'><i class='icon icon-plus'></i></a>
        <a href='javascript:;' class='btn delItem'><i class='icon icon-close'></i></a>
      </td>
    </tr>
    <tr>
      <th></th>
      <td class='form-actions' colspan='4'>
        <?php echo html::hidden('module', $module);?>
        <?php echo baseHTML::submitButton();?>
      </td>
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
    <td>{$operator}</td>
    <td class='value'>{$value}</td>
    <td>
      <a href="javascript:;" class="btn addItem"><i class="icon icon-plus"></i></a>
      <a href="javascript:;" class="btn delItem"><i class="icon icon-close"></i></a>
    </td>
  </tr>
EOT;
js::set('itemRow', $itemRow);
?>
<?php include '../../common/view/footer.modal.html.php';?>
