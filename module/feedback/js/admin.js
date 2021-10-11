$(function()
{
    $('#subNavbar ul.nav li[data-id="' + browseType + '"]').addClass('feedback-active');
    $('.querybox-toggle').click(function()
    {
        setTimeout(function()
        {
            $('#subNavbar ul.nav li').removeClass('feedback-active');
            if($('.querybox-toggle').hasClass('querybox-opened'))
            {
                $('#subNavbar ul.nav li[data-id="bysearch"]').addClass('active');
            }
            else
            {
                $('#subNavbar ul.nav li[data-id="' + browseType + '"]').addClass('active');
            }
        }, 100);
    });
})
