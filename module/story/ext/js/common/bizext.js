$(function()
{
    if(typeof(storyType) == 'undefined') storyType = ''; 
    $('#subNavbar .nav li').removeClass('active');
    $("#subNavbar .nav li[data-id=" + storyType + ']').addClass('active');
})
