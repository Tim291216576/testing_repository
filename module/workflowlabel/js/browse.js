$(function()
{
    $('.example-text-holder').each(function()
    {
        $(this).attr('data-size', Math.floor(Math.random() * 8) + 2);
    });

    $('#labelList .select-label').click(function()
    {
        var labelID = $(this).parents('tr').data('id');

        selectLabels(labelID);
    });

    $('#labelList').on('sort.sortable', function(e, data)
    {
        $.post(createLink('workflowlabel', 'sort'), data.orders, function(response)
        {
            if(response.result != 'success'){bootbox.alert(response.message);}

            var orders = [];
            for(var i in data.orders) orders[data.orders[i]] = i;
            sortLabels(orders);

            var labelID = data.element.data('id');
            selectLabels(labelID);
        }, 'json');
    });

    $(document).on('click', '.addItem', function()
    {
        var $rowspan = parseInt($('th.params').attr('rowspan'));
        $rowspan ++;

        $('th.params').attr('rowspan', $rowspan);
        $(this).parents('tr').after(itemRow);
        $(this).parents('tr').next().find('.chosen').chosen();
    })

    $(document).on('click', '.delItem', function()
    {
        if($('.delItem').length == 1)
        {
            $(this).parents('tr').find('input,select').val('');
            $(this).parents('tr').find('.chosen').trigger('chosen:updated');
            return false;
        }

        var rowspan = parseInt($('th.params').attr('rowspan'));
        rowspan --;

        $(this).parents('tr').remove();
    })

    $(document).on('change', '[name^=fields]', function()
    {
        var field = $(this).find('option:selected').val();
        $(this).parents('tr').find('td.value').load(createLink('workflowfield', 'ajaxGetFieldControl', 'module=' + module + '&field=' + field), function()
        {
            $('select.chosen').chosen();

            $('.form-datetime').datetimepicker(
            {
                language:  config.clientLang,
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii'
            });

            $('.form-date').datetimepicker(
            {
                language:  config.clientLang,
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                format: 'yyyy-mm-dd'
            });
        });
    });

    $panelHeadingHeight = $('.panel-heading').outerHeight(true);
    $panelMarginBottom  = $('.panel').css('margin-bottom').replace('px', '');
    $editorNavHeight    = $('#editorNav').outerHeight(true);
    $editorMenuHeight   = $('#editorMenu').outerHeight();
    $spaceHeight        = $('.space.space-sm').outerHeight(true);
    
    $maxHeight = $(window).height() - $panelHeadingHeight - $panelMarginBottom - $editorNavHeight - $editorMenuHeight - $spaceHeight;
    $('.panel-body').css('max-height', $maxHeight + 'px');

    $(document).on('click', '.alert > .remove', function(){$.get(createLink('workflowlabel', 'removeFeatureTips'));});
});

function sortLabels(orders)
{
    for(var i in orders)
    {
        $('.preview-content .menu .nav').append($('li[data-id=' + orders[i] + ']'));
    }
}

function selectLabels(labelID)
{
    $('#labelList tr.active').removeClass('active');
    $('#labelList tr[data-id=' + labelID + ']').addClass('active');

    $('.preview-content .menu .nav li').removeClass('active');
    $('.preview-content .menu .nav li[data-id=' + labelID + ']').addClass('active');
}
