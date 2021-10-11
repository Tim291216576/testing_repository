<table class='table table-form'>
  <?php foreach($fields as $field):?>
  <?php if(!$field->show) continue;?>
  <tr>
    <th class='w-100px'><?php echo $field->name;?></th>
    <td>
      <?php echo $this->flow->buildControl($field, '', "data[$field->field]");?>
    </td>
    <td></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <th></th>
    <td class='form-actions'>
      <?php echo baseHTML::submitButton();?>
      <?php echo html::backButton();?>
      <?php echo html::hidden('dataIDList', implode(',', $dataList));?>
    </td>
  </tr>
</table>
