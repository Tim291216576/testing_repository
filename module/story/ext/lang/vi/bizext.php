<?php
$lang->story->typeList['story'] = $lang->storyCommon;

$lang->story->moveSRTips = "Its {$lang->srCommon} will be moved to the selected product when editing the linked product of {$lang->urCommon}.";;

global $config;
if(!empty($config->URAndSR))
{
    $lang->story->ur                = zget($lang, 'urCommon', "Yêu cầu");
    $lang->story->sr                = zget($lang, 'srCommon', "Câu chuyện");
    $lang->story->createStory       = 'Tạo ' . $lang->story->sr;
    $lang->story->createRequirement = 'Tạo ' . $lang->story->ur;
    $lang->story->affectedStories   = $lang->story->sr;

    $lang->story->typeList['requirement'] = $lang->story->ur;
    $lang->story->typeList['story']       = $lang->story->sr;
}
