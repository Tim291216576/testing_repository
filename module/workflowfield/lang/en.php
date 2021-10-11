<?php
$lang->workflowfield->common    = 'Workflow Field';
$lang->workflowfield->browse    = 'Fields';
$lang->workflowfield->create    = 'Create Field';
$lang->workflowfield->edit      = 'Edit Field';
$lang->workflowfield->delete    = 'Delete Field';
$lang->workflowfield->sort      = 'Sort Field';
$lang->workflowfield->setExport = 'Export Settings';
$lang->workflowfield->setSearch = 'Search Settings';
$lang->workflowfield->settings  = 'Field and attribute settings';

$lang->workflowfield->id           = 'ID';
$lang->workflowfield->module       = 'Module';
$lang->workflowfield->field        = 'Field';
$lang->workflowfield->type         = 'Type';
$lang->workflowfield->length       = 'Length';
$lang->workflowfield->name         = 'Name';
$lang->workflowfield->control      = 'Control';
$lang->workflowfield->options      = 'Option';
$lang->workflowfield->defaultValue = 'Default';
$lang->workflowfield->rules        = 'Rule';
$lang->workflowfield->placeholder  = 'Placeholder';
$lang->workflowfield->canExport    = 'Enable Export';
$lang->workflowfield->canSearch    = 'Enable Search';
$lang->workflowfield->isKeyValue   = 'Key-Value';
$lang->workflowfield->order        = 'Order';
$lang->workflowfield->buildin      = 'Build-in';
$lang->workflowfield->desc         = 'Description';
$lang->workflowfield->createdBy    = 'Created By';
$lang->workflowfield->createdDate  = 'Created';
$lang->workflowfield->editedBy     = 'Edited By';
$lang->workflowfield->editedDate   = 'Edited';

$lang->workflowfield->position         = 'Position';
$lang->workflowfield->dataSource       = 'DataSource';
$lang->workflowfield->sql              = 'SQL';
$lang->workflowfield->vars             = 'Vars';
$lang->workflowfield->addVar           = 'Add Var';
$lang->workflowfield->varName          = 'Var Name';
$lang->workflowfield->showName         = 'Show Name';
$lang->workflowfield->requestType      = 'Control';
$lang->workflowfield->status           = 'Status';
$lang->workflowfield->subStatus        = 'Sub Status';
$lang->workflowfield->key              = 'Key';
$lang->workflowfield->value            = 'Value';
$lang->workflowfield->defaultSubStatus = 'Default';
$lang->workflowfield->fieldName        = 'Field Name';
$lang->workflowfield->tableParent      = 'Parent ID';

$lang->workflowfield->typeGroup['number'] = 'Number';
$lang->workflowfield->typeGroup['date']   = 'Date and Time';
$lang->workflowfield->typeGroup['string'] = 'String';

$lang->workflowfield->controlTypeList['label']        = 'Label';
$lang->workflowfield->controlTypeList['input']        = 'Text';
$lang->workflowfield->controlTypeList['textarea']     = 'Richtext';
$lang->workflowfield->controlTypeList['date']         = 'Date';
$lang->workflowfield->controlTypeList['datetime']     = 'Time';
$lang->workflowfield->controlTypeList['select']       = 'Dropdown';
$lang->workflowfield->controlTypeList['multi-select'] = 'Multi-Dropdown';
$lang->workflowfield->controlTypeList['radio']        = 'Radio';
$lang->workflowfield->controlTypeList['checkbox']     = 'Checkbox';

$lang->workflowfield->optionTypeList['sql']        = 'SQL';
$lang->workflowfield->optionTypeList['prevModule'] = 'Prev Flow';

$lang->workflowfield->positionList['before'] = 'Before';
$lang->workflowfield->positionList['after']  = 'After';

$lang->workflowfield->exportList[1] = 'Yes';
$lang->workflowfield->exportList[0] = 'No';

$lang->workflowfield->searchList[1] = 'Yes';
$lang->workflowfield->searchList[0] = 'No';

$lang->workflowfield->keyValueList['key']   = 'Key';
$lang->workflowfield->keyValueList['value'] = 'Value';

$lang->workflowfield->buildinList['0'] = 'No';
$lang->workflowfield->buildinList['1'] = 'Yes';

