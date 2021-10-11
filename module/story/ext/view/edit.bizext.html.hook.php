<?php if(!empty($config->URAndSR)):?>
<style>
.thWidth{width:100px !important;}
.linkThWidth{width:100px !important;}
</style>

<?php /* Code for task: http://pms.zentao.net/task-view-7401.html. */?>
<?php $relations = $this->story->getRelation($story->id, $story->type);?>
<?php js::set('moveSRTips', $lang->story->moveSRTips);?>
<?php js::set('hasSR', ($story->type == 'requirement' and !empty($relations)));?>
<?php if($story->type == 'story' and !empty($relations)):?>
<script>
$('#product').closest('tr').hide();
</script>
<?php endif;?>

<?php endif;?>

<?php if($story->type == 'requirement'):?>
<?php
$lang->story->source = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->source);
$lang->story->title  = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->title);
$lang->story->spec   = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->spec);
$lang->story->legendLifeTime = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->legendLifeTime);
?>
<script>
$(function()
{
    $('#planIdBox').closest('tr').remove();
    $('#source').closest('tr').find('th').html('<?php echo $lang->story->source;?>');
    $('#title').closest('tr').find('th:first').html('<?php echo $lang->story->title;?>');
    $('.main-col .cell .detail:first').find('.detail-title').html('<?php echo $lang->story->spec;?>');
    $('.side-col .cell .detail').eq(1).find('.detail-title').html('<?php echo $lang->story->legendLifeTime;?>');
    $('#footer .breadcrumb li').eq(3).html($('#footer .breadcrumb li').eq(3).html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
    $('#mainContent .main-header h2').html($('#mainContent .main-header h2').html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $lang->urCommon;?>'));
})
</script>
<?php endif;?>
