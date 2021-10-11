$(function()
{
    $('table.datatable').datatable(
    {
        customizable  : false,
        sortable      : false,
        scrollPos     : 'out',
        tableClass    : 'tablesorter',
        storage       : false,
        fixCellHeight : false,
        selectable    : false,
        fixedHeader   : true,
        ready:function()
        {
            setTimeout(function()
            {
                var rowspan    = 1;
                var compareVal = '';
                var mergeIndex = 0;
                $('.datatable-rows .datatable-rows-span:first table tr').each(function()
                {
                    var $firstTd  = $(this).find('td:first');
                    var dataIndex = $(this).data('index');
                    if(dataIndex == 0)
                    {
                        compareVal = $firstTd.html();
                        mergeIndex = dataIndex;
                    }

                    if(mergeIndex != dataIndex)
                    {
                        if(compareVal == $firstTd.html())
                        {
                            rowspan += 1;
                            $(this).parent().find('tr').eq(mergeIndex).find('td:first').attr('rowspan', rowspan);
                            $firstTd.remove();
                        }
                        else
                        {
                            rowspan    = 1;
                            compareVal = $firstTd.html();
                            mergeIndex = dataIndex;
                        }
                    }
                })
            }, 100);
            setTimeout(function()
            {
                $('.datatable-rows .datatable-rows-span:first table tr td.c-name').each(function()
                {
                    var dataIndex = $(this).parent().data('index');
                    var $right  = $('.datatable-rows .datatable-rows-span:last table tr[data-index=' + dataIndex + ']');
                    $right.css('height', $(this).outerHeight());
                });
            }, 100);
        }
    })

    setTimeout(function()
    {
        fixScroll();
        $('#tasksTable').removeClass('loading');
    }, 500);

    $html = "<tr>";
    for(var i = 0; i <= day; i++)
    {
       $html += '<th class="date text-center" data-flex="true">' + consumed + '</th>';
       $html += '<th class="date text-center" data-flex="true">' + left + '</th>';
    }
    $html += "</tr>";
    $('.datatable-head .flexarea thead tr').after($html);
    $('.datatable-head .flexarea thead .datatable-row th').attr('colspan', 2);
    $('.datatable-head .datatable-row-left').height($('.datatable-head .fixed-left').height()-1);
    $('.datatable-rows .flexarea tbody td').each(function(){
        $(this).css('width', '55px');
        if($(this).find('input[name^="countLeft"]').length) $(this).css('height', '36px');
        var $value = $(this).find('input[name^="left"]').length ? $(this).find('input[name^="left"]').val() : $(this).find('input[name^="countLeft"]').val();
        var leftTD = $(this).clone();
        leftTD.html($value);
        $(this).after(leftTD);
    })

    var $datatable    = $('div.datatable');
    var $rightFooter  = $datatable.find('.datatable-rows .flexarea table tbody tr:last');
    var $leftFooter   = $datatable.find('.datatable-rows .fixed-left table tbody tr:last');
    var rightWidth    = $rightFooter.width();
    var leftWidth     = $leftFooter.width();
    var footBarHeight = $('#footer').height();
    var handleScroll  = function() {
        docHeight     = $(document).height();
        scrollTop     = $(window).scrollTop();
        winHeight     = $(window).height();
        footHeight    = $rightFooter.height();
        bottom        = docHeight - winHeight - scrollTop - footBarHeight  - 1;
        if(bottom > 0)
        {
            var firstTdWidth = $datatable.find('.datatable-rows .flexarea table tbody tr:first td').eq(1).outerWidth();
            $rightFooter.find('td').css('width', firstTdWidth);

            $rightFooter.css({
                position: 'absolute',
                bottom: bottom,
                background: '#fff',
            });

            $leftFooter.css({
                position: 'absolute',
                bottom: bottom,
                width: leftWidth,
            });
            $leftFooter.find('td').width(leftWidth).outerHeight(footHeight);
            $rightFooter.find('td:first').css('border-left', 'none');
            $leftFooter.find('td:first').css('border-left', 'none');
        }
        else
        {
            $rightFooter.attr('style', '');
            $leftFooter.attr('style', '');
        }
    };
    $(window).scroll(handleScroll);
})

function fixScroll()
{
    var $scrollwrapper = $('div.datatable').first().find('.scroll-wrapper:first');
    if($scrollwrapper.size() == 0)return;

    var $tfoot       = $('div.datatable').first().find('table tfoot:last');
    var scrollOffset = $scrollwrapper.offset().top + $scrollwrapper.find('.scroll-slide').height();
    if($tfoot.size() > 0) scrollOffset += $tfoot.height();
    if($('div.datatable.head-fixed').size() == 0) scrollOffset -= '29';
    var windowH = $(window).height();
    var bottom  = $tfoot.hasClass('fixedTfootAction') ? 53 + $tfoot.height() : 53;
    if(typeof(ssoRedirect) != "undefined") bottom = 53;
    if(scrollOffset > windowH + $(window).scrollTop()) $scrollwrapper.css({'position': 'fixed', 'bottom': bottom + 'px'});
    $(window).scroll(function()
    {
          newBottom = $tfoot.hasClass('fixedTfootAction') ? 53 + $tfoot.height() : 53;
          if(typeof(ssoRedirect) != "undefined") newBottom = 53;
          if(scrollOffset <= windowH + $(window).scrollTop()) 
          {    
              $scrollwrapper.css({'position':'relative', 'bottom': '0px'});
          }    
          else if($scrollwrapper.css('position') != 'fixed' || bottom != newBottom)
          {    
              $scrollwrapper.css({'position': 'fixed', 'bottom': newBottom + 'px'});
              bottom = newBottom;
          }
    });
}
