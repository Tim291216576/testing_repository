<?php if(!empty($config->URAndSR)):?>
<?php 
$createLang     = $story->type == 'story' ? $lang->story->createStory : $lang->story->createRequirement;
$link           = $this->createLink('story', 'create', "productID=$story->product&branch=$story->branch&moduleID={$story->module}&storyID=0&projectID=0&bugID=0&planID=0&todoID=0&extra=&type=$story->type");
$createButton   = html::a($link, "<i class='icon icon-plus'></i> $createLang", '', "class='btn btn-primary'");
$relations      = $this->story->getRelation($story->id, $story->type);

js::set('createButton', $createButton);
?>

<li class='active hidden' id='legendStoriesTab'><a href='#legendStories' data-toggle='tab'><?php echo $story->type == 'story' ? $lang->story->ur : $lang->story->sr;?></a></li>
<div class='tab-pane active hidden' id='legendStories'>
  <ul class="list-unstyled">
    <?php
    if($relations)
    {
        foreach($relations as $id => $title) echo "<li title='$title'>" . html::a($this->createLink('story', 'view', "id=$id", '', true), "#$id $title", '', "class='iframe' data-width='80%'");
    }
    ?>  
  </ul> 
</div>

<?php if(($story->status == 'draft') && ($story->type == 'requirement')):?>
<script>
$('.main-actions .btn-toolbar>a.divideStory').remove();
</script>
<?php endif;?>

<?php if($story->type == 'requirement'):?>
<?php
$lang->story->source = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->source);
$lang->story->title  = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->title);
$lang->story->spec   = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->spec);
$lang->story->legendLifeTime = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->legendLifeTime);
?>
<script>
$('tr.plan-line').remove();
$('.main-col .cell .detail:first').find('.detail-title').html('<?php echo $lang->story->spec;?>');
$('#legendBasicInfo table.table-data tr').eq(2).find('th').html('<?php echo $lang->story->source;?>');
$('[href="#legendLifeTime"]').html('<?php echo $lang->story->legendLifeTime;?>')
</script>
<?php endif;?>

<style>
#legendStories ul li{padding: 10px 0 0 12px; line-height: 20px}
#legendRelated .thWidth{width:90px !important;}
</style>
<script>
$('#mainMenu .pull-right .btn-primary').replaceWith(createButton);
$('.side-col .cell:eq(1) .nav li').removeClass('active');
$('.side-col .cell:eq(1) .nav').prepend($('#legendStoriesTab'));
$('.side-col .cell:eq(1) .tab-content').prepend($('#legendStories'));
$('#legendStoriesTab, #legendStories').removeClass('hidden');
</script>
<?php endif;?>
