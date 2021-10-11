<?php
/**
 * The browse view file of workflowlabel module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowlabel 
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../workflow/view/header.html.php';?>
<?php include '../../common/view/sortable.html.php';?>
<?php js::set('module', $flow->module);?>
<div class='space space-sm'></div>
<div class='row'>
  <div class='col-md-7'>
    <div class='panel' id='previewArea'>
      <div class='panel-heading'>
        <strong><?php echo $flow->name;?></strong>
      </div>
      <div class='panel-body'>
        <?php include 'preview.html.php';?>
      </div>
    </div>
  </div>
  <div class='col-md-5'>
    <div class='panel main-table' data-ride='table'>
      <div class='panel-heading'>
        <strong><?php echo $lang->workflowlabel->settings;?></strong>
        <div class='panel-actions'><?php extCommonModel::printLink('workflowlabel', 'create', "module=$flow->module", "<i class='icon-plus'> </i>" . $lang->workflowlabel->create, "class='btn btn-primary' data-toggle='modal' data-width='600'");?></div>
      </div>
      <div class='panel-body'>
        <table class='table'>
          <thead>
            <tr>
              <th class='w-60px text-center'><?php echo $lang->sort;?></th>
              <th class='w-120px'><?php echo $lang->workflowlabel->label;?></th>
              <?php if($flow->buildin):?>
              <th class='w-100px text-center'><?php echo $lang->workflowlabel->buildin;?></th>
              <?php endif;?>
              <th><?php echo $lang->workflowlabel->params;?></th>
              <th class='w-80px text-center'><?php echo $lang->actions;?></th>
            </tr>
          </thead>
          <tbody class='sortable' id='labelList'>
            <?php $index = 1;?>
            <?php foreach($labels as $label):?>
            <tr class='<?php if($index == 1) echo 'active';?>' data-id='<?php echo $label->id;?>'>
              <td class='sort-handler text-center'><i class='icon icon-move text-muted'></i></td>
              <td class='select-label'><?php echo $label->label;?></td>
              <?php if($flow->buildin):?>
              <td class='select-label text-center buildin<?php echo $label->buildin;?>'><?php echo $label->buildin ? "<i class='icon icon-check'></i>" : "<i class='icon icon-times'></i>";?></td>
              <?php endif;?>
              <td class='select-label'>
                <?php foreach($label->params as $param):?>
                <?php  echo $param['field'] . zget($config->workflowlabel->operatorList, $param['operator']) . $param['value'] . ' ';?>
                <?php endforeach;?>
              </td>
              <td class='actions'>
                <?php
                if($label->buildin)
                {
                    echo baseHTML::a('javascript:;', $lang->edit, "class='edit disabled'");
                    echo baseHTML::a('javascript:;', $lang->delete, "class='deleter disabled'");
                }
                else
                {
                    extCommonModel::printLink('workflowlabel', 'edit', "id=$label->id", $lang->edit, "class='edit' data-toggle='modal' data-width='600'");
                    extCommonModel::printLink('workflowlabel', 'delete', "id=$label->id", $lang->delete, "class='deleter'");
                }
                ?>
              </td>
            </tr>
            <?php $index++;?>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php include '../../common/view/footer.html.php';?>
