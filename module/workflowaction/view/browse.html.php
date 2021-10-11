<?php
/**
 * The browse view file of workflowaction module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowaction
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../workflow/view/header.html.php';?>
<?php js::set('module', $flow->module);?>
<?php js::set('setLayout', $lang->workflowaction->setLayout);?>
<div class='space space-sm'></div>
<div class='row'>
  <div class='col-md-7'>
    <div class='panel' id='previewArea'>
      <div class='panel-heading'></div>
      <div class='panel-body'>
        <div class='layout-buildin-tip text-center text-muted hide'><?php echo $lang->workflowaction->tips->buildin;?></div>
        <div class='layout-empty-tip text-center text-muted hide'><?php echo $lang->workflowaction->tips->emptyLayout;?></div>
        <div class='layout-no-tip text-center text-muted hide'><?php echo $lang->workflowaction->tips->noLayout;?></div>
        <div class='layout-preview hide'></div>
      </div>
    </div>
  </div>
  <div class='col-md-5'>
    <div class='panel main-table' data-ride='table'>
      <div class='panel-heading'>
        <strong><?php echo $lang->workflowaction->settings;?> </strong>
        <div class='panel-actions'><?php extCommonModel::printLink('workflowaction', 'create', "module=$flow->module", "<i class='icon-plus'> </i>" . $lang->workflowaction->create, "class='btn btn-primary' data-toggle='modal' data-width='600'");?></div>
      </div>
      <div class='panel-body'>
        <table class='table has-sort-head table-fixed' id='actionList'>
          <thead>
            <tr>
              <?php $vars="&module=$flow->module&orderBy=%s";?>
              <th><?php commonModel::printOrderLink('name', $orderBy, $vars, $lang->workflowaction->name);?></th>
              <th><?php commonModel::printOrderLink('action', $orderBy, $vars, $lang->workflowaction->action);?></th>
              <?php if($flow->buildin):?>
              <th class='w-100px text-center'><?php commonModel::printOrderLink('buildin', $orderBy, $vars, $lang->workflowaction->buildin);?></th>
              <th class='w-100px text-center'><?php commonModel::printOrderLink('extensionType', $orderBy, $vars, $lang->workflowaction->extensionType);?></th>
              <?php endif;?>
              <th class='text-center' style='width: <?php echo $lang->workflowaction->actionWidth;?>px'><?php echo $lang->actions;?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($actions as $action):?>
            <?php
            $isDefault = in_array($action->action, $config->workflowaction->defaultActions);

            $canSetCondition    = $this->workflowaction->isClickable($action, 'browseCondition');
            $canSetLayout       = $this->workflowaction->isClickable($action, 'admin');
            $canSetLinkage      = $this->workflowaction->isClickable($action, 'browseLinkage');
            $canSetVerification = $this->workflowaction->isClickable($action, 'setVerification');
            $canSetHook         = $this->workflowaction->isClickable($action, 'browseHook');
            $canSetNotice       = $this->workflowaction->isClickable($action, 'setNotice');
            $canSetJS           = $this->workflowaction->isClickable($action, 'setJS');
            $canSetCSS          = $this->workflowaction->isClickable($action, 'setCSS');
            $canDelete          = !$action->buildin && ($flow->buildin or !$isDefault);
            ?>
            <tr data-name='<?php echo $action->name;?>' data-action='<?php echo $action->action;?>' data-buildin='<?php echo $action->buildin;?>' data-extensionType='<?php echo $action->extensionType;?>' data-open='<?php echo $action->open != 'none';?>'>
              <td class='select-action'><?php echo $action->name;?></td>
              <td class='select-action'><?php echo $action->action;?></td>
              <?php if($flow->buildin):?>
              <td class='select-action text-center buildin<?php echo $action->buildin;?>'><?php echo $action->buildin ? "<i class='icon icon-check'></i>" : "<i class='icon icon-times'></i>";?></td>
              <td class='text-center'><?php if($action->buildin) echo zget($lang->workflowaction->extensionTypeList, $action->extensionType, '');?></td>
              <?php endif;?>
              <td class='actions'>
                <?php
                extCommonModel::printLink('workflowaction', 'edit', "id=$action->id", $lang->edit, "class='edit' data-toggle='modal' data-width='600'");

                if($canSetLayout && commonModel::hasPriv('workflowlayout', 'admin'))
                {
                    echo baseHTML::a($this->createLink('workflowlayout', 'admin', "module=$action->module&action=$action->action"), $lang->workflowaction->layout, "class='layout' data-toggle='modal'");
                }
                else
                {
                    echo baseHTML::a('javascript:;', $lang->workflowaction->layout, "class='layout disabled'");
                }

                if($canSetCondition && commonModel::hasPriv('workflowcondition', 'browse'))
                {
                    echo baseHTML::a($this->createLink('workflowcondition', 'browse', "action=$action->id"), $lang->workflowaction->condition, "class='condition' data-toggle='modal'");
                }
                else
                {
                    echo baseHTML::a('javascript:;', $lang->workflowaction->condition, "class='condition disabled'");
                }

                if($canSetVerification && commonModel::hasPriv('workflowaction', 'setVerification'))
                {
                    echo baseHTML::a(inlink('setVerification', "id=$action->id"), $lang->workflowaction->setVerification, "class='verification' data-toggle='modal'");
                }
                else
                {
                    echo baseHTML::a('javascript:;', $lang->workflowaction->setVerification, "class='verification disabled'");
                }
                ?>

                <?php if($canSetLinkage || $canSetHook || $canSetNotice || $canSetJS || $canSetCSS || $canDelete):?>
                <div class='dropdown'>
                  <a href='javascript:;' data-toggle='dropdown' class='moreActions'><?php echo $lang->more;?><span class='caret'></span></a>
                  <ul class='dropdown-menu pull-right'>
                    <?php
                    if($canSetLinkage && commonModel::hasPriv('workflowlinkage', 'browse'))
                    {
                        echo "<li>" . baseHTML::a($this->createLink('workflowlinkage', 'browse', "action=$action->id"), $lang->workflowaction->linkage, "class='linkage' data-toggle='modal'") . "</li>";
                    }

                    if($canSetHook && commonModel::hasPriv('workflowhook', 'browse'))
                    {
                        echo '<li>' . baseHTML::a($this->createLink('workflowhook', 'browse', "action=$action->id"), $lang->workflowaction->hook, "class='hook' data-toggle='modal'") . '</li>';
                    }

                    if($canSetNotice && commonModel::hasPriv('workflowaction', 'setNotice'))
                    {
                        echo '<li>' . baseHTML::a(inlink('setNotice', "id=$action->id"), $lang->workflowaction->setNotice, "class='notice' data-toggle='modal'") . '</li>';
                    }

                    if($canSetJS && commonModel::hasPriv('workflowaction', 'setJS'))
                    {
                        echo '<li>' . baseHTML::a(inlink('setJS', "id=$action->id"), $lang->workflowaction->setJS, "class='js' data-toggle='modal'") . '</li>';
                    }

                    if($canSetCSS && commonModel::hasPriv('workflowaction', 'setCSS'))
                    {
                        echo '<li>' . baseHTML::a(inlink('setCSS', "id=$action->id"), $lang->workflowaction->setCSS, "class='css' data-toggle='modal'") . '</li>';
                    }

                    if($canDelete && commonModel::hasPriv('workflowaction', 'delete'))
                    {
                        echo '<li>' . baseHTML::a(inlink('delete', "id=$action->id"), $lang->delete, "class='deleter'") . '</li>';
                    }
                    ?>
                  </ul>
                </div>
                <?php else:?>
                <a href='javascript:;' data-toggle='dropdown' class='moreActions disabled'><?php echo $lang->more;?><span class='caret'></span></a>
                <?php endif;?>
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
