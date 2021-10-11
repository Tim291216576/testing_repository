<?php
$featurebar = "<div id='featurebar'><ul class='breadcrumb'>";
list($name, $module, $method, $params) = explode('|', $lang->workflowfield->menu->flow['link']);
if(common::hasPriv($module, $method)) $featurebar .= "<li>" . baseHTML::a($this->createLink($module, $method, $params), $flow->name) . '</li>';
if(common::hasPriv('workflowfield', 'browse')) $featurebar .= "<li>" . baseHTML::a($this->createLink('workflowfield', 'browse', "module=$flow->module"), $lang->workflowfield->browse) . '</li>';
$featurebar .= "<li>" . $lang->workflowfield->edit . '</li>';
$featurebar .= '</ul></div>';
?>
<script>
  if($('#featurebar').length == 0) $('#main .container').prepend(<?php echo json_encode($featurebar);?>);
  $('a[disabled=disabled]').addClass('disabled');
  $('#footer .breadcrumb').append("<li><?php echo $lang->workflowfield->edit;?></li>");
</script>
