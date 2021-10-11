<?php if($laneField == 'subStatus'):?>
<?php
$toolbar  = "<div class='btn-toolbar pull-left'>";
foreach($lang->kanbanSetting->modeList as $modeCode => $modeName) $toolbar .= html::a(inlink('kanban', "projectID=$projectID&type=$type&orderBy=$storyOrder&mode=$modeCode"), "<span class='text'>" . $modeName . '</span>', '', "class='btn btn-link" . ($mode == $modeCode ? ' btn-active-text' : '') . "'");
$toolbar .= '</div>';

$dropdownMenus = '';
foreach($lang->project->orderList as $key => $value)
{
    $class = ($type == 'story' and $storyOrder == $key) ? " class='active'" : '';

    $dropdownMenus .= "<li $class>" . html::a(inlink('kanban', "projectID=$projectID&type=story&orderBy=$key&mode=$mode"), $value) . '</li>';
}
$dropdownMenus .= "<li" . ($type == 'assignedTo' ? " class='active'" : '') . ">" . html::a(inlink('kanban', "project=$projectID&type=assignedTo&orderBy=order_desc&mode=$mode"), $lang->project->groups['assignedTo']) . "</li>";
$dropdownMenus .= "<li" . ($type == 'finishedBy' ? " class='active'" : '') . ">" . html::a(inlink('kanban', "project=$projectID&type=finishedBy&orderBy=order_desc&mode=$mode"), $lang->project->groups['finishedBy']) . "</li>";
?>
<script>
$(function()
{
    $('#mainMenu').prepend(<?php echo json_encode($toolbar);?>);
    $('#kanban table thead tr th .dropdown .dropdown-menu').empty().append(<?php echo json_encode($dropdownMenus);?>);
})
</script>
<?php endif;?>
