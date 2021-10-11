<?php
$config->workflowlayout->noTotalFields = 'id,parent';

$config->workflowlayout->disabledFields['view']        = 'parent,deleted';
$config->workflowlayout->disabledFields['browse']      = 'parent,deleted,files';
$config->workflowlayout->disabledFields['create']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['batchcreate'] = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['batchedit']   = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['batchassign'] = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['edit']        = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['assign']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['delete']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate,actions,files';
$config->workflowlayout->disabledFields['custom']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['subTables']   = 'id,parent,status,subStatus,assignedTo,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate,actions,files';
