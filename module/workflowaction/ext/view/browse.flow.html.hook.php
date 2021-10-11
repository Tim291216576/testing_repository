<?php if($flow->buildin):?>
<style>
#actionList thead tr th:nth-of-type(3){width:50px !important;}
#actionList thead tr th:nth-of-type(4){width:80px !important;}
</style>
<?php endif;?>
<script>
$('a[disabled=disabled]').addClass('disabled');
$('#footer .breadcrumb').append("<li><?php echo $lang->workflowaction->common;?></li>");

$(function()
{
    $('#actionList thead tr th:last').width('165');
    var html = $('#actionList tr td.actions a.edit:first').html();
    $('#actionList tr td.actions a.edit').attr('title', html).addClass('btn').html("<i class='icon icon-edit'></i>");
    
    var html = $('#actionList tr td.actions a.layout:first').html();
    $('#actionList tr td.actions a.layout').attr('title', html).addClass('btn').html("<i class='icon icon-layout'></i>");
    
    var html = $('#actionList tr td.actions a.condition:first').html();
    $('#actionList tr td.actions a.condition').attr('title', html).addClass('btn').html("<i class='icon icon-trigger'></i>");
    
    var html = $('#actionList tr td.actions a.verification:first').html();
    $('#actionList tr td.actions a.verification').attr('title', html).addClass('btn').html("<i class='icon icon-audit'></i>");
    
    var html = $('#actionList tr td.actions a.moreActions:first').text();
    $('#actionList tr td.actions a.moreActions').attr('title', html).addClass('btn').html("<i class='icon icon-more-circle'></i><span class='caret'></span>");
})
</script>
