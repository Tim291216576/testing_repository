<?php
$config->workflow->require = new stdclass();
$config->workflow->require->create  = 'module,name';
$config->workflow->require->copy    = 'module,name,app,position';
$config->workflow->require->edit    = 'module,name,app,position';
$config->workflow->require->release = 'module,name,app,position';

$config->workflowtable = new stdclass();
$config->workflowtable->require = new stdclass();
$config->workflowtable->require->create = 'module';
$config->workflowtable->require->edit   = 'module';

$config->workflow->apps = array('crm', 'oa', 'proj', 'doc', 'cash', 'team', 'hr', 'psi', 'flow', 'ameba');

$config->workflow->uniqueFields = 'module';

