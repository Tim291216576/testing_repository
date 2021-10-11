<?php
$lang->workflowfield->common    = '工作流字段';
$lang->workflowfield->browse    = '浏览字段';
$lang->workflowfield->create    = '添加字段';
$lang->workflowfield->edit      = '编辑字段';
$lang->workflowfield->delete    = '删除字段';
$lang->workflowfield->sort      = '字段排序';
$lang->workflowfield->setExport = '导出设置';
$lang->workflowfield->setSearch = '搜索设置';
$lang->workflowfield->settings  = '字段及属性设置';

$lang->workflowfield->id           = '编号';
$lang->workflowfield->module       = '所属流程';
$lang->workflowfield->field        = '代号';
$lang->workflowfield->type         = '类型';
$lang->workflowfield->length       = '长度';
$lang->workflowfield->name         = '名称';
$lang->workflowfield->control      = '控件';
$lang->workflowfield->options      = '选项';
$lang->workflowfield->defaultValue = '默认值';
$lang->workflowfield->rules        = '验证规则';
$lang->workflowfield->placeholder  = '提示文字';
$lang->workflowfield->canExport    = '启用导出功能';
$lang->workflowfield->canSearch    = '启用搜索功能';
$lang->workflowfield->isKeyValue   = '键值';
$lang->workflowfield->order        = '顺序';
$lang->workflowfield->buildin      = '内置';
$lang->workflowfield->desc         = '描述';
$lang->workflowfield->createdBy    = '由谁创建';
$lang->workflowfield->createdDate  = '创建时间';
$lang->workflowfield->editedBy     = '由谁编辑';
$lang->workflowfield->editedDate   = '编辑时间';

$lang->workflowfield->position         = '位于';
$lang->workflowfield->dataSource       = '数据源';
$lang->workflowfield->sql              = 'SQL';
$lang->workflowfield->vars             = '变量';
$lang->workflowfield->addVar           = '添加变量';
$lang->workflowfield->varName          = '变量名称';
$lang->workflowfield->showName         = '显示名称';
$lang->workflowfield->requestType      = '输入方式';
$lang->workflowfield->status           = '状态';
$lang->workflowfield->subStatus        = '子状态';
$lang->workflowfield->key              = '键';
$lang->workflowfield->value            = '值';
$lang->workflowfield->defaultSubStatus = '默认值';
$lang->workflowfield->fieldName        = '字段名称';
$lang->workflowfield->tableParent      = '主表编号';

$lang->workflowfield->typeGroup['number'] = '数字';
$lang->workflowfield->typeGroup['date']   = '日期时间';
$lang->workflowfield->typeGroup['string'] = '字符串';

$lang->workflowfield->controlTypeList['label']        = '标签';
$lang->workflowfield->controlTypeList['input']        = '文本框';
$lang->workflowfield->controlTypeList['textarea']     = '富文本';
$lang->workflowfield->controlTypeList['date']         = '日期';
$lang->workflowfield->controlTypeList['datetime']     = '时间';
$lang->workflowfield->controlTypeList['select']       = '单选下拉菜单';
$lang->workflowfield->controlTypeList['multi-select'] = '多选下拉菜单';
$lang->workflowfield->controlTypeList['radio']        = '单选按钮';
$lang->workflowfield->controlTypeList['checkbox']     = '复选框';

$lang->workflowfield->optionTypeList['sql']        = '自定义SQL';
$lang->workflowfield->optionTypeList['prevModule'] = '前置流程';

$lang->workflowfield->positionList['before'] = '之前';
$lang->workflowfield->positionList['after']  = '之后';

$lang->workflowfield->exportList[1] = '可以导出';
$lang->workflowfield->exportList[0] = '不能导出';

$lang->workflowfield->searchList[1] = '可以检索';
$lang->workflowfield->searchList[0] = '不能检索';

$lang->workflowfield->keyValueList['key']   = '键';
$lang->workflowfield->keyValueList['value'] = '值';

$lang->workflowfield->buildinList['0'] = '否';
$lang->workflowfield->buildinList['1'] = '是';

