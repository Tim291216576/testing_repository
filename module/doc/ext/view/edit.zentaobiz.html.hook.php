<script>
$(function()
{
    <?php if(strpos($config->doc->officeTypes, $doc->type) !== false):?>
    $('#contentBox').hide();
    $('#urlBox').hide();
    $("[name='type']:first").closest('tr').remove();
    $("#submit").after("<input type='hidden' name='type' value='<?php echo $doc->type;?>' />");
    <?php endif;?>
})
</script>
