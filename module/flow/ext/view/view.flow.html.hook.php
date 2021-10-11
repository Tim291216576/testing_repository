<?php if($flowAction->open == 'normal'):?>
<script>
$(function()
{
    var moduleNavigator = '<?php echo $flow->navigator;?>';
    var moduleApp       = '<?php echo $flow->app;?>';

    if(moduleNavigator == 'primary')
    {
        $('#subNavbar li:first').addClass('active');
    }
    else if(moduleNavigator == 'secondary')
    {
        $('#navbar li a[href*=' + moduleApp + ']').parent().addClass('active');
        $('#subNavbar li a[href*=' + module + ']').parent().addClass('active');
    }
})
</script>
<?php endif;?>
<script>
$('#footer .breadcrumb').append(<?php echo json_encode('<li>' . baseHTML::a($this->createLink($flow->module, 'browse'), $flow->name) . '</li>');?>);
$('#footer .breadcrumb').append("<li><?php echo str_replace('-', '', $title);?></li>");
</script>
