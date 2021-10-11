<script>
$('#footer .breadcrumb').append(<?php echo json_encode('<li>' . baseHTML::a($this->createLink($flow->module, 'browse'), $flow->name) . '</li>');?>);
$('#footer .breadcrumb').append("<li><?php echo str_replace('-', '', $title);?></li>");
</script>
