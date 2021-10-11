<?php
$lang->project->webMenu = new stdclass();
$lang->project->webMenu->task  = array('link' => "Nhiệm vụ|project|task|projectID=%s", 'subModule' => 'task', 'alias' => 'importtask,importbug,tree');
$lang->project->webMenu->story = "Câu chuyện|project|story|projectID=%s";
$lang->project->webMenu->bug   = "Bug|project|bug|projectID=%s";
$lang->project->webMenu->build = array('link' => "Bản dựng|project|build|projectID=%s", 'subModule' => 'build');
$lang->project->webMenu->testtask = "Test nhiệm vụ|project|testtask|projectID=%s";
$lang->project->webMenu->team  = "Đội nhóm|project|team|projectID=%s";
$lang->project->webMenu->action   = "Lịch sử|project|dynamic|projectID=%s";
$lang->project->webMenu->view  = "Tổng quan|project|view|projectID=%s";
$lang->project->webMenu->all   = "Tất cả {$lang->projectCommon}|project|all|";

$lang->project->webMenuOrder[5]  = "task";
$lang->project->webMenuOrder[10] = "story";
$lang->project->webMenuOrder[15] = "bug";
$lang->project->webMenuOrder[20] = "build";
$lang->project->webMenuOrder[25] = "testtask";
$lang->project->webMenuOrder[30] = "team";
$lang->project->webMenuOrder[35] = "action";
$lang->project->webMenuOrder[40] = "view";
$lang->project->webMenuOrder[45] = "all";
