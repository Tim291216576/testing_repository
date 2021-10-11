<?php
$lang->story->typeList['story'] = $lang->storyCommon;

$lang->story->moveSRTips = "修改{$lang->urCommon}的所属产品会将其下的{$lang->srCommon}也移动到所选产品下。";

global $config;
if(!empty($config->URAndSR))
{
    $lang->story->ur                = zget($lang, 'urCommon', "用户{$lang->storyCommon}");
    $lang->story->sr                = zget($lang, 'srCommon', "研发{$lang->storyCommon}");
    $lang->story->createStory       = '添加' . $lang->story->sr;
    $lang->story->createRequirement = '添加' . $lang->story->ur;
    $lang->story->affectedStories   = "影响的{$lang->story->sr}";

    $lang->story->typeList['requirement'] = $lang->story->ur;
    $lang->story->typeList['story']       = $lang->story->sr;
}
