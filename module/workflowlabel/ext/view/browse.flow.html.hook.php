<?php
$featurebar = "<div id='featurebar'><ul class='breadcrumb'>";
list($name, $module, $method, $params) = explode('|', $lang->workflowfield->menu->flow['link']);
if(common::hasPriv($module, $method)) $featurebar .= "<li>" . baseHTML::a($this->createLink($module, $method, $params), $flow->name) . '</li>';
$featurebar .= "<li>" . $lang->workflowlabel->browse . '</li>';
$featurebar .= '</ul></div>';
?>
<script>
if($('#featurebar').length == 0) $('#main .container').prepend(<?php echo json_encode($featurebar);?>);
$('a[disabled=disabled]').addClass('disabled');
$('#footer .breadcrumb').append("<li><?php echo $lang->workflowlabel->common;?></li>");

$(function()
{
    var html = $('#labelList tr td.actions a.edit:first').html();
    $('#labelList tr td.actions a.edit').attr('title', html).addClass('btn').html("<i class='icon icon-edit'></i>");

    var html = $('#labelList tr td.actions a.deleter:first').html();
    $('#labelList tr td.actions a.deleter').attr('title', html).addClass('btn').html("<i class='icon icon-trash'></i>");
})
</script>
