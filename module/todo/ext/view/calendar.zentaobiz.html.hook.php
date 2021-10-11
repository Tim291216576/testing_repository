<?php if(!empty($this->app->user->feedback) or $this->cookie->feedbackView):?>
<style>
.side-col{display:none;}
</style>
<?php endif;?>
<?php $html = "<li><a href='#tab_feedback' data-toggle='tab'>{$lang->side->feedback}</a></li>"?>
<script>
$('.side-col .cell>ul').append(<?php echo json_encode($html)?>);
</script>
