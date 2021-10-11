<?php
$queryBox = "<div class='cell" . ($mode == 'search' ? ' show' : '') . "' data-module='{$flow->module}' id='queryBox'></div>";

$designLink = $lang->flow->setSearch;
if(commonModel::hasPriv('workflowfield', 'setSearch')) $designLink = baseHTML::a($this->createLink('workflowfield', 'setSearch', "module={$flow->module}"), $lang->flow->setSearch, "target='_parent'");

$emptySearch  = "<li id='searchTab'>" . baseHTML::a('#emptySearchModal', "<i class='icon-search icon'></i>" . $lang->search->common, "data-toggle='modal'") . "</li>";
$emptySearch .= "
<div class='modal fade' id='emptySearchModal'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
        <h4 class='modal-title'>
          <span class='modal-title-name'>{$lang->search->common}</span>
        </h4>
      </div>
      <div class='modal-body'>
        <div class='alert'>" . sprintf($lang->flow->tips->emptySearchFields, $designLink) . "</div>
      </div>
    </div>
  </div>
</div>";
?>
<script>
var moduleNavigator = '<?php echo $flow->navigator;?>';
var moduleApp       = '<?php echo $flow->app;?>';
$('.main-table').before(<?php echo json_encode($queryBox);?>);
$('#footer .breadcrumb').append("<li><?php echo $flow->name;?></li>");
$('#bysearchTab').remove();
</script>
<?php if($flow->navigator == 'primary'):?>
<script>
<?php if(common::hasPriv($flow->module, 'search') and empty($this->config->{$flow->module}->search['fields'])):?>
$('[data-id=bysearch]').remove();
<?php endif;?>
</script>
<?php elseif($flow->navigator == 'secondary'):?>
<?php
$featurebar = "<div id='featurebar'><ul class='nav'>";
if(isset($lang->{$flow->module}->featureBar))
{
    foreach($lang->{$flow->module}->featureBar as $key => $menu)
    {
        list($name, $module, $method, $params) = explode('|', $menu);

        $class = ($mode == 'browse' && $key == "browse$label") ? "class='active'" : '';

        if(common::hasPriv($module, $method)) $featurebar .= "<li id='$key' $class>" . baseHTML::a($this->createLink($module, $method, $params), $name) . '</li>';
    }
}

/* Check search privilege. */
if(common::hasPriv($flow->module, 'search'))
{
    if(empty($this->config->{$flow->module}->search['fields']))
    {
        $featurebar .= $emptySearch;
    }
    else
    {
        $class       = $mode == 'search' ? "class='active'" : '';
        $featurebar .= "<li id='bysearch' $class><a class='btn btn-link querybox-toggle' id='bysearchTab'><i class='icon icon-search muted'></i> {$lang->flow->search}</a></li>";
    }
}

$featurebar .= '</ul></div>';
?>
<script>
$('#searchTab').remove();
$(function()
{
    $('#main .container').prepend(<?php echo json_encode($featurebar);?>);
    <?php if(strpos('|product|project|qa|', "|{$flow->app}|") !== false):?>
    $('#pageNav .angle-btn').each(function(i)
    {
        if(i > 0) $(this).hide();
    })
    <?php endif;?>
})
</script>
<?php endif;?>
