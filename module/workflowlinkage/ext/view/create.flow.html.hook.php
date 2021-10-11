<?php if(!isonlybody() and !helper::isAjaxRequest()):?>
<?php
$featurebar = "<div id='featurebar'><ul class='breadcrumb'>";
list($name, $module, $method, $params) = explode('|', $lang->workflowfield->menu->flow['link']);
if(common::hasPriv($module, $method))           $featurebar .= "<li>" . baseHTML::a($this->createLink($module, $method, $params), $flow->name) . '</li>';
if(common::hasPriv('workflowaction', 'browse')) $featurebar .= "<li>" . baseHTML::a($this->createLink('workflowaction', 'browse', "module=$flow->module"), $lang->workflowaction->browse) . '</li>';
$featurebar .= "<li>" . $lang->workflowlinkage->create . '</li>';
$featurebar .= '</ul></div>';
?>
<script>
if($('#featurebar').length == 0) $('#main .container').prepend(<?php echo json_encode($featurebar);?>);
$('a[disabled=disabled]').addClass('disabled');
</script>
<?php endif;?>
