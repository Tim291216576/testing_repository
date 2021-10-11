$(function()
{
    $.setAjaxForm('#releaseForm');

    $('#app').change(function()
    {
        if($(this).val()) $('select#positionModule').load(createLink('workflow', 'ajaxGetAppMenus', 'app=' + $(this).val() + '&exclude=' + currentModule));
    });
})
