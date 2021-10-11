<?php
$lang->workflowlayout->common  = '工作流界面';
$lang->workflowlayout->admin   = '維護界面';

$lang->workflowlayout->id           = '編號';
$lang->workflowlayout->module       = '所屬流程';
$lang->workflowlayout->action       = '所屬動作';
$lang->workflowlayout->field        = '欄位';
$lang->workflowlayout->order        = '順序';
$lang->workflowlayout->width        = '寬度';
$lang->workflowlayout->position     = '位置';
$lang->workflowlayout->readonly     = '只讀';
$lang->workflowlayout->mobileShow   = '移動端';
$lang->workflowlayout->totalShow    = '合計值';
$lang->workflowlayout->defaultValue = '預設值';
$lang->workflowlayout->layoutRules  = '驗證規則';

$lang->workflowlayout->show    = '顯示';
$lang->workflowlayout->hide    = '隱藏';
$lang->workflowlayout->require = '必選';
$lang->workflowlayout->custom  = '自定義';

$lang->workflowlayout->positionList['browse']['left']   = '居左';
$lang->workflowlayout->positionList['browse']['center'] = '居中';
$lang->workflowlayout->positionList['browse']['right']  = '居右';

$lang->workflowlayout->positionList['view']['basic'] = '基本信息';
$lang->workflowlayout->positionList['view']['info']  = '詳細信息';

$lang->workflowlayout->positionList['edit']['basic'] = '居右';
$lang->workflowlayout->positionList['edit']['info']  = '居左';

$lang->workflowlayout->mobileList[1] = '顯示';
$lang->workflowlayout->mobileList[0] = '不顯示';

$lang->workflowlayout->totalList[1] = '顯示';
$lang->workflowlayout->totalList[0] = '不顯示';

$lang->workflowlayout->default = new stdclass();
$lang->workflowlayout->default->user['currentUser'] = '當前用戶';
$lang->workflowlayout->default->user['deptManager'] = '部門經理';
$lang->workflowlayout->default->dept['currentDept'] = '當前部門';
$lang->workflowlayout->default->time['currentTime'] = '當前時間';

$lang->workflowlayout->tips = new stdclass();
$lang->workflowlayout->tips->position = '基本信息是右邊側欄位置，詳細信息是左側主欄位置';

$lang->workflowlayout->error = new stdclass();
$lang->workflowlayout->error->mobileShow        = '移動端列表頁面最多顯示5個欄位';
$lang->workflowlayout->error->emptyCustomFields = "您還沒有添加欄位，請前往 <a href='%s' class='alert-link'>主表設計</a> 添加欄位。";
$lang->workflowlayout->error->emptyLayout       = "您還沒有為動作 <strong>%s</strong> 配置界面，會影響您的正常使用，請先配置界面。";
