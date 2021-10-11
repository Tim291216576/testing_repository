<?php if(!empty($config->URAndSR)):?>
<?php 
$storyLang      = $storyType == 'story' ? $lang->story->createStory : $lang->story->createRequirement;
$singleLink     = $this->createLink('story', 'create', "productID=$productID&branch=$branch&moduleID=$moduleID&storyID=0&projectID=0&bugID=0&planID=0&todoID=0&extra=&type=$storyType");
$batchLink      = $this->createLink('story', 'batchCreate', "productID=$productID&branch=$branch&moduleID=$moduleID&storyID=0&project=0&plan=0&type=$storyType");
$createButton   = html::a($singleLink, "<i class='icon icon-plus'></i> $storyLang", '', "class='btn btn-primary'");
$emptyTipButton = html::a($singleLink, "<i class='icon icon-plus'></i> $storyLang", '', "class='btn btn-info'");

js::set('createButton', $createButton);
js::set('emptyTipButton', $emptyTipButton);
js::set('batchLink', $batchLink);
js::set('storyType', $storyType);
?>
<script>
$('#mainMenu .pull-right .btn-secondary').attr('href', batchLink);
$('#mainMenu .pull-right .btn-primary').replaceWith(createButton);
$('#mainContent .table-empty-tip a').replaceWith(emptyTipButton);

$('#subNavbar .nav li').removeClass('active');
$("#subNavbar .nav li[data-id=" + storyType + ']').addClass('active');
</script>

<?php if($storyType == 'requirement'):?>
<script>
$('.table th.c-stage, .table td.c-stage').remove();
$('.table th.c-plan, .table td.c-plan').remove();
</script>
<?php endif;?>
<?php endif;?>
