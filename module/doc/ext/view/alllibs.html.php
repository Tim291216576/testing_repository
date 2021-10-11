<?php if($type != 'book'):?>
  <?php
  $oldDir = getcwd();
  chdir(dirname(dirname(dirname(__FILE__))) . '/view');
  include './alllibs.html.php';
  chdir($oldDir);
  ?>
<?php else:;?>
  <?php include '../../../common/view/header.html.php';?>
  <div class="main-row fade" id="mainRow">
    <?php
    $oldDir = getcwd();
    chdir(dirname(dirname(dirname(__FILE__))) . '/view');
    include './side.html.php';
    chdir($oldDir);
    ?>
  
    <?php if($this->cookie->browseType == 'bylist'):?>
    <?php include dirname(__FILE__) . '/alllibsbylist.html.php';?>
    <?php else:?>
    <?php include dirname(__FILE__) . '/alllibsbygrid.html.php';?>
    <?php endif;?>
  </div>
  <?php include '../../../common/view/footer.html.php';?>
<?php endif;?>
<?php $spliter = (empty($this->app->user->feedback) && !$this->cookie->feedbackView) ? true : false;?>
<?php if(!$spliter):?>
<script>
$('.side-col .cell .side-footer').remove();
$('.side-col .cell .nav li').each(function(index)
{
    if(index == 0 || index == 1) $(this).remove();
})
</script>
<?php endif;?>
