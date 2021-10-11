<table class='table table-form'>
  <thead>
    <tr class='text-center'>
      <?php
      foreach($fields as $field)
      {
          if(!$field->show) continue;

          $width    = $field->width == 'auto' ? '' : 'w-' . $field->width . 'px';
          $required = strpos(",$field->rules,", ",$notEmptyRule->id,") !== false ? 'required' : '';
          echo "<th class='$width $required'>$field->name</th>";
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $row = 1;
    foreach($dataList as $data)
    {
        echo '<tr>';

        $index = 1;
        foreach($fields as $field)
        {
            if(!$field->show) continue;

            $value = $field->defaultValue ? $field->defaultValue : zget($data, $field->field, '');

            if($field->control == 'select')
            {
                if($row == 1)
                {
                    $field->tmpOptions = $field->options;
                    unset($field->options['ditto']);
                }
                if($row > 1)
                {
                    $field->options = $field->tmpOptions;
                }
            }

            echo '<td>';

            $control = $this->flow->buildControl($field, $value, "dataList[$data->id][$field->field]");
            $control = str_replace("rows='3'", "rows='1'", $control);

            echo $control;
            if($index == 1) echo "<div id='error{$data->id}'></div>";

            echo '</td>';

            $index++;
        }

        echo '</tr>';

        $row++;
    }
    ?>
  </tbody>
</table>
<div class='form-actions text-center'>
  <?php echo baseHTML::submitButton();?>
  <?php echo html::backButton();?>
</div>
