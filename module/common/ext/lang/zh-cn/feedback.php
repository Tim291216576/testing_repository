<?php
$lang->menu->feedback = '反馈|feedback|admin|';
$lang->menuOrder[24]  = 'feedback';
$lang->searchLang     = '搜索';

$lang->feedback = new stdclass();
$lang->feedback->menu = new stdclass();
$lang->feedback->menu->unclosed   = array('link' => '未关闭|feedback|admin|browseType=unclosed', 'subModule' => 'tree');
$lang->feedback->menu->all        = array('link' => '全部|feedback|admin|browseType=all');
$lang->feedback->menu->public     = array('link' => '公开|feedback|admin|browseType=public');
$lang->feedback->menu->tostory    = array('link' => "转{$lang->storyCommon}|feedback|admin|browseType=tostory");
$lang->feedback->menu->totask     = array('link' => '转任务|feedback|admin|browseType=totask');
$lang->feedback->menu->tobug      = array('link' => '转Bug|feedback|admin|browseType=tobug');
$lang->feedback->menu->totodo     = array('link' => '转待办|feedback|admin|browseType=totodo');
$lang->feedback->menu->review     = array('link' => '待评审|feedback|admin|browseType=review');
$lang->feedback->menu->assigntome = array('link' => '指派给我|feedback|admin|browseType=assigntome');
$lang->feedback->menu->bysearch   = array('link' => '<a href="javascript:;" class="querybox-toggle"><i class="icon-search icon"></i> ' . $lang->searchLang . '</a>');
$lang->feedback->menu->faq        = array('link' => 'FAQ|faq|browse|');
$lang->feedback->menu->products   = array('link' => '权限|feedback|products', 'alias' => 'manageproduct');

$lang->feedback->menuOrder[5]  = 'unclosed';
$lang->feedback->menuOrder[10] = 'all';
$lang->feedback->menuOrder[15] = 'public';
$lang->feedback->menuOrder[20] = 'tostory';
$lang->feedback->menuOrder[25] = 'totask';
$lang->feedback->menuOrder[30] = 'tobug';
$lang->feedback->menuOrder[35] = 'totodo';
$lang->feedback->menuOrder[40] = 'review';
$lang->feedback->menuOrder[45] = 'assigntome';
$lang->feedback->menuOrder[50] = 'bysearch';
$lang->feedback->menuOrder[55] = 'faq';
$lang->feedback->menuOrder[60] = 'products';

$lang->faq = new stdclass();
$lang->faq->menu      = $lang->feedback->menu;
$lang->faq->menuOrder = $lang->feedback->menuOrder;
$lang->menugroup->faq = 'feedback';

$lang->feedbackView[0] = '研发界面';
$lang->feedbackView[1] = '非研发界面';

global $app;
if(!empty($_SESSION['user']->feedback) or !empty($_COOKIE['feedbackView']) and $app and $app->viewType == 'mhtml')
{
    $lang->feedback->menu = new stdclass();
    $lang->feedback->menu->unclosed = array('link' => '未关闭|feedback|browse|browseType=unclosed');
    $lang->feedback->menu->all      = array('link' => '全部|feedback|browse|browseType=all');
    $lang->feedback->menu->public   = array('link' => '公开|feedback|browse|browseType=public');

    $lang->feedback->menuOrder = array();
    $lang->feedback->menuOrder[5]  = 'unclosed';
    $lang->feedback->menuOrder[10] = 'all';
    $lang->feedback->menuOrder[15] = 'public';
}
