<?php 
global $app;
$app->loadLang('workflow', 'flow');
$app->loadLang('workflowaction', 'flow');
$app->loadLang('workflowfield', 'flow');
$app->loadLang('workflowdatasource', 'flow');
$app->loadLang('workflowhook', 'flow');
$app->loadLang('workflowlabel', 'flow');
$app->loadLang('workflowlayout', 'flow');
$app->loadLang('workflowrule', 'flow');

$lang->action->objectTypes['workflow']           = $lang->workflow->common;
$lang->action->objectTypes['workflowaction']     = $lang->workflowaction->common;
$lang->action->objectTypes['workflowfield']      = $lang->workflowfield->common;
$lang->action->objectTypes['workflowdatasource'] = $lang->workflowdatasource->common;
$lang->action->objectTypes['workflowhook']       = $lang->workflowhook->common;
$lang->action->objectTypes['workflowlabel']      = $lang->workflowlabel->common;
$lang->action->objectTypes['workflowlayout']     = $lang->workflowlayout->common;
$lang->action->objectTypes['workflowrule']       = $lang->workflowrule->common;

$lang->action->label->workflow           = $lang->workflow->common           . '|workflow|browse|';
$lang->action->label->workflowaction     = $lang->workflowaction->common     . '|workflowaction|browse|module=%s';
$lang->action->label->workflowfield      = $lang->workflowfield->common      . '|workflowfield|browse|module=%s';
$lang->action->label->workflowdatasource = $lang->workflowdatasource->common . '|workflowdatasource|browse|';
$lang->action->label->workflowhook       = $lang->workflowhook->common       . '|workflowhook|browse|module=%s';
$lang->action->label->workflowlabel      = $lang->workflowlabel->common      . '|workflowlabel|browse|module=%s';
$lang->action->label->workflowlayout     = $lang->workflowlayout->common     . '|workflowlayout|admin|module=%s';
$lang->action->label->workflowrule       = $lang->workflowrule->common       . '|workflowrule|view|id=%s';

/* Workflow */
$lang->action->desc->workflowAction = '$date, 由 <strong>$actor</strong> %s。' . "\n";
$lang->action->desc->userdefined    = '$date, 由 <strong>$actor</strong> $extra。' . "\n";
$lang->action->desc->executehooks   = '$date, 由 <strong>$actor</strong> 执行扩展动作。' . "\n";
$lang->action->desc->linked         = '$date, 由 <strong>$actor</strong> 关联 <strong>$extra</strong>。' . "\n";
$lang->action->desc->linkedto       = '$date, 由 <strong>$actor</strong> 关联到 <strong>$extra</strong>。' . "\n";
$lang->action->desc->unlinked       = '$date, 由 <strong>$actor</strong> 移除 <strong>$extra</strong>。' . "\n";
$lang->action->desc->unlinkedfrom   = '$date, 由 <strong>$actor</strong> 从 <strong>$extra</strong> 移除。' . "\n";
