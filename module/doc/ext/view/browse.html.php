<?php
$this->app->loadConfig('file');
if(empty($config->file->libreOfficeTurnon) or $config->file->convertType != 'collabora')
{
    unset($lang->doc->typeList['word']);
    unset($lang->doc->typeList['ppt']);
    unset($lang->doc->typeList['excel']);
}
?>
<?php if($type != 'book'):?>
  <?php
  $oldDir = getcwd();
  chdir(dirname(dirname(dirname(__FILE__))) . '/view');
  include './browse.html.php';
  chdir($oldDir);
  ?>
<?php else:?>
  <?php include '../../../common/view/header.html.php';?>
  <?php js::set('browseType', $browseType);?>
  <?php $this->session->set('docList', $this->app->getURI(true));?>
  <?php $spliter = (empty($this->app->user->feedback) && !$this->cookie->feedbackView && $this->from == 'doc') ? true : false;?>
  <div class="main-row fade <?php if($spliter) echo 'split-row';?>" id="mainRow">

    <?php
    $oldDir = getcwd();
    chdir(dirname(dirname(dirname(__FILE__))) . '/view');
    include './side.html.php';
    chdir($oldDir);
    ?>

    <div class="main-col" data-min-width="400">
      <div class="cell<?php if($browseType == 'bysearch') echo ' show';?>" id="queryBox"></div>
      <div class="panel block-files block-sm no-margin">

        <div class="panel-heading">
          <div class="panel-title font-normal">
            <?php if($browseType != 'fastsearch'):?>
            <i class="icon icon-folder-open-o text-muted"></i>
            <?php else:?>
            <i class="icon icon-search text-muted"></i>
            <?php endif;?>
            <?php echo $breadTitle;?>
          </div>
        </div>
        <div class='panel-body'>
          <div class="table-empty-tip">
            <p>
              <span class="text-muted"><?php echo !$spliter ? $lang->doc->feedbackBookTip : $lang->doc->bookBrowseTip;?></span>
              <?php if($spliter):?>
              <?php echo html::a(helper::createLink('doc', 'editLib', "libID=$libID"), "<i class='icon icon-edit'></i>" . $lang->doc->editBook, '',"class='btn btn-info iframe'");?>
              <?php echo html::a(helper::createLink('doc', 'manageBook', "bookID=$libID&nodeID=0"), "<i class='icon icon-cog'></i>" . $lang->doc->manageBook, '',"class='btn btn-info'");?>
              <?php endif;?>
            <p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include '../../../common/view/footer.html.php';?>
<?php endif;?>
<?php if(isset($spliter) and !$spliter):?>
  <script>
  $('.side-col .cell .side-footer').remove();
  $('.side-col .cell .nav li').each(function(index)
  {
      if(index == 0 || index == 1) $(this).remove();
  })
  </script>
<?php endif;?>
