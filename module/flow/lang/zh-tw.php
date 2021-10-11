<?php
$lang->flow->template   = '模板';
$lang->flow->showImport = '導入確認';
$lang->flow->link       = '關聯';
$lang->flow->unlink     = '移除';
$lang->flow->detail     = '詳情';
$lang->flow->ditto      = '同上';
$lang->flow->importMode = '導入模式';
$lang->flow->setExport  = '流程設計 => 導出設置';
$lang->flow->setSearch  = '流程設計 => 搜索設置';

$lang->flow->selectLinkType = '選擇要關聯的數據';
$lang->flow->unlinkConfirm  = '您確定要移除該%s嗎？';
$lang->flow->filesNotEmpty  = '附件不能為空！';

$lang->flow->importModeList['template'] = '模版導入';
$lang->flow->importModeList['auto']     = '自動導入';

$lang->flow->tips = new stdclass();
$lang->flow->tips->notice                 = '發送提醒給所選擇的用戶';
$lang->flow->tips->emptyExportFields      = '沒有可以導出的欄位，請前往 <strong>%s</strong> 中進行設置。';
$lang->flow->tips->emptySearchFields      = '沒有可以搜索的欄位，請前往 <strong>%s</strong> 中進行設置。';
$lang->flow->tips->importMode['template'] = '按照導入模板匹配，符合條件的數據才會被導入。';
$lang->flow->tips->importMode['auto']     = '按照導出設置匹配，符合條件的數據才會被導入。';

$lang->flow->error = new stdclass();;
$lang->flow->error->notFound          = '數據未找到。';
$lang->flow->error->emptyLayoutFields = "請前往 『流程』 => 『%s』 => 『動作』 => 『%s』 => 『界面』 設置界面顯示的內容。";
