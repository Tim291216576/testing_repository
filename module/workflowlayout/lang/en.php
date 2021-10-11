<?php
$lang->workflowlayout->common  = 'Workflow Layout';
$lang->workflowlayout->admin   = 'Manage Layout';

$lang->workflowlayout->id           = 'ID';
$lang->workflowlayout->module       = 'Module';
$lang->workflowlayout->action       = 'Action';
$lang->workflowlayout->field        = 'Field';
$lang->workflowlayout->order        = 'Order';
$lang->workflowlayout->width        = 'Width';
$lang->workflowlayout->position     = 'Position';
$lang->workflowlayout->readonly     = 'Readonly';
$lang->workflowlayout->mobileShow   = 'Show on Mobile';
$lang->workflowlayout->totalShow    = 'Show Total';
$lang->workflowlayout->defaultValue = 'Default Value';
$lang->workflowlayout->layoutRules  = 'Rules';

$lang->workflowlayout->show    = 'Show';
$lang->workflowlayout->hide    = 'Hide';
$lang->workflowlayout->require = 'Required';
$lang->workflowlayout->custom  = 'Custom';

$lang->workflowlayout->positionList['browse']['left']   = 'align-left';
$lang->workflowlayout->positionList['browse']['center'] = 'align-center';
$lang->workflowlayout->positionList['browse']['right']  = 'align-right';

$lang->workflowlayout->positionList['view']['basic'] = 'Basic Info';
$lang->workflowlayout->positionList['view']['info']  = 'Detail';

$lang->workflowlayout->positionList['edit']['basic'] = 'align-right';
$lang->workflowlayout->positionList['edit']['info']  = 'align-left';

$lang->workflowlayout->mobileList[1] = 'Display';
$lang->workflowlayout->mobileList[0] = 'Hide';

$lang->workflowlayout->totalList[1] = 'Display';
$lang->workflowlayout->totalList[0] = 'Hide';

$lang->workflowlayout->default = new stdclass();
$lang->workflowlayout->default->user['currentUser'] = 'User';
$lang->workflowlayout->default->user['deptManager'] = 'Department Manager';
$lang->workflowlayout->default->dept['currentDept'] = 'Department';
$lang->workflowlayout->default->time['currentTime'] = 'Time';

$lang->workflowlayout->tips = new stdclass();
$lang->workflowlayout->tips->position = 'Basic information is displayed on the right of the page and details left.';

$lang->workflowlayout->error = new stdclass();
$lang->workflowlayout->error->mobileShow        = 'Up to 5 fields on list page on mobile device.';
$lang->workflowlayout->error->emptyCustomFields = "Go to [Workflow] => [%s] => [Field] to add fields.";
$lang->workflowlayout->error->emptyLayout       = "You have not set the layout for <strong>%s</strong>. Set the layout first.";
