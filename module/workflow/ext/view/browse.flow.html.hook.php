<?php
$class       = $currentApp ? '' : "class='active'";
$method      = 'browseFlow';
$featurabar  = "<div id='featurebar'><ul class='nav'>";
$featurabar .= "<li $class>" . baseHTML::a(inlink($method, "status=&app=&orderBy=$orderBy"), $lang->workflow->all) . '</li>';

$flowApps = $this->workflow->getFlowApps();
foreach($flowApps as $appCode)
{
    $appName = zget($apps, $appCode, '');
    if(!$appName) continue;

    $class = $appCode == $currentApp ? "class='active'" : '';

    $featurabar .= "<li $class>" . baseHTML::a(inlink($method, "status=&app=$appCode&orderBy=$orderBy"), $appName) . '</li>';
}
$featurabar .= "</ul></div>";
?>
<script>
$(function()
{
    if($('#featurebar').length == 0) $('#main .container').prepend(<?php echo json_encode($featurabar);?>);
    $('a[disabled=disabled]').addClass('disabled');
    $('#footer .breadcrumb').append("<li><?php echo $lang->workflow->common;?></li>");
});
</script>
