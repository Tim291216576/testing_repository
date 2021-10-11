<?php
/**
 * The edit view file of workflowaction module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowaction
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form id='ajaxForm' method='post' action='<?php echo inlink('edit', "id=$action->id");?>'>
  <table class='table table-form' id='actionTable'>
    <tr>
      <th class='w-100px'><?php echo $lang->workflowaction->name;?></th>
      <td><?php echo html::input('name', $action->name, "class='form-control'");?></td>
      <td class='w-40px'></td>
    </tr>
    <?php if(!in_array($action->action, $config->workflowaction->defaultActions)):?>
    <tr>
      <th><?php echo $lang->workflowaction->type;?></th>
      <td><?php echo html::select('type', $lang->workflowaction->typeList, $action->type, "class='form-control'");?></td>
      <td></td>
    </tr>
    <tr <?php if($action->type == 'single') echo "class='hide'";?>>
      <th><?php echo $lang->workflowaction->batchMode;?></th>
      <td><?php echo html::select('batchMode', $lang->workflowaction->batchModeList, $action->batchMode, "class='form-control'");?></td>
      <td></td>
    </tr>
    <?php endif;?>
    <?php if($action->buildin):?>
    <tr>
      <th><?php echo $lang->workflowaction->extensionType;?></th>
      <td><?php echo html::select('extensionType', $lang->workflowaction->extensionTypeList, $action->extensionType, "class='form-control'");?></td>
      <td></td>
    </tr>
    <?php else:?>
    <?php if(!in_array($action->action, $config->workflowaction->defaultActions)):?> 
    <tr>
      <th><?php echo $lang->workflowaction->open;?></th>
      <td>
        <?php if($action->action == 'view') unset($lang->workflowaction->openList['none']);?>
        <?php echo html::select('open', $lang->workflowaction->openList, $action->open, "class='form-control'");?>
      </td>
      <td></td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowaction->position;?></th>
      <td>
        <?php
        $positionList = $lang->workflowaction->positionList;
        if($flow->buildin)
        {
            unset($positionList['menu']);
            unset($positionList['browse']);
            unset($positionList['browseandview']);
        }
        echo html::select('position', $positionList, $action->action == 'browse' ? '' : $action->position, "class='form-control'");
        ?>
      </td>
      <td class='w-40px'><a data-toggle='tooltip' data-tip-class='tooltip-primary' title='<?php echo $lang->workflowaction->tips->position;?>'><i class='icon-question-sign'></i></a></td>
    </tr>
    <?php endif;?>
    <?php endif;?>
    <?php if(!in_array($action->action, $config->workflowaction->noShowActions)):?> 
    <tr>
      <th><?php echo $lang->workflowaction->show;?></th>
      <td><?php echo html::select('show', $lang->workflowaction->showList, $action->show, "class='form-control'");?></td>
      <td class='w-40px'><a data-toggle='tooltip' data-tip-class='tooltip-primary' title='<?php echo $lang->workflowaction->tips->show;?>'><i class='icon-question-sign'></i></a></td>
    </tr>
    <?php endif;?>
    <tr>
      <th><?php echo $lang->workflowaction->desc;?></th>
      <td><?php echo html::textarea('desc', $action->desc, "rows='3' class='form-control'");?></td>
      <td></td>
    </tr>
    <tr>
      <th></th>
      <td class='form-actions'>
        <?php echo html::hidden('module', $action->module);?>
        <?php echo baseHTML::submitButton();?>
      </td>
      <td></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
