$(function()
{
    if(config.requestType == 'GET') $('.treeview li a[href$="=' + action + '"]').parent('li').addClass('active');
    if(config.requestType == 'PATH_INFO') $('.treeview li a[href$="-' + action + '.html"]').parent('li').addClass('active');

    $('#triggerModal').addClass('layout-modal').attr('data-action', action);

    var $cols = $('.col');
    $cols.filter('.fixed-enabled').appendTo('#colsFixedEnabled');
    $cols.filter('.fixed-required').appendTo('#colsFixedRequired');
    $('.cols-list-origin').remove();

    $requireCols = $('#colsFixedRequired .col');
    $enableCols  = $('#colsFixedEnabled .col');
    if(!$requireCols.length) $('#colsFixedRequired').hide();

    if($enableCols.length < 2)
    {
        $('#colsFixedEnabled').addClass('sort-disabled');
        $enableCols.find('input[name*=width]').val('auto').attr('disabled', 'disabled');
    }
    else
    {
        $('#colsFixedEnabled').sortable({trigger: '.title',selector: '.col'});
    }

    $(document).on('click', '#reversechecker', function()
    {
        $('#colsFixedEnabled').find('.col').addClass('disabled').find('input[name*=show]').val('0');
    });

    $(document).on('click', '#allchecker', function()
    {
        $('#colsFixedEnabled').find('.col').removeClass('disabled').find('input[name*=show]').val('1');
    });

    /**
     * Show or hide a row. 
     */
    $('.cols-list').on('click', '.col:not(.required) .show-hide, .col:not(.required) .title', function()
    {
        var $col = $(this).closest('.col');

        $col.toggleClass('disabled');
        if($col.hasClass('disabled'))  $col.find('input[name*=show]').val('0');
        if(!$col.hasClass('disabled')) $col.find('input[name*=show]').val('1');

        if($col.data('child') != undefined)
        {
            var child = '.child-' + $col.data('child');
            $(child).toggleClass('disabled', $col.hasClass('disabled'));

            if($(child).hasClass('disabled'))
            {
                $(child).find('.col').toggleClass('disabled', $col.hasClass('disabled'));
                $(child).find('.col').find('input[name*=show]').val('0');
            }
        }

        if(action != 'browse' && action != 'view')
        {
            if($col.data('key') == 'subStatus' && !$col.hasClass('disabled'))
            {
                var $statusCol = $(this).parents('.cols-list').find('.col[data-key=status]');

                $col.before($statusCol);

                if($statusCol.hasClass('disabled'))
                {
                    $statusCol.removeClass('disabled');
                    $statusCol.find('input[name*=show]').val('1');
                }
            }
        }
    });

    $('.child').each(function()
    {
        var module = '.module-' + $(this).data('module');
        $(this).toggleClass('disabled', $(module).hasClass('disabled'));
    })

    $('input[name*=custom]').change(function()
    {
        var $span = $(this).parent('span');
        if($(this).prop('checked'))
        {
            $span.find(('select[name*=defaultValue]')).attr('disabled', true).hide();
            $span.find('[id^=defaultValue][id$=chosen]').hide();
            $span.find(('input[name*=defaultValue]')).attr('disabled', false).show();
        }
        else
        {
            $span.find(('select[name*=defaultValue]')).attr('disabled', false);
            $span.find('[id^=defaultValue][id$=chosen]').show().width('100px');
            $span.find(('input[name*=defaultValue]')).attr('disabled', true).hide();
        }

        if(mode == 'view')
        {
            $span.find(('select[name*=defaultValue]')).attr('disabled', true);
            $span.find(('input[name*=defaultValue]')).attr('disabled', true);
        }
    })

    $('input[name*=custom]').change();
    $('.fixed-required').find('input:not([name*=width], [name*=show]), select').attr('disabled', true);
    $('[id*=layoutRules]').width('100px');

    $('.child').sortable({trigger: '.title', selector: '.col'});

    $('.child').on('click', '.panel-heading', function()
    {
        if(mode == 'view') return false;

        $(this).toggleClass('disabled');

        if($(this).hasClass('disabled'))  $(this).parent().find('.col').hide().find('input[name*=show]').val('0');
        if(!$(this).hasClass('disabled')) $(this).parent().find('.col').show().find('input[name*=show]').val('1');
    });

    $.setAjaxForm('#adminLayoutForm', function(response)
    {
        if(response.result == 'success')
        {
            setTimeout(function()
            {
                $('#triggerModal').load(response.locate, function()
                {
                    $.zui.ajustModalPosition();
                });
            }, 1200);
        }
    });
});
