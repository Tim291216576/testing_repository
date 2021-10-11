<?php
$lang->flow->template   = ' mẫu';
$lang->flow->showImport = ' Hiện nhập khẩu';
$lang->flow->link    = 'Liên kết ';
$lang->flow->unlink  = 'Hủy liên kết ';
$lang->flow->detail  = ' chi tiết';
$lang->flow->ditto   = 'Như trên';
$lang->flow->importMode = 'Nhập chế độ';

$lang->flow->selectLinkType = 'Chọn loại liên kết';
$lang->flow->unlinkConfirm  = 'Bạn có muốn hủy liên kết this %s?';
$lang->flow->filesNotEmpty  = 'Files không nên trống!';

$lang->flow->importModeList['template'] = 'Mẫu';
$lang->flow->importModeList['auto']  = 'Tự động';

$lang->flow->tips = new stdclass();
$lang->flow->tips->notice = 'Gửi thông báo tới người dùng được chọn.';
$lang->flow->tips->importMode['template'] = 'Trong chế độ nhập mẫu, việc khớp sẽ được thực hiện theo mẫu đã nhập và dữ liệu đủ điều kiện sẽ được nhập.';
$lang->flow->tips->importMode['auto']  = 'Trong chế độ nhập tự động, việc khớp sẽ được thực hiện theo các cài đặt xuất trường và quy trình của lịch biểu và dữ liệu đáp ứng các điều kiện sẽ được nhập.';

$lang->flow->error = new stdclass();;
$lang->flow->error->notFound    = 'Không được tìm thấy';
$lang->flow->error->emptyLayoutFields = "Tới [Quy trình] => [%s] => [Hành động] => [%s] => [Giao diện] để thiết lập trường hiển thị.";
