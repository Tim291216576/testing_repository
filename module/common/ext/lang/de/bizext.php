<?php
$lang->proVersion   = "";
$lang->donate       = '';
$lang->try          = ' Trial';
$lang->proName      = 'Pro';
$lang->expireDate   = "Expiration: %s";
$lang->forever      = "Permanent";
$lang->unlimited    = "Unlimited";
$lang->licensedUser = "User Licensed: %s";

$lang->noticeLimited = "<div style='float:left;color:red' id='userLimited'>The number of pro users has exceeded that of the licensed. Please contact Renee at Renee@cnezsoft.com, or delete users.</div>"; 

$lang->admin->subMenu->system->license = 'License|admin|license';
$lang->admin->subMenuOrder->system[20] = 'license';

global $config;
if(!empty($config->URAndSR))
{
    $urCommon = zget($lang, 'urCommon', "Requirement");
    $srCommon = zget($lang, 'srCommon', "Story");
    $lang->my->menu->requirement = array('link' => "$urCommon|my|requirement|", 'subModule' => 'story');
    $lang->my->menu->story       = array('link' => "$srCommon|my|story|", 'subModule' => 'story');
    $lang->my->menuOrder[29]     = 'requirement';

    if($config->global->flow != 'onlyTask')
    {
        $lang->product->menu->requirement = array('link' => "$urCommon|product|browse|productID=%s&branch=&browseType=unclosed&param=0&storyType=requirement", 'alias' => 'batchedit', 'subModule' => 'story');
        $lang->product->menu->story       = array('link' => "$srCommon|product|browse|productID=%s", 'alias' => 'batchedit', 'subModule' => 'story');
        $lang->product->menuOrder[1]      = 'requirement';
    }
}
