<?php js::set('ditto', $lang->user->ditto);?>
<?php js::set('defaultGroup', $defaultGroup);?>
<script>
$(function()
{
    var index = $('#ldapForm table tbody tr:first').find('input[id^=account]').closest('td').index();
    $('#ldapForm table thead tr:first th').eq(index).after("<th class='w-100px'><?php echo $lang->user->type?></th>");
    $('#ldapForm table tbody tr').each(function()
    {
        var $account = $(this).find('td input[id^=account]');
        var i = $account.attr('id').replace('account', '').replace('[', '').replace(']', '');

        var options = "<option value='0'><?php echo $lang->user->developerAB?></option><option value='1'><?php echo $lang->user->feedbackAB?></option>";
        if(i > 0) options = "<option value='ditto'><?php echo $lang->user->ditto?></option>" + options;

        $account.closest('td').after("<td><select name='feedback[" + i + "]' id='feedback" + i + "' onchange='setFeedback(this)' title='<?php echo $lang->user->feedbackNotice?>' class='form-control'>" + options + "</select></td>");
    })
    var tfootTD = $('#ldapForm table tfoot tr:first').find('td:first');
    var colspan = tfootTD.attr('colspan') * 1 + 1;
    
    $('#ldapForm table tfoot tr').each(function(){$(this).find('td:first').attr('colspan', colspan);});
});
</script>
