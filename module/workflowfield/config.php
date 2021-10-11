<?php
$config->workflowfield->remainFields = 'file,actions';  // The system remain fields.

$config->workflowfield->require = new stdclass();
$config->workflowfield->require->create = 'name, field, module, control';
$config->workflowfield->require->edit   = 'name, field, control';

$config->workflowfield->disabledFields['subTables'] = 'status,assignedTo,editedBy,editedDate,assignedBy,assignedDate,deleted';

$config->workflowfield->typeList['number']['tinyint']   = 'tinyint';
$config->workflowfield->typeList['number']['smallint']  = 'smallint';
$config->workflowfield->typeList['number']['mediumint'] = 'mediumint';
$config->workflowfield->typeList['number']['int']       = 'int';
$config->workflowfield->typeList['number']['decimal']   = 'decimal';
$config->workflowfield->typeList['number']['float']     = 'float';
$config->workflowfield->typeList['number']['double']    = 'double';

$config->workflowfield->typeList['date']['date']      = 'date';
$config->workflowfield->typeList['date']['datetime']  = 'datetime';
$config->workflowfield->typeList['date']['timestamp'] = 'timestamp';

$config->workflowfield->typeList['string']['char']    = 'char';
$config->workflowfield->typeList['string']['varchar'] = 'varchar';
$config->workflowfield->typeList['string']['text']    = 'text';

$config->workflowfield->lengthList[10]  = ',date,';
$config->workflowfield->lengthList[19]  = ',datetime,';
$config->workflowfield->lengthList[200] = ',input,select,radio,checkbox,';

$config->workflowfield->default = new stdclass();
$config->workflowfield->default->fields['id']           = 'mediumint(8) unsigned NOT NULL AUTO_INCREMENT';
$config->workflowfield->default->fields['parent']       = 'mediumint(8) unsigned NOT NULL';
$config->workflowfield->default->fields['assignedTo']   = 'varchar(30) NOT NULL';
$config->workflowfield->default->fields['status']       = 'varchar(30) NOT NULL';
$config->workflowfield->default->fields['createdBy']    = 'varchar(30) NOT NULL';
$config->workflowfield->default->fields['createdDate']  = 'datetime NOT NULL';
$config->workflowfield->default->fields['editedBy']     = 'varchar(30) NOT NULL';
$config->workflowfield->default->fields['editedDate']   = 'datetime NOT NULL';
$config->workflowfield->default->fields['assignedBy']   = 'varchar(30) NOT NULL';
$config->workflowfield->default->fields['assignedDate'] = 'datetime NOT NULL';
$config->workflowfield->default->fields['deleted']      = "enum('0', '1') NOT NULL DEFAULT '0'";

$config->workflowfield->default->fieldTypes['id']           = 'mediumint';
$config->workflowfield->default->fieldTypes['parent']       = 'mediumint';
$config->workflowfield->default->fieldTypes['assignedTo']   = 'varchar';
$config->workflowfield->default->fieldTypes['status']       = 'varchar';
$config->workflowfield->default->fieldTypes['createdBy']    = 'varchar';
$config->workflowfield->default->fieldTypes['createdDate']  = 'datetime';
$config->workflowfield->default->fieldTypes['editedBy']     = 'varchar';
$config->workflowfield->default->fieldTypes['editedDate']   = 'datetime';
$config->workflowfield->default->fieldTypes['assignedBy']   = 'varchar';
$config->workflowfield->default->fieldTypes['assignedDate'] = 'datetime';
$config->workflowfield->default->fieldTypes['deleted']      = 'varchar';

$config->workflowfield->default->fieldLength['id']           = '8';
$config->workflowfield->default->fieldLength['parent']       = '8';
$config->workflowfield->default->fieldLength['assignedTo']   = '30';
$config->workflowfield->default->fieldLength['status']       = '30';
$config->workflowfield->default->fieldLength['createdBy']    = '30';
$config->workflowfield->default->fieldLength['createdDate']  = '';
$config->workflowfield->default->fieldLength['editedBy']     = '30';
$config->workflowfield->default->fieldLength['editedDate']   = '';
$config->workflowfield->default->fieldLength['assignedBy']   = '30';
$config->workflowfield->default->fieldLength['assignedDate'] = '';
$config->workflowfield->default->fieldLength['deleted']      = '10';

$config->workflowfield->default->controls['id']           = 'label';
$config->workflowfield->default->controls['parent']       = 'label';
$config->workflowfield->default->controls['assignedTo']   = 'select';
$config->workflowfield->default->controls['status']       = 'select';
$config->workflowfield->default->controls['createdBy']    = 'select';
$config->workflowfield->default->controls['createdDate']  = 'datetime';
$config->workflowfield->default->controls['editedBy']     = 'select';
$config->workflowfield->default->controls['editedDate']   = 'datetime';
$config->workflowfield->default->controls['assignedBy']   = 'select';
$config->workflowfield->default->controls['assignedDate'] = 'datetime';
$config->workflowfield->default->controls['deleted']      = 'radio';

$config->workflowfield->default->options['id']           = '[]';
$config->workflowfield->default->options['parent']       = '[]';
$config->workflowfield->default->options['assignedTo']   = 'user';
$config->workflowfield->default->options['status']       = '[]';
$config->workflowfield->default->options['createdBy']    = 'user';
$config->workflowfield->default->options['createdDate']  = '[]';
$config->workflowfield->default->options['editedBy']     = 'user';
$config->workflowfield->default->options['editedDate']   = '[]';
$config->workflowfield->default->options['assignedBy']   = 'user';
$config->workflowfield->default->options['assignedDate'] = '[]';
$config->workflowfield->default->options['deleted']      = $this->lang->workflowfield->default->options->deleted;

$config->workflowfield->default->values['id']           = '';
$config->workflowfield->default->values['parent']       = '0';
$config->workflowfield->default->values['assignedTo']   = '';
$config->workflowfield->default->values['status']       = '';
$config->workflowfield->default->values['createdBy']    = '';
$config->workflowfield->default->values['createdDate']  = '';
$config->workflowfield->default->values['editedBy']     = '';
$config->workflowfield->default->values['editedDate']   = '';
$config->workflowfield->default->values['assignedBy']   = '';
$config->workflowfield->default->values['assignedDate'] = '';
$config->workflowfield->default->values['deleted']      = '0';

$config->workflowfield->default->indexes = 'PRIMARY KEY `id` (`id`)';
