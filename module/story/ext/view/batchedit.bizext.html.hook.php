<?php $story = current($stories);?>
<script>
$(function()
{
    $('#subNavbar [data-id=<?php echo $story->type;?>]').addClass('active')
    <?php if($story->type == 'requirement'):?>
    <?php
    $lang->story->source = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->source);
    $lang->story->title  = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->title);
    ?>
    $('#batchEditForm table thead tr:first').find('th').eq(3).html('<?php echo $lang->story->title;?>');
    $('#batchEditForm table thead tr:first').find('th').eq(7).html('<?php echo $lang->story->source;?>');
    $('#batchEditForm table thead tr:first th.col-plan').remove();
    $('.main-header h2').html($('.main-header h2').html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
    $('#footer .breadcrumb li').eq(3).html($('#footer .breadcrumb li').eq(3).html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
    $('#batchEditForm table tbody tr').each(function(){ $(this).find('[id^=plan]').closest('td').remove();});
    var colspan = $('#batchEditForm table tfoot tr:first td:first').attr('colspan');
    $('#batchEditForm table tfoot tr:first td:first').attr('colspan', colspan - 1);
    <?php endif;?>
})
</script>
