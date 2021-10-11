<?php
$lang->view             = '查看';
$lang->detail           = '詳情';
$lang->basicInfo        = '基本信息';
$lang->extInfo          = '擴展信息';
$lang->chooseUserToMail = '選擇要發送提醒的用戶...';
$lang->importIcon       = "<i class='icon-import'> </i>";
$lang->exportIcon       = "<i class='icon-export'> </i>";

/* The subModule options makes the module menu high light. */
$lang->menu->workflow = '工作流|workflow|browseFlow|';
$lang->menuOrder[39]  = 'workflow';

/* Workflow */
$lang->workflow = new stdclass();

$lang->workflow->menu = new stdclass();
$lang->workflow->menu->flow       = array('link' => '流程|workflow|browseflow|', 'alias' => 'browse', 'subModule' => 'workflowaction,workflowcondition,workflowlabel,workflowlayout,workflowlinkage,workflowhook');
$lang->workflow->menu->datasource = array('link' => '數據源|workflowdatasource|browse|');
$lang->workflow->menu->rule       = array('link' => '驗證規則|workflowrule|browse|');

$lang->workflow->menuOrder[5]  = 'flow';
$lang->workflow->menuOrder[10] = 'database';
$lang->workflow->menuOrder[15] = 'datasource';
$lang->workflow->menuOrder[20] = 'rule';

/* Workflowaction */
$lang->workflowaction = new stdclass();
$lang->workflowaction->menu      = $lang->workflow->menu;
$lang->workflowaction->menuOrder = $lang->workflow->menuOrder;

/* Workflowcondition */
$lang->workflowcondition = new stdclass();
$lang->workflowcondition->menu      = $lang->workflow->menu;
$lang->workflowcondition->menuOrder = $lang->workflow->menuOrder;

/* Workflowdatasource */
$lang->workflowdatasource = new stdclass();
$lang->workflowdatasource->menu      = $lang->workflow->menu;
$lang->workflowdatasource->menuOrder = $lang->workflow->menuOrder;

/* Workflowfield */
$lang->workflowfield = new stdclass();
$lang->workflowfield->menu      = $lang->workflow->menu;
$lang->workflowfield->menuOrder = $lang->workflow->menuOrder;

/* Workflowlabel */
$lang->workflowlabel = new stdclass();
$lang->workflowlabel->menu      = $lang->workflow->menu;
$lang->workflowlabel->menuOrder = $lang->workflow->menuOrder;

/* Workflowlayout */
$lang->workflowlayout = new stdclass();
$lang->workflowlayout->menu      = $lang->workflow->menu;
$lang->workflowlayout->menuOrder = $lang->workflow->menuOrder;

/* Workflowlinkage */
$lang->workflowlinkage = new stdclass();
$lang->workflowlinkage->menu      = $lang->workflow->menu;
$lang->workflowlinkage->menuOrder = $lang->workflow->menuOrder;

/* Workflowhook */
$lang->workflowhook = new stdclass();
$lang->workflowhook->menu      = $lang->workflow->menu;
$lang->workflowhook->menuOrder = $lang->workflow->menuOrder;

/* Workflowrule */
$lang->workflowrule = new stdclass();
$lang->workflowrule->menu      = $lang->workflow->menu;
$lang->workflowrule->menuOrder = $lang->workflow->menuOrder;

/* Makes the main menu high light. */
$lang->menugroup->workflowaction     = 'workflow';
$lang->menugroup->workflowfield      = 'workflow';
$lang->menugroup->workflowdatasource = 'workflow';
$lang->menugroup->workflowlabel      = 'workflow';
$lang->menugroup->workflowlayout     = 'workflow';
$lang->menugroup->workflowhook       = 'workflow';
$lang->menugroup->workflowrule       = 'workflow';

/* Init flow module. */
$lang->flow = new stdclass();

/* Add lang from ranzhi. */
$lang->exportAll      = '導出全部記錄';
$lang->exportThisPage = '導出本頁記錄';
$lang->setFileNum     = '記錄數';
$lang->setFileType    = '檔案類型';
$lang->flowNotRelease = '該工作流還沒有發佈';
