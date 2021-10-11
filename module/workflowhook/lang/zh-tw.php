<?php
$lang->workflowhook->common = '工作流擴展動作';
$lang->workflowhook->browse = '瀏覽擴展動作';
$lang->workflowhook->create = '添加擴展動作';
$lang->workflowhook->edit   = '編輯擴展動作';
$lang->workflowhook->delete = '刪除擴展動作';

$lang->workflowhook->condition = '觸發條件';
$lang->workflowhook->hook      = '擴展動作';
$lang->workflowhook->type      = '條件類型';
$lang->workflowhook->result    = '條件結果';
$lang->workflowhook->sql       = 'SQL';
$lang->workflowhook->varName   = '變數名';
$lang->workflowhook->varValue  = '變數值';
$lang->workflowhook->action    = '操作';
$lang->workflowhook->table     = '表';
$lang->workflowhook->field     = '欄位';
$lang->workflowhook->value     = '值';
$lang->workflowhook->where     = '條件';
$lang->workflowhook->message   = '提示信息';

$lang->workflowhook->typeList['data'] = '以數據作為校驗方式';
$lang->workflowhook->typeList['sql']  = '以SQL語句作為校驗方式';

$lang->workflowhook->resultList['empty']    = '查詢結果為空或0時通過校驗';
$lang->workflowhook->resultList['notempty'] = '查詢結果不為空和0時通過校驗';

$lang->workflowhook->logicalOperatorList['and'] = '並且';
$lang->workflowhook->logicalOperatorList['or']  = '或者';

$lang->workflowhook->actionList['insert'] = '新增';
$lang->workflowhook->actionList['update'] = '修改';
$lang->workflowhook->actionList['delete'] = '刪除';


$lang->workflowhook->options['user']        = '用戶';
$lang->workflowhook->options['dept']        = '部門';
$lang->workflowhook->options['deptManager'] = '部門經理';
$lang->workflowhook->options['today']       = '操作日期';
$lang->workflowhook->options['now']         = '操作時間';
$lang->workflowhook->options['actor']       = '操作人';
$lang->workflowhook->options['form']        = '表單數據';
$lang->workflowhook->options['record']      = '當前數據';
$lang->workflowhook->options['custom']      = '自定義';

$lang->workflowhook->placeholder = new stdclass();
$lang->workflowhook->placeholder->sql = '直接寫入一條SQL查詢語句，只能進行查詢操作。';

$lang->workflowhook->error = new stdclass();
$lang->workflowhook->error->wrongSQL = 'SQL語句有錯！錯誤：';
