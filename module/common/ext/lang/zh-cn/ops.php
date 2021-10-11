<?php
$lang->menu->ops  = '运维|ops|index|';
$lang->menuOrder[22] = 'ops';

$lang->ops = new stdclass();
$lang->ops->menu = new stdclass();
$lang->ops->menu->deploy     = array('link' => '上线|deploy|browse', 'alias' => 'create,edit,view');
$lang->ops->menu->host       = array('link' => '主机|host|browse', 'alias' => 'create,edit,view,treemap', 'subModule' => 'tree');
$lang->ops->menu->serverroom = array('link' => '机房|serverroom|browse', 'alias' => 'create,edit,view');
$lang->ops->menu->service    = array('link' => '服务|service|manage', 'alias' => 'create,edit,view,browse');
$lang->ops->menu->setting    = array('link' => '设置|ops|setting');

$lang->ops->menuOrder[5]  = 'deploy';
$lang->ops->menuOrder[10] = 'host';
$lang->ops->menuOrder[15] = 'serverroom';
$lang->ops->menuOrder[20] = 'service';
$lang->ops->menuOrder[25] = 'setting';

$lang->host = new stdclass();
$lang->host->menu      = $lang->ops->menu;
$lang->host->menuOrder = $lang->ops->menuOrder;

$lang->serverroom = new stdclass();
$lang->serverroom->menu      = $lang->ops->menu;
$lang->serverroom->menuOrder = $lang->ops->menuOrder;

$lang->service = new stdclass();
$lang->service->menu = $lang->ops->menu;
$lang->service->menu->service = array('link' => '服务|service|manage', 'alias' => 'create,edit,view,browse');
$lang->service->menuOrder     = $lang->ops->menuOrder;

$lang->deploy = new stdclass();
$lang->deploy->menu = $lang->ops->menu;
$lang->deploy->menu->deploy = array('link' => '上线|deploy|browse', 'alias' => 'create,view,edit,steps,scope,managescope,activate,finish,cases,linkcases,managestep');
$lang->deploy->menuOrder    = $lang->ops->menuOrder;

$lang->menugroup->host       = 'ops';
$lang->menugroup->service    = 'ops';
$lang->menugroup->serverroom = 'ops';
$lang->menugroup->deploy     = 'ops';
