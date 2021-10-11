<?php
$lang->action->objectTypes['feedback'] = '反饋';

$lang->action->label->feedback = '反饋|feedback|view|id=%s';

$lang->action->desc->asked        = '$date, 由 <strong>$actor</strong> 追問。' . "\n";
$lang->action->desc->replied      = '$date, 由 <strong>$actor</strong> 回覆。' . "\n";
$lang->action->desc->tobug        = '$date, 由 <strong>$actor</strong> 轉為Bug <strong>$extra</strong>。' . "\n";
$lang->action->desc->tostory      = '$date, 由 <strong>$actor</strong> 轉為' . $lang->storyCommon . ' <strong>$extra</strong>。' . "\n";
$lang->action->desc->totask       = '$date, 由 <strong>$actor</strong> 轉為任務 <strong>$extra</strong>。' . "\n";
$lang->action->desc->fromfeedback = '$date, 由 <strong>$actor</strong> 從<strong>反饋</strong>轉化而來，反饋編號為 <strong>$extra</strong>。' . "\n";
$lang->action->desc->totodo       = '$date, 由 <strong>$actor</strong> 轉待辦 <strong>$extra</strong>。';

$lang->action->label->asked        = '追問了';
$lang->action->label->replied      = '回覆了';
$lang->action->label->tobug        = '轉bug';
$lang->action->label->tostory      = '轉' . $lang->storyCommon;
$lang->action->label->totask       = '轉任務';
$lang->action->label->totodo       = '轉待辦';
$lang->action->label->fromfeedback = '由反饋創建';
