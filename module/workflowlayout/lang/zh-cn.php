<?php
$lang->workflowlayout->common  = '工作流界面';
$lang->workflowlayout->admin   = '维护界面';

$lang->workflowlayout->id           = '编号';
$lang->workflowlayout->module       = '所属流程';
$lang->workflowlayout->action       = '所属动作';
$lang->workflowlayout->field        = '字段';
$lang->workflowlayout->order        = '顺序';
$lang->workflowlayout->width        = '宽度';
$lang->workflowlayout->position     = '位置';
$lang->workflowlayout->readonly     = '只读';
$lang->workflowlayout->mobileShow   = '移动端';
$lang->workflowlayout->totalShow    = '合计值';
$lang->workflowlayout->defaultValue = '默认值';
$lang->workflowlayout->layoutRules  = '验证规则';

$lang->workflowlayout->show    = '显示';
$lang->workflowlayout->hide    = '隐藏';
$lang->workflowlayout->require = '必选';
$lang->workflowlayout->custom  = '自定义';

$lang->workflowlayout->positionList['browse']['left']   = '居左';
$lang->workflowlayout->positionList['browse']['center'] = '居中';
$lang->workflowlayout->positionList['browse']['right']  = '居右';

$lang->workflowlayout->positionList['view']['basic'] = '基本信息';
$lang->workflowlayout->positionList['view']['info']  = '详细信息';

$lang->workflowlayout->positionList['edit']['basic'] = '居右';
$lang->workflowlayout->positionList['edit']['info']  = '居左';

$lang->workflowlayout->mobileList[1] = '显示';
$lang->workflowlayout->mobileList[0] = '不显示';

$lang->workflowlayout->totalList[1] = '显示';
$lang->workflowlayout->totalList[0] = '不显示';

$lang->workflowlayout->default = new stdclass();
$lang->workflowlayout->default->user['currentUser'] = '当前用户';
$lang->workflowlayout->default->user['deptManager'] = '部门经理';
$lang->workflowlayout->default->dept['currentDept'] = '当前部门';
$lang->workflowlayout->default->time['currentTime'] = '当前时间';

$lang->workflowlayout->tips = new stdclass();
$lang->workflowlayout->tips->position = '基本信息是右边侧栏位置，详细信息是左侧主栏位置';

$lang->workflowlayout->error = new stdclass();
$lang->workflowlayout->error->mobileShow        = '移动端列表页面最多显示5个字段';
$lang->workflowlayout->error->emptyCustomFields = "您还没有添加字段，请前往 <a href='%s' class='alert-link'>主表设计</a> 添加字段。";
$lang->workflowlayout->error->emptyLayout       = "您还没有为动作 <strong>%s</strong> 配置界面，会影响您的正常使用，请先配置界面。";
