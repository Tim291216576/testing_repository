<?php
if(isset($this->config->bizVersion) and empty($_POST['feedback']) and $this->checkUserLimit())
{
    dao::$errors['userLimit'][] = $this->lang->user->noticeUserLimit;
    return false;
}
