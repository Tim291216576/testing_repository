<script>
  $('a[disabled=disabled]').addClass('disabled');
  $('#footer .breadcrumb').append("<li><?php echo $lang->workflowfield->common;?></li>");

$(function()
{
    var html = $('#fieldList td.actions a.edit:first').html();
    $('#fieldList td.actions a.edit').attr('title', html).addClass('btn').html("<i class='icon icon-edit'></i>");
    
    var html = $('#fieldList td.actions a.deleter:first').html();
    $('#fieldList td.actions a.deleter').attr('title', html).addClass('btn').html("<i class='icon icon-trash'></i>");
})
</script>
