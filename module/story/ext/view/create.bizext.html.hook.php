<?php if($type == 'requirement'):?>
<?php
$lang->story->source = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->source);
$lang->story->title  = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->title);
$lang->story->spec   = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->spec);
?>
<script>
$(function()
{
    var sourceTd = $('td.sourceTd');
    $('#assignedTo').closest('tr').append(sourceTd);
    $('#planIdBox').closest('tr').remove();
    $('#source').closest('.input-group').find('.input-group-addon:first').html('<?php echo $lang->story->source;?>');
    $('#title').closest('tr').find('th:first').html('<?php echo $lang->story->title;?>');
    $('#spec').closest('tr').find('th:first').html('<?php echo $lang->story->spec;?>');
    $('#footer .breadcrumb li').eq(3).html($('#footer .breadcrumb li').eq(3).html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
    $('#mainContent .main-header h2').html($('#mainContent .main-header h2').html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
})
</script>
<?php endif;?>
