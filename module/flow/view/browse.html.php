<?php
/**
 * The browse view file of flow module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     flow
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../' . 'common/view/header.html.php';?>

<?php if(!empty($flow->css)) css::internal($flow->css);?>
<?php if(!empty($action->css)) css::internal($action->css);?>
<?php js::set('mode', $mode);?>
<?php js::set('module', $flow->module);?>
<?php js::set('label', $label);?>
<?php if(!empty($flow->js)) js::execute($flow->js);?>
<?php if(!empty($action->js)) js::execute($action->js);?>

<?php /* Search settings. */ ?>
<?php if(commonModel::hasPriv($flow->module, 'search')):?>
<?php if(empty($this->config->{$flow->module}->search['fields'])):?>
<li id='searchTab'><?php echo baseHTML::a('#emptySearchModal', "<i class='icon-search icon'></i>" . $lang->search->common, "data-toggle='modal'");?></li>
<div class='modal fade' id='emptySearchModal'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
        <h4 class='modal-title'>
          <span class='modal-title-name'><?php echo $lang->search->common;?></span>
        </h4>
      </div>
      <div class='modal-body'>
        <?php
        if(commonModel::hasPriv('flow.workflowfield', 'setSearch'))
        {
            $designLink = baseHTML::a($this->createLink('workflowfield', 'setSearch', "module={$flow->module}"), $lang->flow->setSearch, "target='_parent'");
        }
        else
        {
            $designLink = $lang->flow->setSearch;
        }
        echo "<div class='alert'>" . sprintf($lang->flow->tips->emptySearchFields, $designLink) . '</div>';
        ?>
      </div>
    </div>
  </div>
</div>
<?php else:?>
<li id='bysearchTab'><?php echo baseHTML::a('javascript:;', "<i class='icon-search icon'></i>" . $lang->search->common);?></li>
<?php endif;?>
<?php endif;?>

<div id='menuActions'>
<?php
$canImport         = commonModel::hasPriv($flow->module, 'import');
$canExportData     = commonModel::hasPriv($flow->module, 'export');
$canExportTemplate = commonModel::hasPriv($flow->module, 'exporttemplate');
if($canImport or $canExportTemplate)
{
    echo "<div class='btn-group'>";
    echo baseHTML::a('javascript:;', $lang->importIcon . $lang->import . " <span class='caret'></span>", "class='btn btn-secondary dropdown-toggle' data-toggle='dropdown'");
    echo "<ul class='dropdown-menu'>";
    if($canImport) echo '<li>' . baseHTML::a($this->createLink($flow->module, 'import'), $lang->workflowaction->default->actions['import'], "data-toggle='modal'") . '</li>';
    if($canExportTemplate) echo '<li>' . baseHTML::a($this->createLink($flow->module, 'exporttemplate'), $lang->workflowaction->default->actions['exporttemplate'], "class='iframe'") . '</li>';
    echo '</ul></div>';
}
if($canExportData)
{
    echo "<div class='btn-group'>";
    echo baseHTML::a('javascript:;', $lang->exportIcon . $lang->export . " <span class='caret'></span>", "class='btn btn-secondary dropdown-toggle' data-toggle='dropdown'");
    echo "<ul class='dropdown-menu'>";
    echo '<li>' . baseHTML::a($this->createLink($flow->module, 'export', 'mode=all'), $lang->exportAll, "class='iframe'") . '</li>';
    echo '<li>' . baseHTML::a($this->createLink($flow->module, 'export', 'mode=thisPage'), $lang->exportThisPage, "class='iframe'") . '</li>';
    echo '</ul></div>';
}
echo $this->flow->buildOperateMenu($flow, $data = null, $type = 'menu');
?>
</div>
<div class='main-col' data-ride='table'>
  <?php if($batchActions && $dataList):?>
  <form id='batchOperateForm' method='post'>
  <?php endif;?>
  <div class='main-table'>
  <table class='table has-sort-head' id="<?php echo $flow->module;?>Table">
    <thead>
      <tr class='text-center'>
        <?php $vars = "mode=$mode&label=$label&orderBy=%s&recTotal=$pager->recTotal&recPerPage=$pager->recPerPage&pageID=$pager->pageID";?>
        <?php $index = 1;?>
        <?php foreach($fields as $field):?>
        <?php if(!$field->show) continue;?>
        <?php $width = $field->width && $field->width != 'auto' ? $field->width . 'px' : $field->width;?>
        <th class="text-<?php echo $field->position;?>" style="width:<?php echo $width;?>">
          <?php if($index == 1 && $batchActions && $dataList):?>
          <div class='checkbox-primary check-all' title='<?php echo $this->lang->selectAll;?>'><label></label></div>
          <?php endif;?>
          <?php
          if($field->field == 'desc' || $field->field == 'asc' || $field->field == 'actions')
          {
              echo $field->name;
          }
          else
          {
              commonModel::printOrderLink($field->field, $orderBy, $vars, $field->name, $flow->module, 'browse');
          }
          ?>
        </th>
        <?php $index++;?>
        <?php endforeach;?>
      </tr>
    </thead>
    <tbody>
      <?php foreach($dataList as $data):?>
      <tr>
        <?php $index = 1;?>
        <?php foreach($fields as $field):?>
        <?php if(!$field->show || $field->field == 'actions') continue;?>
        <?php
        $output = '';
        if(is_array($data->{$field->field}))
        {
            foreach($data->{$field->field} as $value) $output .= zget($field->options, $value) . ' ';
        }
        else
        {
            if($field->field == 'id')
            {
                if(commonModel::hasPriv($flow->module, 'view'))
                {
                    $output = baseHTML::a(helper::createLink($flow->module, 'view', "dataID={$data->id}"), $data->id);
                }
                else
                {
                    $output = $data->id;
                }
            }
            else
            {
                $output = zget($field->options, $data->{$field->field});
            }
        }
        ?>
        <td class="text-<?php echo $field->position;?>" title='<?php echo strip_tags(str_replace("</p>", "\n", str_replace(array("\n", "\r"), "", $output)));?>'>
          <?php if($index == 1 && $batchActions):?>
          <div class='checkbox-primary'><input type='checkbox' name='dataIDList[]' value='<?php echo $data->id;?>' id='dataIDList<?php echo $data->id;?>'>
            <label for='dataIDList<?php echo $data->id;?>'></label>
          </div>
          <?php endif;?>
          <?php echo $output;?>
        </td>
        <?php $index++;?>
        <?php endforeach;?>
        <td class="nowrap"><?php echo $this->flow->buildOperateMenu($flow, $data, $type = 'browse');?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  </div>
  <div class='table-footer'>
    <?php if($batchActions && $dataList):?>
    <div class='checkbox-primary check-all'><label><?php echo $lang->selectAll?></label></div>
    <div class='table-actions btn-toolbar'>
      <?php echo $batchActions;?>
    </div>
    <?php endif;?>
    <?php if($summary):?>
    <div class='table-statistic'>
      <?php echo $lang->workflowlayout->totalShow . '(' . rtrim($summary, ',') . ')';?>
    </div>
    <?php endif;?>
    <?php $pager->show('right', 'pagerjs');?>
  </div>
  <?php if($batchActions && $dataList):?>
  </form>
  <?php endif;?>
</div>
<?php include '../../' . 'common/view/footer.html.php';?>
