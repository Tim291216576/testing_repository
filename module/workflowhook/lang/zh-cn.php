<?php
$lang->workflowhook->common = '工作流扩展动作';
$lang->workflowhook->browse = '浏览扩展动作';
$lang->workflowhook->create = '添加扩展动作';
$lang->workflowhook->edit   = '编辑扩展动作';
$lang->workflowhook->delete = '删除扩展动作';

$lang->workflowhook->condition = '触发条件';
$lang->workflowhook->hook      = '扩展动作';
$lang->workflowhook->type      = '条件类型';
$lang->workflowhook->result    = '条件结果';
$lang->workflowhook->sql       = 'SQL';
$lang->workflowhook->varName   = '变量名';
$lang->workflowhook->varValue  = '变量值';
$lang->workflowhook->action    = '操作';
$lang->workflowhook->table     = '表';
$lang->workflowhook->field     = '字段';
$lang->workflowhook->value     = '值';
$lang->workflowhook->where     = '条件';
$lang->workflowhook->message   = '提示信息';

$lang->workflowhook->typeList['data'] = '以数据作为校验方式';
$lang->workflowhook->typeList['sql']  = '以SQL语句作为校验方式';

$lang->workflowhook->resultList['empty']    = '查询结果为空或0时通过校验';
$lang->workflowhook->resultList['notempty'] = '查询结果不为空和0时通过校验';

$lang->workflowhook->logicalOperatorList['and'] = '并且';
$lang->workflowhook->logicalOperatorList['or']  = '或者';

$lang->workflowhook->actionList['insert'] = '新增';
$lang->workflowhook->actionList['update'] = '修改';
$lang->workflowhook->actionList['delete'] = '删除';


$lang->workflowhook->options['user']        = '用户';
$lang->workflowhook->options['dept']        = '部门';
$lang->workflowhook->options['deptManager'] = '部门经理';
$lang->workflowhook->options['today']       = '操作日期';
$lang->workflowhook->options['now']         = '操作时间';
$lang->workflowhook->options['actor']       = '操作人';
$lang->workflowhook->options['form']        = '表单数据';
$lang->workflowhook->options['record']      = '当前数据';
$lang->workflowhook->options['custom']      = '自定义';

$lang->workflowhook->placeholder = new stdclass();
$lang->workflowhook->placeholder->sql = '直接写入一条SQL查询语句，只能进行查询操作。';

$lang->workflowhook->error = new stdclass();
$lang->workflowhook->error->wrongSQL = 'SQL语句有错！错误：';
