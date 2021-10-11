<?php
$lang->project->editrelation  = 'Quản lý mối quan hệ nhiệm vụ';
$lang->project->maintainRelation = 'Quản lý mối quan hệ';
$lang->project->deleterelation   = 'Xóa mối quan hệ';
$lang->project->viewrelation  = 'Xem mối quan hệ';
$lang->project->ganttchart    = 'Biểu đồ Gantt';

$lang->project->gantt    = new stdclass();
$lang->project->gantt->common  = 'Biểu đồ Gantt';
$lang->project->gantt->id   = 'ID';
$lang->project->gantt->pretask = 'Nhiệm vụ';
$lang->project->gantt->condition  = 'Hành động';
$lang->project->gantt->task    = 'Nhiệm vụ';
$lang->project->gantt->action  = 'Hành động';
$lang->project->gantt->type    = 'Loại';
$lang->project->gantt->exportImg  = 'Xuất ra Image';
$lang->project->gantt->exportPDF  = 'Xuất ra PDF';
$lang->project->gantt->exporting  = 'Đang xuất...';
$lang->project->gantt->exportFail = 'Xuất thất bại.';

$lang->project->gantt->createRelationOfTasks = 'Thêm mối quan hệ nhiệm vụ';
$lang->project->gantt->newCreateRelationOfTasks = 'Thêm mối quan hệ nhiệm vụ';
$lang->project->gantt->editRelationOfTasks   = 'Sửa mối quan hệ nhiệm vụ';
$lang->project->gantt->relationOfTasks    = 'Xem mối quan hệ nhiệm vụ';
$lang->project->gantt->relation     = 'Mối quan hệ nhiệm vụ';
$lang->project->gantt->showCriticalPath   = 'Hiện đường chính';
$lang->project->gantt->hideCriticalPath   = 'Ẩn đường chính';
$lang->project->gantt->fullScreen      = 'Toàn màn hình';

$lang->project->gantt->zooming['day']   = 'Ngày';
$lang->project->gantt->zooming['week']  = 'Tuần';
$lang->project->gantt->zooming['month'] = 'Tháng';

$lang->project->gantt->assignTo  = 'Giao cho';
$lang->project->gantt->duration  = 'Thời gian';
$lang->project->gantt->comp   = 'Tiến độ';
$lang->project->gantt->startDate = 'Bắt đầu';
$lang->project->gantt->endDate   = 'Kết thúc';
$lang->project->gantt->days   = ' ngày';
$lang->project->gantt->format = 'Định dạng';

$lang->project->gantt->preTaskStatus['']   = '';
$lang->project->gantt->preTaskStatus['end']   = 'đã kết thúc, sau đó';
$lang->project->gantt->preTaskStatus['begin'] = 'đã bắt đầu, sau đó';

$lang->project->gantt->taskActions[''] = '';
$lang->project->gantt->taskActions['begin'] = 'có thể bắt đầu.';
$lang->project->gantt->taskActions['end']   = 'có thể kết thúc.';

$lang->project->gantt->color[0] = 'bbb';
$lang->project->gantt->color[1] = 'ff5d5d';
$lang->project->gantt->color[2] = 'ff9800';
$lang->project->gantt->color[3] = '16a8f8';
$lang->project->gantt->color[4] = '00da88';

$lang->project->gantt->browseType['type']    = 'Loại nhiệm vụ';
$lang->project->gantt->browseType['module']  = 'Module';
$lang->project->gantt->browseType['assignedTo'] = 'giao cho';
$lang->project->gantt->browseType['story']   = 'câu chuyện';

$lang->project->gantt->confirmDelete = 'Bạn có muốn xóa mối quan hệ này?';
$lang->project->gantt->tmpNotWrite   = 'Không thể ghi';

$lang->project->gantt->warning     = new stdclass();
$lang->project->gantt->warning->noEditSame  = "Nhiệm vụ trước và sau ID đang tồn tại %s nên giống nhau.";
$lang->project->gantt->warning->noEditRepeat   = "Nhiệm vụ quan hệ giữa ID đang tồn tại %s và ID %s được nhân bản!";
$lang->project->gantt->warning->noEditContrary = "Nhiệm vụ quan hệ giữa ID đang tồn tại %s và ID %s xung đột!";
$lang->project->gantt->warning->noRepeat    = "Nhiệm vụ quan hệ giữa ID đang tồn tại %s và ID đã thêm %s được nhân bản!";
$lang->project->gantt->warning->noContrary  = "Nhiệm vụ quan hệ giữa ID đang tồn tại %s và ID đã thêm %s xung đột!";
$lang->project->gantt->warning->noNewSame   = "Nhiệm vụ trước và sau ID đã thêm %s nên giống nhau.";
$lang->project->gantt->warning->noNewRepeat = "Nhiệm vụ quan hệ giữa ID đã thêm %s và ID %s được nhân bản!";
$lang->project->gantt->warning->noNewContrary  = "Nhiệm vụ quan hệ giữa ID đã thêm %s và ID %s xung đột!";
