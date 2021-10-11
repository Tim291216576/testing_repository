$(document).ready(function()
{
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

    $('#linkType').change(function()
    {
        var linkType = $(this).val();
        if(!linkType) return false;

        $('#linkTypeBox').modal('hide', 'fit');

        loadUnlinkData(linkType, 'browse', $(this).find('option:selected').text());
    });

    $('.unlink').click(function()
    {
        var url     = $(this).attr('href');
        var confirm = $(this).data('confirm');

        bootbox.confirm(confirm, function(result)
        {   
            if(result)
            {   
                $.getJSON(url, function(response)
                {   
                    if(response.result == 'success')
                    {   
                        location.reload();
                    }   
                    else
                    {   
                        bootbox.alert(response.message);
                    }   
                })  
            }   
        })  

        return false;
    });

    $('.prevP').each(function()
    {
        loadPrevData($(this), 0, 'p');
    });

    $('.prevTR').each(function()
    {
        loadPrevData($(this), 0);
    });
    
    $('a[href=#' + linkType + ']').click();
    $.setAjaxForm('.form-ajax');

    if(viewMode == 'bysearch') loadUnlinkData(linkType, 'bysearch');

    fixMainAction();    
})

function loadUnlinkData(linkType, mode, tabTitle = '')
{
    var pane    = $('#' + linkType).length == 1 ? linkType : 'common';
    var $navTab = $('#tabsNav .nav-tabs a[href=#' + pane + ']').parent();

    if($navTab.hasClass('hidden'))  $navTab.removeClass('hidden');
    if(!$navTab.hasClass('active')) $navTab.find('a').click();
    if(tabTitle) $navTab.find('a').html(tabTitle);

    $('#querybox').remove();
    
    var link = loadLink.replace('LINKTYPE', linkType).replace('MODE', mode);
    $.get(link, function(data)
    {
        $('#' + pane).html(data);
        $('#' + pane).find('[data-ride=table]').table();
        $('#' + pane).removeClass('without-search');
        initSearch();
    });
}

function fixMainAction()
{
    var wHeight = $(window).height();
    var fTop    = $('.tab-content .tab-pane:first .main-actions').offset().top;
    var fHeight = $('.tab-content .tab-pane:first .main-actions').outerHeight();
    if(fTop + fHeight >= wHeight)
    {
        $('body').addClass('main-actions-fixed');
        $('.main-actions').addClass('col-9');
    }
}
