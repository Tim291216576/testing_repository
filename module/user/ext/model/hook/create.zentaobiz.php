<?php
if($this->post->feedback and $this->checkBizUserLimit('feedback'))
{
    dao::$errors['userLimit'][] = $this->lang->user->noticeFeedbackUserLimit;
    return false;
}
