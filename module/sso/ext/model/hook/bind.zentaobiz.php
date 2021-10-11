<?php
if($this->post->bindType == 'add' and $this->loadModel('user')->checkBizUserLimit())
{
    dao::$errors['password1'][] = $this->lang->user->noticeUserLimit;
    return false;
}
