<?php
$lang->workflowfield->common    = '工作流欄位';
$lang->workflowfield->browse    = '瀏覽欄位';
$lang->workflowfield->create    = '添加欄位';
$lang->workflowfield->edit      = '編輯欄位';
$lang->workflowfield->delete    = '刪除欄位';
$lang->workflowfield->sort      = '欄位排序';
$lang->workflowfield->setExport = '導出設置';
$lang->workflowfield->setSearch = '搜索設置';
$lang->workflowfield->settings  = '欄位及屬性設置';

$lang->workflowfield->id           = '編號';
$lang->workflowfield->module       = '所屬流程';
$lang->workflowfield->field        = '代號';
$lang->workflowfield->type         = '類型';
$lang->workflowfield->length       = '長度';
$lang->workflowfield->name         = '名稱';
$lang->workflowfield->control      = '控件';
$lang->workflowfield->options      = '選項';
$lang->workflowfield->defaultValue = '預設值';
$lang->workflowfield->rules        = '驗證規則';
$lang->workflowfield->placeholder  = '提示文字';
$lang->workflowfield->canExport    = '啟用導出功能';
$lang->workflowfield->canSearch    = '啟用搜索功能';
$lang->workflowfield->isKeyValue   = '鍵值';
$lang->workflowfield->order        = '順序';
$lang->workflowfield->buildin      = '內置';
$lang->workflowfield->desc         = '描述';
$lang->workflowfield->createdBy    = '由誰創建';
$lang->workflowfield->createdDate  = '創建時間';
$lang->workflowfield->editedBy     = '由誰編輯';
$lang->workflowfield->editedDate   = '編輯時間';

$lang->workflowfield->position         = '位於';
$lang->workflowfield->dataSource       = '數據源';
$lang->workflowfield->sql              = 'SQL';
$lang->workflowfield->vars             = '變數';
$lang->workflowfield->addVar           = '添加變數';
$lang->workflowfield->varName          = '變數名稱';
$lang->workflowfield->showName         = '顯示名稱';
$lang->workflowfield->requestType      = '輸入方式';
$lang->workflowfield->status           = '狀態';
$lang->workflowfield->subStatus        = '子狀態';
$lang->workflowfield->key              = '鍵';
$lang->workflowfield->value            = '值';
$lang->workflowfield->defaultSubStatus = '預設值';
$lang->workflowfield->fieldName        = '欄位名稱';
$lang->workflowfield->tableParent      = '主表編號';

$lang->workflowfield->typeGroup['number'] = '數字';
$lang->workflowfield->typeGroup['date']   = '日期時間';
$lang->workflowfield->typeGroup['string'] = '字元串';

$lang->workflowfield->controlTypeList['label']        = '標籤';
$lang->workflowfield->controlTypeList['input']        = '文本框';
$lang->workflowfield->controlTypeList['textarea']     = '富文本';
$lang->workflowfield->controlTypeList['date']         = '日期';
$lang->workflowfield->controlTypeList['datetime']     = '時間';
$lang->workflowfield->controlTypeList['select']       = '單選下拉菜單';
$lang->workflowfield->controlTypeList['multi-select'] = '多選下拉菜單';
$lang->workflowfield->controlTypeList['radio']        = '單選按鈕';
$lang->workflowfield->controlTypeList['checkbox']     = '複選框';

$lang->workflowfield->optionTypeList['sql']        = '自定義SQL';
$lang->workflowfield->optionTypeList['prevModule'] = '前置流程';

$lang->workflowfield->positionList['before'] = '之前';
$lang->workflowfield->positionList['after']  = '之後';

$lang->workflowfield->exportList[1] = '可以導出';
$lang->workflowfield->exportList[0] = '不能導出';

$lang->workflowfield->searchList[1] = '可以檢索';
$lang->workflowfield->searchList[0] = '不能檢索';

$lang->workflowfield->keyValueList['key']   = '鍵';
$lang->workflowfield->keyValueList['value'] = '值';

$lang->workflowfield->buildinList['0'] = '否';
$lang->workflowfield->buildinList['1'] = '是';

