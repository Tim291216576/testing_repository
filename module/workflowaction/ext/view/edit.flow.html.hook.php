<?php if($flow->buildin and $action->action == 'exporttemplate'):?>
<script>
$(function()
{
    $('#extensionType option[value="override"]').remove();
})
</script>
<?php endif;?>
