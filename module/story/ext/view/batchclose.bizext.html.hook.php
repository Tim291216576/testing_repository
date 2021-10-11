<?php $story = current($stories);?>
<script>
$(function()
{
    $('#subNavbar [data-id=<?php echo $story->type;?>]').addClass('active')
    <?php if($story->type == 'requirement'):?>
    <?php $lang->story->title  = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->title);?>
    $('form table thead tr:first').find('th').eq(1).html('<?php echo $lang->story->title;?>');
    $('.main-header h2').html($('.main-header h2').html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
    $('#footer .breadcrumb li').eq(3).html($('#footer .breadcrumb li').eq(3).html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
    <?php endif;?>
})
</script>
