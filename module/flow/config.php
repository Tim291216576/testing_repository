<?php
$config->flow->batchCreateRow               = 10;
$config->flow->showBatchActionsInLinkedPage = false;

$config->flow->variables = array('today', 'now', 'actor', 'currentUser', 'currentDept', 'currentTime', 'deptManager');

$config->flow->defaultFields = new stdclass();
$config->flow->defaultFields->createdBy   = array();
$config->flow->defaultFields->createdDate = array();
$config->flow->defaultFields->editedBy    = array();
$config->flow->defaultFields->editedDate  = array();

$config->flow->linkPairs = array();
