<?php
if(isset($needProcess['search']) and (strpos($fromVersion, 'pro') === false or version_compare($config->installedVersion, 'pro4.6', '<')))
{
    $searchLink = $this->createLink('search', 'buildIndex');
    $needBuild  = $lang->upgrade->needBuild4Add;
}
elseif(isset($needProcess['search']) and version_compare($config->installedVersion, 'pro5.2.1', '<='))
{
    $searchLink = $this->createLink('search', 'buildIndex', "type=effort");
    $needBuild  = $lang->upgrade->needBuild4Adjust;
}
?>
<?php if(isset($searchLink)):?>
<script>
$(function()
{
    $('a#tohome').closest('.message').hide();
    $('.col-md-6:first').append("<div id='resultBox' class='alert alert-info'><p><?php echo $needBuild;?><a href='<?php echo $searchLink;?>' id='execButton' class='btn btn-primary btn-sm'><?php echo $lang->upgrade->buildIndex;?></a></p></div>");
    $('#execButton').click(function()
    {
        $('#execButton').hide();
        $.get($(this).attr('href'), function(response)
        {
            try
            {
                response = $.parseJSON(response);
                if(response.result == 'finished')
                {
                    searchFinish = true;
                    $('#resultBox').append("<li class='text-success'>" + response.message + "</li>");
                    <?php
                    $condition = array();
                    foreach($needProcess as $processKey => $value) $condition[] = $processKey . 'Finish == true';
                    $condition = join(' && ', $condition);
                    ?>
                    if(<?php echo $condition?>)
                    {
                        $.get('<?php echo inlink('afterExec', "fromVersion=$fromVersion&processed=yes")?>');
                        $('a#tohome').closest('.message').show();
                    }
                    return false;
                }
                else
                {
                    $('#execButton').attr('href', response.next);
                    $('#resultBox').append("<li class='text-success'>" + response.message + "</li>");
                    return $('#execButton').click();
                }
            }
            catch(error)
            {
                $('#resultBox').append("<li>" + response + "</li>");
            }
        }); 
        return false;
    });
})
</script>
<?php endif;?>
