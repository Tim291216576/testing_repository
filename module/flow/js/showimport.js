$(function()
{
    $('[rows=3]').attr('rows', 1);

    $(document).on('change', 'input,select,textarea,radio,checkbox', function()
    {
        $(this).css('border-color', '');
        $(this).next('.text-error.red').remove();
    });

    $('#importTable').datatable();
})
