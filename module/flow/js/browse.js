$(document).ready(function()
{
    if(mode == 'browse')
    {
        if(typeof label !== undefined && label)
        {
            $('#subNavbar .nav li').removeClass('active');

            if(config.requestType == 'GET')
            {
                $("#subNavbar .nav li a[href*=browse][href*='label\=" + label + "']").parent('li').addClass('active');
            }
            else
            {
                $("#subNavbar .nav li a[href*=browse][href*='browse-" + label + ".html']").parent('li').addClass('active');
            }
        }
    }
    if(mode == 'search') $('#subNavbar .nav #bysearchTab').click();
    if($('#searchTab').length == 1) $('#subNavbar .nav').append($('#searchTab'));

    $(document).on('click', 'td.child .addItem', function()
    {  
        var child = $(this).parents('table').data('child');    
        $(this).closest('tr').after($('.table-'+ child +' tbody').html());
        $(this).closest('tr').next().find('.chosen').next('.chosen-container').remove();
        $(this).closest('tr').next().find('.chosen').chosen();
        $(this).closest('tr').next().find('.form-date, .form-datetime').datetimepicker(
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

    $(document).on('click', 'td.child .delItem', function()
    {  
        if($(this).parents('.table-child').find('tr').size() > 1)
        {
            $(this).closest('tr').remove();
        }
        else
        {
            $(this).closest('tr').find('input,select,textarea').val('');
        }
    })

    $('.reloadPage').click(function()
    {
        url = $(this).attr('href');

        $.getJSON(url, function(response)
        {
            if(response.message)
            {
                bootbox.alert(response.message, function()
                {
                    if(response.locate) 
                    {
                        location.href = response.locate;
                        return false;
                    }
                    location.reload();
                });
            }
            else
            {
                if(response.locate) 
                {
                    location.href = response.locate;
                    return false;
                }
                location.reload();
            }
        });
        return false;
    });
})
