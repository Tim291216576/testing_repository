<?php
$config->workflowaction->require = new stdclass();
$config->workflowaction->require->create = 'action, name';
$config->workflowaction->require->edit   = 'action, name';

$config->workflowaction->uniqueFields = 'action, name';

$config->workflowaction->operatorList['equal']    = '=';
$config->workflowaction->operatorList['notequal'] = '!=';
$config->workflowaction->operatorList['gt']       = '>';
$config->workflowaction->operatorList['ge']       = '>=';
$config->workflowaction->operatorList['lt']       = '<';
$config->workflowaction->operatorList['le']       = '<=';

$config->workflowaction->default = new stdclass();
$config->workflowaction->default->actions      = array('browse', 'create', 'batchcreate', 'edit', 'view', 'delete', 'link', 'unlink', 'export', 'exporttemplate', 'import', 'showimport');  // These actions are real methods in flow/control.php;
$config->workflowaction->default->extraActions = array('assign', 'batchedit', 'batchassign');   // These actions will be called by the operate method or the batchOperate method in flow/control.php.

$config->workflowaction->default->types['browse']         = 'single';
$config->workflowaction->default->types['create']         = 'single';
$config->workflowaction->default->types['batchcreate']    = 'batch';
$config->workflowaction->default->types['batchedit']      = 'batch';
$config->workflowaction->default->types['batchassign']    = 'batch';
$config->workflowaction->default->types['edit']           = 'single';
$config->workflowaction->default->types['view']           = 'single';
$config->workflowaction->default->types['assign']         = 'single';
$config->workflowaction->default->types['delete']         = 'single';
$config->workflowaction->default->types['link']           = 'single';
$config->workflowaction->default->types['unlink']         = 'single';
$config->workflowaction->default->types['export']         = 'single';
$config->workflowaction->default->types['exporttemplate'] = 'single';
$config->workflowaction->default->types['import']         = 'single';
$config->workflowaction->default->types['showimport']     = 'single';

$config->workflowaction->default->batchModes['browse']         = 'same';
$config->workflowaction->default->batchModes['create']         = 'same';
$config->workflowaction->default->batchModes['batchcreate']    = 'different';
$config->workflowaction->default->batchModes['batchedit']      = 'different';
$config->workflowaction->default->batchModes['batchassign']    = 'same';
$config->workflowaction->default->batchModes['edit']           = 'same';
$config->workflowaction->default->batchModes['view']           = 'same';
$config->workflowaction->default->batchModes['assign']         = 'same';
$config->workflowaction->default->batchModes['delete']         = 'same';
$config->workflowaction->default->batchModes['link']           = 'same';
$config->workflowaction->default->batchModes['unlink']         = 'same';
$config->workflowaction->default->batchModes['export']         = 'same';
$config->workflowaction->default->batchModes['exporttemplate'] = 'same';
$config->workflowaction->default->batchModes['import']         = 'same';
$config->workflowaction->default->batchModes['showimport']     = 'same';

$config->workflowaction->default->opens['browse']         = 'normal';
$config->workflowaction->default->opens['create']         = 'normal';
$config->workflowaction->default->opens['batchcreate']    = 'normal';
$config->workflowaction->default->opens['batchedit']      = 'normal';
$config->workflowaction->default->opens['batchassign']    = 'normal';
$config->workflowaction->default->opens['edit']           = 'normal';
$config->workflowaction->default->opens['view']           = 'normal';
$config->workflowaction->default->opens['assign']         = 'modal';
$config->workflowaction->default->opens['delete']         = 'none';
$config->workflowaction->default->opens['link']           = 'none';
$config->workflowaction->default->opens['unlink']         = 'none';
$config->workflowaction->default->opens['export']         = 'none';
$config->workflowaction->default->opens['exporttemplate'] = 'none';
$config->workflowaction->default->opens['import']         = 'none';
$config->workflowaction->default->opens['showimport']     = 'none';

$config->workflowaction->default->positions['browse']         = 'menu';
$config->workflowaction->default->positions['create']         = 'menu';
$config->workflowaction->default->positions['batchcreate']    = 'menu';
$config->workflowaction->default->positions['batchedit']      = 'browse';
$config->workflowaction->default->positions['batchassign']    = 'browse';
$config->workflowaction->default->positions['edit']           = 'browseandview';
$config->workflowaction->default->positions['view']           = 'browse';
$config->workflowaction->default->positions['assign']         = 'browseandview';
$config->workflowaction->default->positions['delete']         = 'browseandview';
$config->workflowaction->default->positions['link']           = 'view';
$config->workflowaction->default->positions['unlink']         = 'view';
$config->workflowaction->default->positions['export']         = 'menu';
$config->workflowaction->default->positions['exporttemplate'] = 'menu';
$config->workflowaction->default->positions['import']         = 'menu';
$config->workflowaction->default->positions['showimport']     = 'menu';

$config->workflowaction->defaultActions        = array_merge($config->workflowaction->default->actions, $config->workflowaction->default->extraActions);
$config->workflowaction->noShowActions         = array('browse', 'create', 'export', 'exporttemplate', 'import', 'showimport', 'link', 'unlink', 'batchcreate', 'batchedit', 'batchassign', 'delete');
$config->workflowaction->readonlyActions       = array('browse', 'view',   'export', 'exporttemplate', 'import', 'showimport', 'link', 'unlink', 'delete');
$config->workflowaction->noLinkageActions      = array('browse', 'view',   'export', 'exporttemplate', 'import', 'showimport', 'link', 'unlink', 'delete');
$config->workflowaction->noConditionActions    = array('browse', 'view',   'export', 'exporttemplate', 'import', 'showimport', 'create', 'batchcreate');
$config->workflowaction->noVerificationActions = array('browse', 'view',   'export', 'exporttemplate', 'import', 'showimport', 'link', 'unlink', 'delete');
$config->workflowaction->noHookActions         = array('browse', 'view',   'export', 'exporttemplate', 'import', 'showimport', 'link', 'unlink');
$config->workflowaction->noNoticeActions       = array('browse', 'view',   'export', 'exporttemplate', 'import', 'showimport', 'link', 'unlink', 'delete');
$config->workflowaction->noJSActions           = array('export', 'exporttemplate', 'import', 'showimport', 'unlink', 'delete');
$config->workflowaction->noCSSActions          = array('export', 'exporttemplate', 'import', 'showimport', 'unlink', 'delete');
