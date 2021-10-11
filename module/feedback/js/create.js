$(function()
{
    $.get(createLink('feedback', 'ajaxGetStatus', 'methodName=create'), function(status)
    {
        $('#status').val(status).change();
    });
});
