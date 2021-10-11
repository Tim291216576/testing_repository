<?php
$lang->file->onlySupportXLSX = 'Only xlsx format import is supported. Please convert xlsx format and import again.';

$lang->excel->fileField = 'File';

$lang->excel->title            = new stdclass();
$lang->excel->title->testcase  = 'Case';
$lang->excel->title->bug       = 'Bug';
$lang->excel->title->task      = 'Task';
$lang->excel->title->story     = 'Story';
$lang->excel->title->caselib   = 'Library';
$lang->excel->title->sysValue  = 'System';
$lang->excel->title->tree      = 'Tree';

$lang->excel->error      = 'The value you entered is not in the dropdown.';
$lang->excel->errorTitle = 'Input Error';

$lang->excel->help           = new stdclass();
$lang->excel->help->testcase = "Use + '.' to mark case steps in a new line. Use + '.' for expectations corresponded to each steps. Title and Type are required. If left empty, data in the same row will be ommitted. ";
$lang->excel->help->bug      = "Title is required. If left empty, data in the same row will be ommitted.";
$lang->excel->help->task     = "Title and type are required. If left empty, data in the same row will be ommitted. Use '>'  before the titile to mark child tasks.";
$lang->excel->help->multiple = 'If you add multiple user tasks, please add it in the column of "Est.(h)" in "user name : Est.(h)" format, and each user will be in one line. User names are listed in the "F" column of the "system" worksheet.';
$lang->excel->help->story    = "Title is required. If left empty, data in the same row will be ommitted.";
