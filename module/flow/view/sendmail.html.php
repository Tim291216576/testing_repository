<?php
/**
 * The send mail view file of flow module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     flow
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php $sysURL = commonModel::getSysURL();?>
<?php $link   = $sysURL . $this->createLink("{$flow->module}", 'view', "id={$data->id}");?>
<?php include '../../common/view/mail.header.html.php';?>

<style>
.w-100px{width:100px;}
.table-info{font-size:13px;}
.table-info tr th{text-align:right;width:100px;}
</style>
<tr>
  <td style='padding: 10px; background-color: #F8FAFE; border: none; font-size: 14px; font-weight: 500; border-bottom: 1px solid #e5e5e5;'><?php echo baseHTML::a($link, $mailTitle, "target='_blank'");?></td>
</tr>
<tr>
  <td style='padding: 10px; border: none;'>
    <fieldset style='border: 1px solid #e5e5e5'>
      <div style='padding:5px;'>
        <table class='table table-info'>
        <?php foreach($fields as $field):?>
        <?php if(!$field->show) continue;?>
        <?php if(isset($config->workflowfield->default->fields[$field->field])) continue;?>

        <?php /* Print files. */ ?>
        <?php if($field->field == 'file' && !empty($data->files)):?>
        <tr>
          <th class='w-100px'><?php echo $lang->files;?></th>
          <td>
            <?php 
            foreach($data->files as $file)
            {
                echo '<div>' . baseHTML::a($sysURL . $this->createLink('file', 'download', "fileID=$file->id&module=left"), $file->title, "title='{$file->title}'") . '</div>';
            }
            ?>
          </td>
        </tr>

        <?php /* Print sub tables. */ ?>
        <?php elseif(isset($childFields[$field->field])):?>
        <tr>
          <th><?php echo $field->name;?></th>
          <td class='child'>
            <table class='table table-form table-child' data-child='<?php echo $field->field;?>'>
              <?php $datas = isset($childDatas[$field->field]) ? $childDatas[$field->field] : array('');?>
              <?php foreach($datas as $childData):?>
              <tr>
                <?php foreach($childFields[$field->field] as $childField):?>
                <?php if(!$childField->show) continue;?>
                <?php if($childField->field == 'file') continue;?>
                <?php $childValue = zget($childData, $childField->field, '');?>
                <td>
                  <?php
                  if(is_array($childValue))
                  {
                      foreach($childValue as $v) echo zget($childField->options, $v) . ' ';
                  }
                  else
                  {
                      echo zget($childField->options, $childValue);
                  }
                  ?>
                </td>
                <?php endforeach;?>
              </tr>
              <?php endforeach;?>
            </table>
          </td>
        </tr>
        
        <?php /* Print other fields. */ ?>
        <?php else:?>
        <tr>
          <th class='w-100px'><?php echo $field->name;?></th>
          <td>
            <?php
            $value = zget($data, $field->field, '');
            if(is_array($value))
            {
                foreach($value as $v) echo zget($field->options, $v) . ' ';
            }
            else
            {
                echo zget($field->options, $value);
            }
            ?>
          </td>
        </tr>
        <?php endif;?>
        <?php endforeach;?>
        </table>
      </div>
    </fieldset>
  </td>
</tr>
<?php include '../../common/view/mail.footer.html.php';?>
