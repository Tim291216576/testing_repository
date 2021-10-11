<?php
$lang->story->typeList['story'] = $lang->storyCommon;

$lang->story->moveSRTips = "Its {$lang->srCommon} will be moved to the selected product when editing the linked product of {$lang->urCommon}.";;

global $config;
if(!empty($config->URAndSR))
{
    $lang->story->ur                = zget($lang, 'urCommon', "Requirements");
    $lang->story->sr                = zget($lang, 'srCommon', "Stories");
    $lang->story->createStory       = 'Create ' . $lang->story->sr;
    $lang->story->createRequirement = 'Create ' . $lang->story->ur;
    $lang->story->affectedStories   = "Affected {$lang->story->sr}";

    $lang->story->typeList['requirement'] = $lang->story->ur;
    $lang->story->typeList['story']       = $lang->story->sr;
}
