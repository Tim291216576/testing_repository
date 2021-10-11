$(document).ready(function()
{
    $('#dataID').change(function()
    {
        location.href = createLink(module, action, 'dataID=' + $(this).val());
    });

    $('.prevTR select').change(function()
    {
        loadPrevData($(this).parents('tr'), $(this).val());
    });

    $('.prevTR').each(function()
    {
        loadPrevData($(this));
    });
})
