<?php
/**
 * The browse view file of workflowfield module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowfield
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../workflow/view/header.html.php';?>
<?php include '../../common/view/sortable.html.php';?>
<div class='space space-sm'></div>
<div class='row'>
  <div class='col-md-7'>
    <div class='panel' id='previewArea'>
      <div class='panel-heading'>
        <strong><?php echo $flow->name;?></strong>
      </div>
      <div class='panel-body'>
        <table class='table table-form'>
          <?php foreach($fields as $field):?>
          <tr>
            <th class='w-100px'><?php echo $field->name;?> </th>
            <td>
            <?php
            if($field->field == 'id' or $field->field == 'parent')
            {
                echo html::input($field->field, $lang->workflowfield->placeholder->auto, "class='form-control' disabled='disabled'");
            }
            else
            {
                echo $this->loadModel('flow')->buildControl($field, '', "preview_{$field->field}", '', true, true);
            }
            ?>
            </td>
            <td class='w-150px'></td>
          </tr>
          <?php endforeach;?>
        </table>
      </div>
    </div>
  </div>
  <div class='col-md-5'>
    <div class='panel'>
      <div class='panel-heading'>
        <?php if($flow->type == 'flow'):?>
        <strong><?php echo $lang->workflowfield->settings;?></strong>
        <?php else:?>
        <div class='btn-toolbar'>
          <?php echo baseHTML::a($this->createLink('workflow', 'browsedb', "parent={$flow->parent}&table={$flow->module}"), $lang->goback, "class='btn btn-back'");?>
          <div class='divider'></div>
          <div class='page-title'><span class='text'><?php echo $flow->name;?></span></div>
        </div>
        <?php endif;?>
        <div class='panel-actions pull-right'>
          <?php extCommonModel::printLink('workflowfield', 'create', "module=$flow->module", '<i class="icon-plus"> </i> ' . $lang->workflowfield->create, "class='btn btn-primary' data-toggle='modal'");?>
        </div>
      </div>
      <div class='panel-body main-table' data-ride='table'>
        <table class='table'>
          <thead>
            <tr>
              <th class='w-50px text-center'> <?php echo $lang->sort;?></th>
              <th><?php echo $lang->workflowfield->name;?></th>
              <th class='w-120px'><?php echo $lang->workflowfield->field;?></th>
              <th class='w-120px'><?php echo $lang->workflowfield->control;?></th>
              <th class='w-80px text-center'><?php echo $lang->actions;?></th>
            </tr>
          </thead>
          <tbody class='sortable' id='fieldList'>
            <?php foreach($fields as $field):?>
            <tr data-id='<?php echo $field->id;?>'>
              <td class='sort-handler text-center'><i class='icon icon-move text-muted'></i></td>
              <td title='<?php echo $field->name;?>'><?php echo $field->name;?></td>
              <td><?php echo $field->field;?></td>
              <td><?php echo zget($lang->workflowfield->controlTypeList, $field->control, '');?></td>
              <td class='actions'>
                <?php
                extCommonModel::printLink('workflowfield', 'edit', "module=$field->module&id=$field->id", $lang->edit, "class='edit' data-toggle='modal'");
                if($field->buildin or isset($config->workflowfield->default->fields[$field->field]))
                {
                    echo baseHTML::a('javascript:;', $lang->delete, "class='deleter disabled'");
                }
                else
                {
                    extCommonModel::printLink('workflowfield', 'delete', "id=$field->id", $lang->delete, "class='deleter'");
                }
                ?>
              </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
