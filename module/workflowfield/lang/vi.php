<?php
$lang->workflowfield->common = 'Trường quy trình';
$lang->workflowfield->browse = 'Trường';
$lang->workflowfield->create = 'Tạo trường';
$lang->workflowfield->edit   = 'Sửa trường';
$lang->workflowfield->delete = 'Xóa trường';
$lang->workflowfield->sort   = 'Sắp xếp trường';
$lang->workflowfield->setExport = 'Xuất Thiết lập';

$lang->workflowfield->id     = 'ID';
$lang->workflowfield->module    = 'Module';
$lang->workflowfield->field  = 'Trường';
$lang->workflowfield->type   = 'Loại';
$lang->workflowfield->length    = 'Chiều dài';
$lang->workflowfield->name   = 'Tên';
$lang->workflowfield->control   = 'Control';
$lang->workflowfield->options   = 'Tùy chọn';
$lang->workflowfield->defaultValue = 'Mặc định';
$lang->workflowfield->rules  = 'Rule';
$lang->workflowfield->placeholder  = 'Placeholder';
$lang->workflowfield->canExport = 'Xuất';
$lang->workflowfield->canSearch = 'Tìm kiếm';
$lang->workflowfield->isKeyValue   = 'Key-Value';
$lang->workflowfield->order  = 'Sắp xếp';
$lang->workflowfield->buildin   = 'Tích hợp';
$lang->workflowfield->desc   = 'Mô tả';
$lang->workflowfield->createdBy = 'Người tạo';
$lang->workflowfield->createdDate  = 'Ngày tạo';
$lang->workflowfield->editedBy  = 'Người sửa';
$lang->workflowfield->editedDate   = 'Ngày sửa';

$lang->workflowfield->position   = 'Vị trí';
$lang->workflowfield->dataSource    = 'Nguồn dữ liệu';
$lang->workflowfield->sql     = 'SQL';
$lang->workflowfield->vars    = 'Biến';
$lang->workflowfield->addVar     = 'Thêm biến';
$lang->workflowfield->varName    = 'Tên biến';
$lang->workflowfield->showName   = 'Hiện tên';
$lang->workflowfield->requestType   = 'Control';
$lang->workflowfield->status     = 'Tình trạng';
$lang->workflowfield->subStatus  = 'Tình trạng con';
$lang->workflowfield->key     = 'Khóa';
$lang->workflowfield->value   = 'Giá trị';
$lang->workflowfield->defaultSubStatus = 'Mặc định';

$lang->workflowfield->typeGroup['number'] = 'Số';
$lang->workflowfield->typeGroup['date']   = 'Ngày & Tháng';
$lang->workflowfield->typeGroup['string'] = 'Chuỗi';

$lang->workflowfield->controlTypeList['label']  = 'Nhãn';
$lang->workflowfield->controlTypeList['input']  = 'Text';
$lang->workflowfield->controlTypeList['textarea']  = 'Richtext';
$lang->workflowfield->controlTypeList['date']   = 'Ngày';
$lang->workflowfield->controlTypeList['datetime']  = 'Thời gian';
$lang->workflowfield->controlTypeList['select']    = 'Dropdown';
$lang->workflowfield->controlTypeList['multi-select'] = 'Multi-Dropdown';
$lang->workflowfield->controlTypeList['radio']  = 'Radio';
$lang->workflowfield->controlTypeList['checkbox']  = 'Checkbox';

$lang->workflowfield->optionTypeList['sql']  = 'SQL';
$lang->workflowfield->optionTypeList['prevModule'] = 'Xem trước quy trình';

$lang->workflowfield->positionList['before'] = 'Trước';
$lang->workflowfield->positionList['after']  = 'Sau';

$lang->workflowfield->exportList[1] = 'Có';
$lang->workflowfield->exportList[0] = 'Không';

$lang->workflowfield->searchList[1] = 'Có';
$lang->workflowfield->searchList[0] = 'Không';

$lang->workflowfield->keyValueList['key']   = 'Khóa';
$lang->workflowfield->keyValueList['value'] = 'Giá trị';

$lang->workflowfield->buildinList['0'] = 'Không';
$lang->workflowfield->buildinList['1'] = 'Có';