$lang->workflowfield->default = new stdclass();
$lang->workflowfield->default->fields['id']           = '編號';
$lang->workflowfield->default->fields['parent']       = '父流程ID';
$lang->workflowfield->default->fields['assignedTo']   = '指派給';
$lang->workflowfield->default->fields['status']       = '狀態';
$lang->workflowfield->default->fields['createdBy']    = '由誰創建';
$lang->workflowfield->default->fields['createdDate']  = '創建日期';
$lang->workflowfield->default->fields['editedBy']     = '由誰編輯';
$lang->workflowfield->default->fields['editedDate']   = '編輯日期';
$lang->workflowfield->default->fields['assignedBy']   = '由誰指派';
$lang->workflowfield->default->fields['assignedDate'] = '指派日期';
$lang->workflowfield->default->fields['deleted']      = '是否刪除';

$lang->workflowfield->default->options = new stdclass();
$lang->workflowfield->default->options->deleted = array();
$lang->workflowfield->default->options->deleted['0'] = '未刪除';
$lang->workflowfield->default->options->deleted['1'] = '已刪除';

/* Tips */
$lang->workflowfield->tips = new stdclass();
$lang->workflowfield->tips->keyValue     = '<strong>鍵值對</strong>在其他流程調用本流程數據時作為實際值和顯示值。<br /><strong>鍵</strong>只能有一個，預設使用id作為鍵。<br /><strong>值</strong>可以有多個，多個值在顯示的時候拼接顯示。';
$lang->workflowfield->tips->lengthNotice = '該類型修改可能會造成數據丟失，請慎重使用！';
$lang->workflowfield->tips->emptyStatus  = '請先設置狀態欄位的選項值，再設置子狀態的選項值。';
$lang->workflowfield->tips->emptyExport  = '您沒有為表 <strong>TABLE</strong> 選擇任何欄位，該表無法啟用導出功能。確定保存此設置嗎？';
$lang->workflowfield->tips->emptySearch  = '您沒有選擇任何欄位，無法啟用搜索功能。確定保存此設置嗎？';

/* Placeholder */
$lang->workflowfield->placeholder = new stdclass();
$lang->workflowfield->placeholder->code         = '只能包含英文字母';
$lang->workflowfield->placeholder->sql          = '直接寫入一條SQL查詢語句，只能進行查詢操作，禁止其他SQL操作。查詢結果是鍵值對。查詢語句的第一個欄位作為鍵，第二個欄位作為值，其它欄位會被忽略。如果只有一個欄位，這個欄位同時作為鍵和值。';
$lang->workflowfield->placeholder->defaultValue = '多個值之間用空格或逗號隔開';
$lang->workflowfield->placeholder->optionCode   = '可以使用字母或數字';
$lang->workflowfield->placeholder->auto         = '系統自動生成';

/* Error */
$lang->workflowfield->error = new stdclass();
$lang->workflowfield->error->remainFields     = '<strong> %s </strong>為系統保留關鍵字，請更改欄位代號。';
$lang->workflowfield->error->emptyOptions     = '請輸入選項的<strong>鍵</strong>和<strong>值</strong>。';
$lang->workflowfield->error->wrongCode        = '<strong> %s </strong>只能包含英文字母。';
$lang->workflowfield->error->longCode         = '<strong> %s </strong>長度不能超過30。';
$lang->workflowfield->error->wrongSQL         = 'SQL語句有錯！錯誤：';
$lang->workflowfield->error->notunique        = '必須添加唯一驗證';
$lang->workflowfield->error->wrongDecimal     = '<strong>長度</strong>格式為<strong>(M,D)，其中M(0~65)，D(0~30)，且M >= D</strong><br />';
$lang->workflowfield->error->wrongChar        = '<strong>長度</strong>應為0~255';
$lang->workflowfield->error->wrongVarchar     = '<strong>長度</strong>應為0~21844';
$lang->workflowfield->error->defaultValue     = '預設值的長度不應該超過%s';
$lang->workflowfield->error->textDefaultValue = 'text類型欄位不能設置預設值';
$lang->workflowfield->error->duplicatedCode   = '<strong>鍵名</strong> %s 重複，請修改。';
$lang->workflowfield->error->emptyDefault     = '請選擇一個<strong>預設值</strong>。';
$lang->workflowfield->error->emptyCustomField = '您還沒有添加欄位，會影響您的正常使用，請先添加欄位。';
