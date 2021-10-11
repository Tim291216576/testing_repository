<?php
/**
 * The create view file of flow module of ZDOO.
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
<?php if(!empty($this->config->flow->editor->create)) include '../../common/view/kindeditor.html.php';?>
<?php if(!empty($flow->css)) css::internal($flow->css);?>
<?php if(!empty($action->css)) css::internal($action->css);?>
<?php js::set('module', $flow->module);?>
<?php js::set('action', $action->action);?>
<?php if(!empty($flow->js)) js::execute($flow->js);?>
<?php if(!empty($action->js)) js::execute($action->js);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo str_replace('-', '', $title);?></strong>
  </div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post' action='<?php echo $actionURL;?>'>
      <table class='table table-form'>
        <?php $hasChildFields = false;?>
        <?php $hasPrevField   = false;?>

        <?php foreach($fields as $field):?>
        <?php
        if(!$field->show) continue;
        $value = $field->defaultValue;
        if($field->field == $prevField)
        {
            $hasPrevField = true;
            $value        = $prevDataID;
        }
        ?>

        <?php /* Print files. */ ?>
        <?php if($field->field == 'file'):?>
        <tr>
          <th class='w-100px'><?php echo $lang->files;?></th>
          <td><?php echo $this->fetch('file', 'buildForm');?></td>
          <td></td>
        </tr>

        <?php /* Print sub tables. */ ?>
        <?php elseif(isset($childFields[$field->field])):?>
        <?php $hasChildFields = true;?>
        <tr>
          <th><?php echo $field->name;?></th>
          <td colspan='2' class='child'>
            <table class='table table-form table-child' data-child='<?php echo $field->field;?>'>
              <?php /* Add a empty row of sub table. */ ?>
              <tr>
                <?php foreach($childFields[$field->field] as $childField):?>
                <?php if(!$childField->show) continue;?>
                <td><?php echo $this->flow->buildControl($childField, '', $field->field, $field->field, $emptyValue = true);?></td>
                <?php endforeach;?>
                <td class='w-100px'>
                  <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
                  <a href='javascript:;' class='btn btn-default delItem'><i class='icon-close'></i></a>
                </td>
                <td><?php echo html::hidden("children[{$field->field}][id][]", '');?></td>
              </tr>

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
            $attr = "class='prevTR' data-prev='{$relation->prev}' data-next='{$relation->next}' data-action='$action->action' data-field='{$relation->field}' data-dataID='$prevDataID'";
        }
        ?>
        <tr <?php echo $attr;?>>
          <th class='w-100px'><?php echo $field->name;?></th>
          <td class='w-p50'>
            <?php
            if($field->readonly)
            {
                if(is_array($value))
                {
                    foreach($value as $v) echo zget($field->options, $v) . ' ';
                }
                else
                {
                    echo zget($field->options, $value);
                }
            }
            else
            {
                echo $this->flow->buildControl($field, $value);
            }
            ?>
          </td>
          <td></td>
        </tr>
        <?php endif;?>
        <?php endforeach;?>

        <tr>
          <th class='w-100px'><?php echo $lang->workflowaction->toList;?></th>
          <td class='w-p50'>
            <div class='input-group'>
              <?php echo html::select('toList[]', $users, $action->toList, "class='form-control chosen' data-placeholder='{$lang->chooseUserToMail}' multiple");?>
              <?php echo $this->fetch('my', 'buildContactLists');?>
            </div>
          </td>
          <td class='text-important'><?php echo $lang->flow->tips->notice;?></td>
        </tr>
        <tr>
          <th></th>
          <td class='form-actions'>
            <?php if($prevField && !$hasPrevField) echo html::hidden($prevField, is_array($prevDataID) ? helper::jsonEncode($prevDataID) : $prevDataID);?>
            <?php echo baseHTML::submitButton();?>
            <?php echo html::backButton();?>
          </td>
        </tr>
      </table>

      <?php /* The table below is used to generate dom when click plus button. */?>
      <?php if($hasChildFields):?>
      <?php foreach($childFields as $childModule => $fields):?>
      <table class='table hide table-<?php echo $childModule;?>'>
        <tr>
          <?php foreach($fields as $field):?>
          <?php if(!$field->show) continue;?>
          <td><?php echo $this->flow->buildControl($field, '', $field->field, $childModule, $emptyValue = true);?></td>
          <?php endforeach;?>
          <td class='w-100px'>
            <a href='javascript:;' class='btn btn-default addItem'><i class='icon-plus'></i></a>
            <a href='javascript:;' class='btn btn-default delItem'><i class='icon-close'></i></a>
          </td>
          <td><?php echo html::hidden("children[{$childModule}][id][]", '');?></td>
        </tr>
      </table>
      <?php endforeach;?>
      <?php endif;?>
    </form>
  </div>
</div>
<?php if($script) echo $script;?>
<script>
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

</script>
<?php include '../../' . 'common/view/footer.html.php';?>
