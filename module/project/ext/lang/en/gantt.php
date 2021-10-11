<?php
$lang->project->editrelation     = 'Manage Task Relation';
$lang->project->maintainRelation = 'Manage Relation';
$lang->project->deleterelation   = 'Delete Relation';
$lang->project->viewrelation     = 'View Relation';
$lang->project->ganttchart       = 'Gantt Chart';

$lang->project->gantt             = new stdclass();
$lang->project->gantt->common     = 'Gantt Chart';
$lang->project->gantt->id         = 'ID';
$lang->project->gantt->pretask    = 'Task';
$lang->project->gantt->condition  = 'Action';
$lang->project->gantt->task       = 'Task';
$lang->project->gantt->action     = 'Action';
$lang->project->gantt->type       = 'Type';
$lang->project->gantt->exportImg  = 'Export as Image';
$lang->project->gantt->exportPDF  = 'Export as PDF';
$lang->project->gantt->exporting  = 'Exporting...';
$lang->project->gantt->exportFail = 'Failed to export.';

$lang->project->gantt->createRelationOfTasks    = 'Add Task Relation';
$lang->project->gantt->newCreateRelationOfTasks = 'Add Task Relation';
$lang->project->gantt->editRelationOfTasks      = 'Edit Task Relation';
$lang->project->gantt->relationOfTasks          = 'View Task Relation';
$lang->project->gantt->relation                 = 'Task Relation';
$lang->project->gantt->showCriticalPath         = 'Show Critical Path';
$lang->project->gantt->hideCriticalPath         = 'Hide Critical Path';
$lang->project->gantt->fullScreen               = 'Full Screen';

$lang->project->gantt->zooming['day']   = 'Day';
$lang->project->gantt->zooming['week']  = 'Week';
$lang->project->gantt->zooming['month'] = 'Month';

$lang->project->gantt->assignTo  = 'AssignedTo';
$lang->project->gantt->duration  = 'Duration';
$lang->project->gantt->comp      = 'Progress';
$lang->project->gantt->startDate = 'Start Date';
$lang->project->gantt->endDate   = 'End Date';
$lang->project->gantt->days      = ' Days';
$lang->project->gantt->format    = 'Format';

$lang->project->gantt->preTaskStatus['']      = '';
$lang->project->gantt->preTaskStatus['end']   = 'is finished, then';
$lang->project->gantt->preTaskStatus['begin'] = 'is started, then';

$lang->project->gantt->taskActions[''] = '';
$lang->project->gantt->taskActions['begin'] = 'can be started.';
$lang->project->gantt->taskActions['end']   = 'can be finished.';

$lang->project->gantt->color[0] = 'bbb';
$lang->project->gantt->color[1] = 'ff5d5d';
$lang->project->gantt->color[2] = 'ff9800';
$lang->project->gantt->color[3] = '16a8f8';
$lang->project->gantt->color[4] = '00da88';

$lang->project->gantt->browseType['type']       = 'Group by Task Type';
$lang->project->gantt->browseType['module']     = 'Group by Module';
$lang->project->gantt->browseType['assignedTo'] = 'Group by AssignedTo';
$lang->project->gantt->browseType['story']      = 'Group by Story';

$lang->project->gantt->confirmDelete = 'Do you want to delete this relation?';
$lang->project->gantt->tmpNotWrite   = 'Not Writable';

$lang->project->gantt->warning                 = new stdclass();
$lang->project->gantt->warning->noEditSame     = "Tasks before and after the existing ID %s should not be the same.";
$lang->project->gantt->warning->noEditRepeat   = "Task relation between the existing ID %s and ID %s is duplicated!";
$lang->project->gantt->warning->noEditContrary = "Task relation between the existing ID %s and ID %s conflict!";
$lang->project->gantt->warning->noRepeat       = "Task relation between the existing ID %s and the added ID %s is duplicated!";
$lang->project->gantt->warning->noContrary     = "Task relation between the existing ID %s and the added ID %s conflict!";
$lang->project->gantt->warning->noNewSame      = "Tasks before and after the added ID %s should not be the same.";
$lang->project->gantt->warning->noNewRepeat    = "Task relation between the added ID %s and ID %s is duplicated!";
$lang->project->gantt->warning->noNewContrary  = "Task relation between the added ID %s and ID %s conflict!";
