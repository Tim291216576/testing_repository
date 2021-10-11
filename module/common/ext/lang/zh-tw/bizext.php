<?php
$lang->proVersion   = "";
$lang->donate       = '';
$lang->try          = ' 試用';
$lang->proName      = '專業版';
$lang->expireDate   = "到期時間：%s";
$lang->forever      = "永久授權";
$lang->unlimited    = "不限人數";
$lang->licensedUser = "授權人數：%s";

$lang->noticeLimited = "<div style='float:left;color:red' id='userLimited'>已經超出專業版授權人數限制。請聯繫：4006-8899-23，或者刪除用戶。</div>"; 

$lang->admin->subMenu->system->license = '授權信息|admin|license';
$lang->admin->subMenuOrder->system[20] = 'license';

global $config;
if(!empty($config->URAndSR))
{
    $urCommon = zget($lang, 'urCommon', "用戶{$lang->storyCommon}");
    $srCommon = zget($lang, 'srCommon', "研發{$lang->storyCommon}");
    $lang->my->menu->requirement = array('link' => "{$urCommon}|my|requirement|", 'subModule' => 'story');
    $lang->my->menu->story       = array('link' => "{$srCommon}|my|story|", 'subModule' => 'story');
    $lang->my->menuOrder[29]     = 'requirement';

    if($config->global->flow != 'onlyTask')
    {
        $lang->product->menu->requirement = array('link' => "{$urCommon}|product|browse|productID=%s&branch=&browseType=unclosed&param=0&storyType=requirement", 'alias' => 'batchedit', 'subModule' => 'story');
        $lang->product->menu->story       = array('link' => "{$srCommon}|product|browse|productID=%s", 'alias' => 'batchedit', 'subModule' => 'story');
        $lang->product->menuOrder[1]      = 'requirement';
    }
}
