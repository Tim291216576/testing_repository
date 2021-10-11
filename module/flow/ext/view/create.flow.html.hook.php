<script>
$('#footer .breadcrumb').append(<?php echo json_encode('<li>' . baseHTML::a($this->createLink($flow->module, 'browse'), $flow->name) . '</li>');?>);
$('#footer .breadcrumb').append("<li><?php echo str_replace('-', '', $title);?></li>");

$(function()
{
    $('#contactListMenu').attr("onchange", "setMailto('toList', this.value)");
})

function setMailto(mailto, contactListID)
{
    link = createLink('user', 'ajaxGetContactUsers', 'listID=' + contactListID);
    $.get(link, function(users)
    {
        $('#' + mailto).replaceWith(users);
        $('#mailto').attr('id', mailto).attr('name', mailto + '');
        $('#' + mailto + '_chosen').remove();
        $('#' + mailto).chosen();
    });
}
</script>
