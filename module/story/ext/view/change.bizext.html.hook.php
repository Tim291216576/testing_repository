<?php if(!empty($config->URAndSR)):?>
<style>
#mainContent .main-form .w-80px{width:100px !important;}
</style>
<?php endif;?>
<?php if($story->type == 'requirement' && !empty($config->URAndSR)):?>
<?php $stories = zget($story, 'stories', array());?>
<li class='active' id='affectedStoryTab'>
  <a data-toggle='tab' href='#affectedStories'>
    <?php echo $lang->story->affectedStories;?>
    <?php $count = count($stories);?>
    <?php if($count > 0):?>
    <span class='label label-danger label-badge label-circle'><?php echo $count;?></span>
    <?php endif;?>
  </a>
</li>

<div class='tab-pane active' id='affectedStories'>
  <table class='table'>
    <thead>
      <tr class='text-center'>
        <th class='c-id'><?php echo $lang->idAB;?></th>
        <th class='text-left'><?php echo $lang->story->title;?></th>
        <th class='c-status'><?php echo $lang->statusAB;?></th>
        <th class='w-100px'><?php echo $lang->story->openedBy;?></th>
        <th class='w-100px'><?php echo $lang->story->lastEditedBy;?></th>
      </tr>
    </thead>
    <tbody class='<?php if(count($stories) > $config->story->affectedFixedNum)  echo "linkbox";?>'>
    <?php foreach($stories as $affectStory):?>
      <tr class='text-center'>
        <td><?php echo $affectStory->id;?></td>
        <td class='text-left'><?php echo html::a($this->createLink('story', 'view', "storyID=$affectStory->id"), $affectStory->title, '_blank');?></td>
        <td>
          <span class='status-case status-<?php echo $affectStory->status?>'><?php echo $this->processStatus('story', $affectStory);?></span>
        </td>
        <td><?php echo zget($users, $affectStory->openedBy);?></td>
        <td><?php echo zget($users, $affectStory->lastEditedBy);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>

<?php
$lang->story->title  = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->title);
$lang->story->spec   = str_replace($lang->storyCommon, $lang->urCommon, $lang->story->spec);
?>
<script>
$('.table .tabs .nav li').removeClass('active');
$('.table .tabs .nav').prepend($('#affectedStoryTab'));
$('.table .tabs .tab-content').prepend($('#affectedStories'));
$('#title').closest('tr').find('th:first').html('<?php echo $lang->story->title;?>');
$('#spec').closest('tr').find('th:first').html('<?php echo $lang->story->spec;?>');
</script>
<?php endif;?>
