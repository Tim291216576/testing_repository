<?php
$lang->story->typeList['story'] = $lang->storyCommon;

$lang->story->moveSRTips = "修改{$lang->urCommon}的所屬產品會將其下的{$lang->srCommon}也移動到所選產品下。";

global $config;
if(!empty($config->URAndSR))
{
    $lang->story->ur                = zget($lang, 'urCommon', "用戶{$lang->storyCommon}");
    $lang->story->sr                = zget($lang, 'srCommon', "研發{$lang->storyCommon}");
    $lang->story->createStory       = '添加' . $lang->story->sr;
    $lang->story->createRequirement = '添加' . $lang->story->ur;
    $lang->story->affectedStories   = "影響的{$lang->story->sr}";

    $lang->story->typeList['requirement'] = $lang->story->ur;
    $lang->story->typeList['story']       = $lang->story->sr;
}
