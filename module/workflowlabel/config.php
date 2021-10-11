<?php
$config->workflowlabel->require = new stdclass();
$config->workflowlabel->require->create = 'label';
$config->workflowlabel->require->edit   = 'label';

$config->workflowlabel->default = new stdclass();
$config->workflowlabel->default->params['all'][1]['field']    = 'deleted';
$config->workflowlabel->default->params['all'][1]['operator'] = 'equal';
$config->workflowlabel->default->params['all'][1]['value']    = '0';

$config->workflowlabel->operatorList['equal']    = '=';
$config->workflowlabel->operatorList['notequal'] = '!=';
$config->workflowlabel->operatorList['gt']       = '>';
$config->workflowlabel->operatorList['ge']       = '>=';
$config->workflowlabel->operatorList['lt']       = '<';
$config->workflowlabel->operatorList['le']       = '<=';
