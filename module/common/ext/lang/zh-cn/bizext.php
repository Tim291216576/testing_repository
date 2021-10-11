<?php
$lang->proVersion   = "";
$lang->donate       = '';
$lang->try          = ' 试用';
$lang->proName      = '专业版';
$lang->expireDate   = "到期时间：%s";
$lang->forever      = "永久授权";
$lang->unlimited    = "不限人数";
$lang->licensedUser = "授权人数：%s";

$lang->noticeLimited = "<div style='float:left;color:red' id='userLimited'>已经超出专业版授权人数限制。请联系：4006-8899-23，或者删除用户。</div>"; 

$lang->admin->subMenu->system->license = '授权信息|admin|license';
$lang->admin->subMenuOrder->system[20] = 'license';

global $config;
if(!empty($config->URAndSR))
{
    $urCommon = zget($lang, 'urCommon', "用户{$lang->storyCommon}");
    $srCommon = zget($lang, 'srCommon', "研发{$lang->storyCommon}");
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
