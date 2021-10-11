$(function()
{
    var $ol = $('ol');
    $('#toggleToc').click(function()
    {   
        $('ol').toggle();
        if($ol.is(":visible"))
        $('a span').text(hidden);
        else 
        $('a span').text(show);
    }); 
});