$lang->workflowfield->default = new stdclass();
$lang->workflowfield->default->fields['id']     = 'ID';
$lang->workflowfield->default->fields['parent']    = 'Mẹ';
$lang->workflowfield->default->fields['assignedTo']   = 'Giao cho';
$lang->workflowfield->default->fields['status']    = 'Tình trạng';
$lang->workflowfield->default->fields['subStatus'] = 'Tình trạng con';
$lang->workflowfield->default->fields['createdBy'] = 'Người tạo';
$lang->workflowfield->default->fields['createdDate']  = 'Ngày tạo';
$lang->workflowfield->default->fields['editedBy']  = 'Người sửa';
$lang->workflowfield->default->fields['editedDate']   = 'Ngày sửa';
$lang->workflowfield->default->fields['assignedBy']   = 'Người giao';
$lang->workflowfield->default->fields['assignedDate'] = 'Đã giao';
$lang->workflowfield->default->fields['deleted']   = 'Đã xóa';

$lang->workflowfield->default->options = new stdclass();
$lang->workflowfield->default->options->deleted = array();
$lang->workflowfield->default->options->deleted['0'] = 'Chưa xóa';
$lang->workflowfield->default->options->deleted['1'] = 'Đã xóa';

/* Tips */
$lang->workflowfield->tips = new stdclass();
$lang->workflowfield->tips->keyValue  = '<strong>Key-Value Pair</strong> is displayed as the actual value and the display value when the flow data is called by other flows.<br /><strong>Key</strong> is one only, its ID is set as the Key by default.<br /><strong>Values</strong> can be several ones, and multiple values will be displayed one by one.';
$lang->workflowfield->tips->lengthNotice = 'Chú ý! Đây sẽ là nguyên nhân mất dữ liệu.';
$lang->workflowfield->tips->emptyStatus  = 'Thiết lập tùy chọn của trường tình trạng trước.';

/* Placeholder */
$lang->workflowfield->placeholder = new stdclass();
$lang->workflowfield->placeholder->code   = 'Nên là chữ';
$lang->workflowfield->placeholder->sql    = 'Sử dụng một truy vấn SQL. Chỉ cho phép truy vấn. Các hoạt động SQL khác đều bị cấm. Kết quả truy vấn là cặp khóa-giá trị. Trường truy vấn thứ 1 sẽ là chìa khóa của kết quả và trường thứ 2 là giá trị. Các lĩnh vực khác sẽ bị bỏ qua. Nếu chỉ có một trường, nó sẽ là khóa và giá trị';
$lang->workflowfield->placeholder->defaultValue = 'Phân chia bởi khoảng cách hoặc dấu phẩy.';
$lang->workflowfield->placeholder->optionCode   = 'Nó nên là chữ hoặc số.';

/* Error */
$lang->workflowfield->error = new stdclass();
$lang->workflowfield->error->remainFields  = '<strong> %s </strong> là một từ khóa dành riêng trong hệ thống, vui lòng thay đổi mã trường.';
$lang->workflowfield->error->emptyOptions  = 'Empty <strong>key</strong> and <strong>value</strong>.';
$lang->workflowfield->error->wrongCode  = 'The <strong> %s </strong> nên dùng chữ.';
$lang->workflowfield->error->longCode   = 'The length of the <strong> %s </strong> should not exceed 30.';
$lang->workflowfield->error->wrongSQL   = 'SQL sai! Lỗi: ';
$lang->workflowfield->error->notunique  = 'unique check';
$lang->workflowfield->error->wrongDecimal  = "<strong>Length</strong> format is <strong>(M,D)，M(0~65)，D(0~30)，M >= D</strong><br />";
$lang->workflowfield->error->wrongChar  = '<strong>Length</strong> should be 0~255';
$lang->workflowfield->error->wrongVarchar  = '<strong>Length</strong> should be 0~21844';
$lang->workflowfield->error->defaultValue  = 'The default length should not exceed %s.';
$lang->workflowfield->error->textDefaultValue = 'The text-field has no default value.';
$lang->workflowfield->error->duplicatedCode   = 'Vui lòng reset the duplicated <strong>Keys</strong> %s .';
$lang->workflowfield->error->emptyDefault  = 'Chọn a item as <strong>default</strong>.';
