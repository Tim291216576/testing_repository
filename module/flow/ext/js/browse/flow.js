$(function()
{
    if(moduleNavigator == 'primary')
    {
        $('#pageActions .btn-toolbar').html($('#menuActions').html());
        $('#pageActions .btn-toolbar .iframe').modalTrigger();
        $('#menuActions').remove();
    }
    else if(moduleNavigator == 'secondary')
    {
        $('#navbar li').removeClass('active');
        if(config.requestType == 'GET')
        {
            $("#navbar li a[href*='" + config.moduleVar + '\\=' + moduleApp + "']").parent('li').addClass('active');
        }
        else
        {
            $("#navbar li a[href*='" + moduleApp + "']").parent('li').addClass('active');
        }

        $('#subNavbar .nav li').removeClass('active');
        if(config.requestType == 'GET')
        {
            $("#subNavbar li a[href*='" + config.moduleVar + '\\=' + module+ '&' + config.methodVar + "\\=browse&mode\\=browse&label\\=']").parent('li').addClass('active');
        }
        else
        {
            $("#subNavbar li a[href*='" + module + "-browse-']").parent('li').addClass('active');
        }
    }

    /* Add title for table td. */
    $('.main-table .table tbody tr').each(function()
    {
        $(this).find('td').each(function()
        {
              $(this).attr('title', $(this).text());
        });
    });

    $('table tr td .dropdown .dropdown-menu').closest('td').css('overflow', 'visible');
    $('table tr').each(function(){$(this).find('td:last').removeAttr('title');});
    $('.main-table .table tbody tr').each(function()
    {
        var $aTag = $(this).find('td').eq(0).find('a');
        if($aTag.length > 0) $aTag.prop('outerHTML', $aTag.html());
    });
});
