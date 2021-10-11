<?php
$lang->create      = '新建';
$lang->saveSuccess = '保存成功';
$lang->month       = '月';
$lang->day         = '日';
$lang->detail      = '詳情';
$lang->logout      = '簽退';
$lang->minus       = ' - ';

$lang->confirmDelete = '您確定要執行刪除操作嗎？';
$lang->deleteing     = '刪除中';

$lang->my->menu->review = '審批|my|review|type=all';

$lang->menu->oa  = '辦公|attend|personal|';
$lang->menuOrder[23] = 'oa';

$lang->oa = new stdclass();
$lang->oa->menu = new stdclass();
$lang->oa->menu->attend   = array('link' => '考勤|attend|personal', 'subModule' => 'attend');
$lang->oa->menu->leave    = array('link' => '請假|leave|personal', 'alias' => 'browse', 'subModule' => 'leave');
$lang->oa->menu->makeup   = array('link' => '補班|makeup|personal', 'alias' => 'create,edit,view,browse', 'subModule' => 'makeup');
$lang->oa->menu->overtime = array('link' => '加班|overtime|personal', 'subModule' => 'overtime');
$lang->oa->menu->lieu     = array('link' => '調休|lieu|personal', 'subModule' => 'lieu');
$lang->oa->menu->holiday  = array('link' => '節假日|holiday|browse', 'subModule' => 'holiday');
$lang->oa->menu->review   = array('link' => '審批|my|review|type=all&orderBy=status&from=oa');

$lang->oa->menuOrder[5]  = 'attend';
$lang->oa->menuOrder[10] = 'leave';
$lang->oa->menuOrder[15] = 'makeup';
$lang->oa->menuOrder[20] = 'overtime';
$lang->oa->menuOrder[25] = 'lieu';
$lang->oa->menuOrder[30] = 'holiday';
$lang->oa->menuOrder[35] = 'review';

$lang->attend = new stdclass();
$lang->attend->menu      = $lang->oa->menu;
$lang->attend->menuOrder = $lang->oa->menuOrder;

$lang->leave = new stdclass();
$lang->leave->menu      = $lang->oa->menu;
$lang->leave->menuOrder = $lang->oa->menuOrder;

$lang->makeup = new stdclass();
$lang->makeup->menu      = $lang->oa->menu;
$lang->makeup->menuOrder = $lang->oa->menuOrder;

$lang->overtime = new stdclass();
$lang->overtime->menu      = $lang->oa->menu;
$lang->overtime->menuOrder = $lang->oa->menuOrder;

$lang->lieu = new stdclass();
$lang->lieu->menu      = $lang->oa->menu;
$lang->lieu->menuOrder = $lang->oa->menuOrder;

$lang->holiday = new stdclass();
$lang->holiday->menu      = $lang->oa->menu;
$lang->holiday->menuOrder = $lang->oa->menuOrder;

$lang->menugroup->attend   = 'oa';
$lang->menugroup->leave    = 'oa';
$lang->menugroup->makeup   = 'oa';
$lang->menugroup->overtime = 'oa';
$lang->menugroup->lieu     = 'oa';
$lang->menugroup->holiday  = 'oa';

$lang->attend->featurebar = new stdclass();
$lang->attend->featurebar->personal     = '我的考勤|attend|personal|';
$lang->attend->featurebar->department   = '部門考勤|attend|department|';
$lang->attend->featurebar->company      = '公司考勤|attend|company|';
$lang->attend->featurebar->detail       = '考勤明細|attend|detail|';
$lang->attend->featurebar->browsereview = '補錄審核|attend|browsereview|';
$lang->attend->featurebar->stat         = '統計|attend|stat|';
$lang->attend->featurebar->settings     = array('link' => '設置|attend|settings|');

$lang->leave->featurebar = new stdclass();
$lang->leave->featurebar->personal     = '我的請假|leave|personal|';
$lang->leave->featurebar->browseReview = '我的審核|leave|browsereview|';
$lang->leave->featurebar->company      = '所有請假|leave|company|';
$lang->leave->featurebar->setReviewer  = '設置|leave|setReviewer|';

$lang->makeup->featurebar = new stdclass();
$lang->makeup->featurebar->personal     = '我的補班|makeup|personal|';
$lang->makeup->featurebar->browseReview = '我的審核|makeup|browsereview|';
$lang->makeup->featurebar->company      = '所有補班|makeup|company|';
$lang->makeup->featurebar->setReviewer  = '設置|makeup|setReviewer|';

$lang->overtime->featurebar = new stdclass();
$lang->overtime->featurebar->personal     = '我的加班|overtime|personal|';
$lang->overtime->featurebar->browseReview = '我的審核|overtime|browsereview|';
$lang->overtime->featurebar->company      = '所有加班|overtime|company|';
$lang->overtime->featurebar->setReviewer  = '設置|overtime|setReviewer|';

$lang->lieu->featurebar = new stdclass();
$lang->lieu->featurebar->personal     = '我的調休|lieu|personal|';
$lang->lieu->featurebar->browseReview = '我的審核|lieu|browsereview|';
$lang->lieu->featurebar->company      = '所有調休|lieu|company|';
$lang->lieu->featurebar->setReviewer  = '設置|lieu|setReviewer|';

$lang->holiday->featurebar = new stdclass();
$lang->holiday->featurebar->browse = '所有|holiday|browse|';
