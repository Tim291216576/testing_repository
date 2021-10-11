<?php
$lang->workflow->common  = 'Quy trình';
$lang->workflow->browseFlow = 'Xem quy trình';
$lang->workflow->browseDB   = 'Xem DB';
$lang->workflow->create  = 'Tạo quy trình';
$lang->workflow->copy    = 'Copy quy trình';
$lang->workflow->edit    = 'Sửa quy trình';
$lang->workflow->view    = 'Xem quy trình';
$lang->workflow->delete  = 'Xóa quy trình';
$lang->workflow->setJS   = 'JS';
$lang->workflow->setCSS  = 'CSS';
$lang->workflow->backup  = 'Sao lưu quy trình';
$lang->workflow->upgrade    = 'Nâng cấp quy trình';
$lang->workflow->upgradeAction = 'Nâng cấp quy trình';

$lang->workflow->id   = 'ID';
$lang->workflow->parent  = 'Trước';
$lang->workflow->child   = 'Tiếp';
$lang->workflow->type    = 'Loại';
$lang->workflow->app     = 'App';
$lang->workflow->position   = 'Vị trí';
$lang->workflow->module  = 'Module';
$lang->workflow->table   = 'Bảng';
$lang->workflow->name    = 'Tên';
$lang->workflow->order   = 'Sắp xếp';
$lang->workflow->buildin    = 'Tích hợp';
$lang->workflow->administrator = 'Danh sách trắng';
$lang->workflow->desc    = 'Mô tả';
$lang->workflow->version    = 'Phiên bản';
$lang->workflow->createdBy  = 'Người tạo';
$lang->workflow->createdDate   = 'Ngày tạo';
$lang->workflow->editedBy   = 'Người sửa';
$lang->workflow->editedDate = 'Ngày sửa';

$lang->workflow->actionFlowWidth  = 390;
$lang->workflow->actionTableWidth = 110;

$lang->workflow->copyFlow = 'copy';
$lang->workflow->source   = 'Nguồn quy trình';
$lang->workflow->field = 'Trường';
$lang->workflow->action   = 'Hành động';
$lang->workflow->label = 'Nhãn';
$lang->workflow->subTable = 'Bảng con';
$lang->workflow->relation = 'Quan hệ';
$lang->workflow->users = 'Người dùng';
$lang->workflow->groups   = 'Nhóm';

$lang->workflow->positionList['before'] = 'Trước';
$lang->workflow->positionList['after']  = 'Sau';

$lang->workflow->buildinList['0'] = 'Không';
$lang->workflow->buildinList['1'] = 'Có';

$lang->workflow->upgrade = new stdclass();
$lang->workflow->upgrade->common   = 'Nâng cấp';
$lang->workflow->upgrade->backup   = 'Sao lưu';
$lang->workflow->upgrade->backupSuccess  = 'Đã nâng cấp';
$lang->workflow->upgrade->newVersion  = 'Nhận một phiên bản mới';
$lang->workflow->upgrade->clickme  = 'Nâng cấp';
$lang->workflow->upgrade->start    = 'Bắt đầu';
$lang->workflow->upgrade->currentVersion = 'Phiên bản hiện tại';
$lang->workflow->upgrade->selectVersion  = 'Phiên bản mới';
$lang->workflow->upgrade->confirm  = 'Xác nhận nâng cấp SQL';
$lang->workflow->upgrade->upgrade  = 'Nâng cấp module hiện tại';
$lang->workflow->upgrade->upgradeFail = 'Thất bại!';
$lang->workflow->upgrade->upgradeSuccess = 'Đã nâng cấp!';
$lang->workflow->upgrade->install  = 'Cài đặt Module mới';
$lang->workflow->upgrade->installFail = 'Thất bại!';
$lang->workflow->upgrade->installSuccess = 'Đã cài đặt';

/* Tips */
$lang->workflow->tips = new stdclass();
$lang->workflow->tips->noCSSTag  = 'Không có &lt;style&gt;&lt;/style&gt; tag';
$lang->workflow->tips->noJSTag   = 'Không có &lt;script&gt;&lt;/script&gt;tag';
$lang->workflow->tips->flowCSS   = ', đã nạp trong tất cả trang.';
$lang->workflow->tips->flowJS = ', đã nạp trong tất cả trang.';
$lang->workflow->tips->actionCSS = ', đã nạp trong trang của hành động hiện tại.';
$lang->workflow->tips->actionJS  = ', đã nạp trong trang của hành động hiện tại.';

/* Title */
$lang->workflow->title = new stdclass();
$lang->workflow->title->subTable   = 'Bảng con được dùng để ghi nhận chi tiết của %s.';
$lang->workflow->title->noCopy  = 'Quy trình tích hợp không thể sao chép.';
$lang->workflow->title->noLabel = 'Quy trình tích hợp không thể thiết lập nhãn';
$lang->workflow->title->noSubTable = 'Quy trình tích hợp không thể thiết lập nhãn con.';
$lang->workflow->title->noRelation = 'Quy trình tích hợp không thể thiết lập quan hệ.';
$lang->workflow->title->noJS    = 'Quy trình tích hợp không thể js.';
$lang->workflow->title->noCSS   = 'Quy trình tích hợp không thể css.';

/* Placeholder */
$lang->workflow->placeholder = new stdclass();
$lang->workflow->placeholder->module = 'Chỉ chữ. Nó không thể thay đổi một khi đã lưu.';

/* Error */
$lang->workflow->error = new stdclass();
$lang->workflow->error->createTableFail = 'Thất bại tạo một bảng.';
$lang->workflow->error->buildInModule   = 'Mã quy trình không nên là giống với module tích hợp trong Zdoo Pro.';
$lang->workflow->error->wrongCode    = '<strong> %s </strong> nên dùng chữ.';

$lang->workflowtable = new stdclass();
$lang->workflowtable->common = 'Bảng con';
$lang->workflowtable->browse = 'Xem bảng';
$lang->workflowtable->create = 'Tạo bảng';
$lang->workflowtable->edit   = 'Sửa bảng';
$lang->workflowtable->view   = 'Xem bảng';
$lang->workflowtable->delete = 'Xóa bảng';
$lang->workflowtable->name   = 'Tên';