$lang->workflowfield->default = new stdclass();
$lang->workflowfield->default->fields['id']           = '编号';
$lang->workflowfield->default->fields['parent']       = '父流程ID';
$lang->workflowfield->default->fields['assignedTo']   = '指派给';
$lang->workflowfield->default->fields['status']       = '状态';
$lang->workflowfield->default->fields['createdBy']    = '由谁创建';
$lang->workflowfield->default->fields['createdDate']  = '创建日期';
$lang->workflowfield->default->fields['editedBy']     = '由谁编辑';
$lang->workflowfield->default->fields['editedDate']   = '编辑日期';
$lang->workflowfield->default->fields['assignedBy']   = '由谁指派';
$lang->workflowfield->default->fields['assignedDate'] = '指派日期';
$lang->workflowfield->default->fields['deleted']      = '是否删除';

$lang->workflowfield->default->options = new stdclass();
$lang->workflowfield->default->options->deleted = array();
$lang->workflowfield->default->options->deleted['0'] = '未删除';
$lang->workflowfield->default->options->deleted['1'] = '已删除';

/* Tips */
$lang->workflowfield->tips = new stdclass();
$lang->workflowfield->tips->keyValue     = '<strong>键值对</strong>在其他流程调用本流程数据时作为实际值和显示值。<br /><strong>键</strong>只能有一个，默认使用id作为键。<br /><strong>值</strong>可以有多个，多个值在显示的时候拼接显示。';
$lang->workflowfield->tips->lengthNotice = '该类型修改可能会造成数据丢失，请慎重使用！';
$lang->workflowfield->tips->emptyStatus  = '请先设置状态字段的选项值，再设置子状态的选项值。';
$lang->workflowfield->tips->emptyExport  = '您没有为表 <strong>TABLE</strong> 选择任何字段，该表无法启用导出功能。确定保存此设置吗？';
$lang->workflowfield->tips->emptySearch  = '您没有选择任何字段，无法启用搜索功能。确定保存此设置吗？';

/* Placeholder */
$lang->workflowfield->placeholder = new stdclass();
$lang->workflowfield->placeholder->code         = '只能包含英文字母';
$lang->workflowfield->placeholder->sql          = '直接写入一条SQL查询语句，只能进行查询操作，禁止其他SQL操作。查询结果是键值对。查询语句的第一个字段作为键，第二个字段作为值，其它字段会被忽略。如果只有一个字段，这个字段同时作为键和值。';
$lang->workflowfield->placeholder->defaultValue = '多个值之间用空格或逗号隔开';
$lang->workflowfield->placeholder->optionCode   = '可以使用字母或数字';
$lang->workflowfield->placeholder->auto         = '系统自动生成';

/* Error */
$lang->workflowfield->error = new stdclass();
$lang->workflowfield->error->remainFields     = '<strong> %s </strong>为系统保留关键字，请更改字段代号。';
$lang->workflowfield->error->emptyOptions     = '请输入选项的<strong>键</strong>和<strong>值</strong>。';
$lang->workflowfield->error->wrongCode        = '<strong> %s </strong>只能包含英文字母。';
$lang->workflowfield->error->longCode         = '<strong> %s </strong>长度不能超过30。';
$lang->workflowfield->error->wrongSQL         = 'SQL语句有错！错误：';
$lang->workflowfield->error->notunique        = '必须添加唯一验证';
$lang->workflowfield->error->wrongDecimal     = '<strong>长度</strong>格式为<strong>(M,D)，其中M(0~65)，D(0~30)，且M >= D</strong><br />';
$lang->workflowfield->error->wrongChar        = '<strong>长度</strong>应为0~255';
$lang->workflowfield->error->wrongVarchar     = '<strong>长度</strong>应为0~21844';
$lang->workflowfield->error->defaultValue     = '默认值的长度不应该超过%s';
$lang->workflowfield->error->textDefaultValue = 'text类型字段不能设置默认值';
$lang->workflowfield->error->duplicatedCode   = '<strong>键名</strong> %s 重复，请修改。';
$lang->workflowfield->error->emptyDefault     = '请选择一个<strong>默认值</strong>。';
$lang->workflowfield->error->emptyCustomField = '您还没有添加字段，会影响您的正常使用，请先添加字段。';