$lang->workflowfield->default = new stdclass();
$lang->workflowfield->default->fields['id']           = 'ID';
$lang->workflowfield->default->fields['parent']       = 'Parent';
$lang->workflowfield->default->fields['assignedTo']   = 'Assigned To';
$lang->workflowfield->default->fields['status']       = 'Status';
$lang->workflowfield->default->fields['createdBy']    = 'Created By';
$lang->workflowfield->default->fields['createdDate']  = 'Created';
$lang->workflowfield->default->fields['editedBy']     = 'Edited By';
$lang->workflowfield->default->fields['editedDate']   = 'Edited';
$lang->workflowfield->default->fields['assignedBy']   = 'Assigned By';
$lang->workflowfield->default->fields['assignedDate'] = 'Assigned';
$lang->workflowfield->default->fields['deleted']      = 'Deleted';

$lang->workflowfield->default->options = new stdclass();
$lang->workflowfield->default->options->deleted = array();
$lang->workflowfield->default->options->deleted['0'] = 'Undeleted';
$lang->workflowfield->default->options->deleted['1'] = 'Deleted';

/* Tips */
$lang->workflowfield->tips = new stdclass();
$lang->workflowfield->tips->keyValue     = '<strong>Key-Value Pair</strong> is displayed as the actual value and the display value when the flow data is called by other flows.<br /><strong>Key</strong> is one only, its ID is set as the Key by default.<br /><strong>Values</strong> can be several ones, and multiple values will be displayed one by one.';
$lang->workflowfield->tips->lengthNotice = 'Attention! It will cause data lose.';
$lang->workflowfield->tips->emptyStatus  = 'Set options of the status field first.';
$lang->workflowfield->tips->emptyExport  = 'No fields selected for the table <strong>TABLE</strong> and can not enable the search function. Sure to save?';
$lang->workflowfield->tips->emptySearch  = 'No fields selected and can not enable the search function. Sure to save?';

/* Placeholder */
$lang->workflowfield->placeholder = new stdclass();
$lang->workflowfield->placeholder->code         = 'Should be letters';
$lang->workflowfield->placeholder->sql          = 'Use a SQL query. Only the query is allowed. Other SQL operations are prohibited. The query result is key-value pairs. The 1st field of query will be the key of result and the 2nd one be the value. Other fields will be ignored. If there is only one field, it will be the key and the value';
$lang->workflowfield->placeholder->defaultValue = 'Seperated by space or comma.';
$lang->workflowfield->placeholder->optionCode   = 'It should be letters or numbers.';
$lang->workflowfield->placeholder->auto         = 'Automatically generated by the system';

/* Error */
$lang->workflowfield->error = new stdclass();
$lang->workflowfield->error->remainFields     = '<strong> %s </strong> is a reserved keyword in the system, please change the field code.';
$lang->workflowfield->error->emptyOptions     = 'Empty <strong>key</strong> and <strong>value</strong>.';
$lang->workflowfield->error->wrongCode        = 'The <strong> %s </strong> should be letters.';
$lang->workflowfield->error->longCode         = 'The length of the <strong> %s </strong> should not exceed 30.';
$lang->workflowfield->error->wrongSQL         = 'The SQL is wrong! Error: ';
$lang->workflowfield->error->notunique        = 'unique check';
$lang->workflowfield->error->wrongDecimal     = "<strong>Length</strong> format is <strong>(M,D)，M(0~65)，D(0~30)，M >= D</strong><br />";
$lang->workflowfield->error->wrongChar        = '<strong>Length</strong> should be 0~255';
$lang->workflowfield->error->wrongVarchar     = '<strong>Length</strong> should be 0~21844';
$lang->workflowfield->error->defaultValue     = 'The default length should not exceed %s.';
$lang->workflowfield->error->textDefaultValue = 'The text-field has no default value.';
$lang->workflowfield->error->duplicatedCode   = 'Please reset the duplicated <strong>Keys</strong> %s .';
$lang->workflowfield->error->emptyDefault     = 'Select a item as <strong>default</strong>.';
$lang->workflowfield->error->emptyCustomField = 'You have not added a field. Add one first.';
