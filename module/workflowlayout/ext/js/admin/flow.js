$(function()
{
    setTimeout(function()
    {
        $('[id*=layoutRules]').width('100px');
        $('input[name*=custom]').change();
    }, 100);

    $('input[name*=custom]').change(function()
    {
        var $span = $(this).parent('span');
        if(!$(this).prop('checked')) $span.find(('select.picker-select[name*=defaultValue]')).show();
    })
})
