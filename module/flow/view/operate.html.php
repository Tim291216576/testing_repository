<?php
/**
 * The operate view file of flow module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     flow 
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php
$isModal = $action->open == 'modal';
$tdClass = $isModal ? '' : "class='w-p50'";
$colspan = $isModal ? '' : "colspan='2'";
if($isModal)
{
    include '../../common/view/header.modal.html.php';
}
else
{
    include '../../' . 'common/view/header.html.php';
}
$editorModule = $action->action == 'edit' ? 'edit' : 'operate';
if(!empty($this->config->flow->editor->$editorModule)) include '../../common/view/kindeditor.html.php';
?>

<?php if(!empty($flow->css)) css::internal($flow->css);?>
<?php if(!empty($action->css)) css::internal($action->css);?>
<?php js::set('module', $flow->module);?>
<?php js::set('action', $action->action);?>
<?php if(!empty($flow->js)) js::execute($flow->js);?>
<?php if(!empty($action->js)) js::execute($action->js);?>
<?php if(!$isModal or $action->position == 'menu'):?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo str_replace('-', '', $title);?></strong>
  </div>
  <div class='panel-body'>
<?php endif;?>
    <form id='ajaxForm' method='post' action='<?php echo $actionURL;?>'>
      <table class='table table-form'>
        <?php if($action->position == 'menu'):?>
        <tr>
          <th class='w-100px'><?php echo $flow->name;?></th>
          <td class='<?php echo $isModal && $action->position != 'menu' ? '' : 'w-p50';?>'><?php echo html::select('dataID', $dataPairs, '', "class='form-control chosen'");?></td>
          <?php if(!$isModal):?>
          <td></td>
          <?php endif;?>
        </tr>
        <?php endif;?>

        <?php $hasChildFields = false;?>
        <?php foreach($fields as $field):?>
        <?php if(!$field->show) continue;?>
        <?php $readonly = $field->readonly;?>
        <?php $value    = $field->defaultValue ? $field->defaultValue : zget($data, $field->field, '');?>

        <?php /* Print files. */ ?>
        <?php if($field->field == 'file'):?>
        <tr>
          <th class='w-100px'><?php echo $lang->files;?></th>
          <td>
            <?php if($readonly) echo $this->fetch('file', 'printFiles', array('files' => $data->files, 'fieldset' => 'false'));?>
            <?php if(!$readonly) echo $this->fetch('file', 'buildForm');?>
          </td>
          <?php if(!$isModal):?>
          <td></td>
          <?php endif;?>
        </tr>

        <?php /* Print sub tables. */ ?>
        <?php elseif(isset($childFields[$field->field])):?>
        <?php $hasChildFields = true;?>
        <tr>
          <th><?php echo $field->name;?></th>
          <td <?php echo $colspan;?> class='child'>
            <table class='table table-form table-child' data-child='<?php echo $field->field;?>'>
              <?php $datas = isset($childDatas[$field->field]) ? $childDatas[$field->field] : array('');?>
              <?php foreach($datas as $childData):?>
              <tr>
                <?php foreach($childFields[$field->field] as $childField):?>
                <?php $childValue = $childField->defaultValue ? $childField->defaultValue : zget($childData, $childField->field, '');?>
                <?php if(!$childField->show) continue;?>
                <?php if($childField->field == 'file') continue;?>
                <td>
                  <?php
                  if($readonly or $childField->readonly)
                  {
                      if(is_array($childValue))
                      {
                          foreach($childValue as $v) echo zget($childField->options, $v) . ' ';
                      }
                      else
                      {
                          echo zget($childField->options, $childValue);
                      }
                      html::hidden("children[$field->field][$childField->field][]", $childValue);
                  }
                  else
                  {
                      echo $this->flow->buildControl($childField, $childValue, $field->field, $field->field);
                  }
                  ?>
                </td>
                <?php endforeach;?>
                <?php if(!$readonly):?>
                <td class='w-100px'>
                  <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
                  <a href='javascript:;' class='btn btn-default delItem'><i class='icon-close'></i></a>
                </td>
                <?php endif;?>
                <td><?php echo html::hidden("children[{$field->field}][id][]", $childData->id);?></td>
              </tr>
              <?php endforeach;?>

              <?php /* Add a empty row of sub table. */ ?>
              <?php if(!$readonly):?>
              <tr>
                <?php foreach($childFields[$field->field] as $childField):?>
                <?php if(!$childField->show) continue;?>
                <?php if($childField->field == 'file') continue;?>
                <td><?php echo $this->flow->buildControl($childField, '', $field->field, $field->field, $emptyValue = true);?></td>
                <?php endforeach;?>
                <td class='w-100px'>
                  <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
                  <a href='javascript:;' class='btn btn-default delItem'><i class='icon-close'></i></a>
                </td>
                <td><?php echo html::hidden("children[{$field->field}][id][]");?></td>
              </tr>
              <?php endif;?>
            </table>
          </td>
        </tr>
        
        <?php /* Print other fields. */ ?>
        <?php else:?>
        <?php
        $attr     = '';
        $relation = zget($relations, $field->field, '');
        if($relation && strpos(",$relation->actions,", ',many2one,') === false)
        {
            $prevDataID = isset($data->{$field->field}) ? $data->{$field->field} : 0;
            $attr       = "class='prevTR' data-prev='{$relation->prev}' data-next='{$relation->next}' data-action='$action->action' data-field='{$relation->field}' data-dataID='$prevDataID'";
        }
        ?>
        <tr <?php echo $attr;?>>
          <th class='w-100px'><?php echo $field->name;?></th>
          <td <?php echo $tdClass;?>>
            <?php
            if($readonly)
            {
                if(is_array($value))
                {
                    foreach($value as $v) echo zget($field->options, $v) . ' ';
                }
                else
                {
                    echo zget($field->options, $value);
                }

                echo html::hidden($field->field, $value);
            }
            else
            {
                echo $this->flow->buildControl($field, $value);
            }
            ?>
          </td>
          <?php if(!$isModal):?>
          <td></td>
          <?php endif;?>
        </tr>
        <?php endif;?>

        <?php endforeach;?>
        <tr>
          <th class='w-100px'><?php echo $lang->workflowaction->toList;?></th>
          <td <?php echo $tdClass;?>>
            <div class='input-group'>
              <?php echo html::select('toList[]', $users, $action->toList, "class='form-control chosen' data-placeholder='{$lang->chooseUserToMail}' multiple");?>
              <?php echo $this->fetch('my', 'buildContactLists');?>
            </div>
          </td>
          <?php if(!$isModal):?>
          <td class='text-important'><?php echo $lang->flow->tips->notice;?></td>
          <?php endif;?>
        </tr>
        <tr>
          <th></th>
          <td <?php echo $colspan;?> class='form-actions'>
            <?php echo baseHTML::submitButton();?>
            <?php if(!$isModal) echo html::backButton();?>
          </td>
        </tr>
      </table>

      <?php /* The table below is used to generate dom when click plus button. */ ?>
      <?php if($hasChildFields):?>
      <?php foreach($childFields as $childModule => $fields):?>
      <table class='table hide table-<?php echo $childModule;?>'>
        <tr>
          <?php foreach($fields as $childField):?>
          <?php if(!$childField->show) continue;?>
          <?php if($childField->field == 'file') continue;?>
          <td><?php echo $this->flow->buildControl($childField, $value, $childModule, $childModule, $emptyValue = true);?></td>
          <?php endforeach;?>
          <td class='w-100px'>
            <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
            <a href='javascript:;' class='btn btn-default delItem'><i class='icon-close'></i></a>
          </td>
          <td><?php echo html::hidden("children[{$childModule}][id][]");?></td>
        </tr>
      </table>
      <?php endforeach;?>
      <?php endif;?>
    </form>
<?php if(!$isModal):?>
  </div>
</div>
<?php endif;?>
<?php if($script) echo $script;?>
<script>
<?php if($isModal):?>
<?php else:?>
$(document).on('click', 'td.child .addItem', function()
{  
    var child = $(this).parents('table').data('child');    
    $(this).closest('tr').after($('.table-'+ child +' tbody').html());
    $(this).closest('tr').next().find('.chosen').next('.chosen-container').remove();
    $(this).closest('tr').next().find('.chosen').chosen();
    $(this).closest('tr').next().find('.form-date, .form-datetime').datetimepicker(
    {
        language:  config.clientLang,
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        format: 'yyyy-mm-dd'
    });        
});

$(document).on('click', 'td.child .delItem', function()
{  
    if($(this).parents('.table-child').find('tr').size() > 1)
    {
        $(this).closest('tr').remove();
    }
    else
    {
        $(this).closest('tr').find('input,select,textarea').val('');
    }
})

<?php endif;?>
</script>
<?php if($isModal):?>
<?php include '../../common/view/footer.modal.html.php';?>
<?php else:?>
<?php include '../../' . 'common/view/footer.html.php';?>
<?php endif;?>
