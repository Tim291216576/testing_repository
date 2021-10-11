<?php
/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function computeTaskEffort()
{
    return $this->loadExtension('effort')->computeTaskEffort();
}

public function getTaskEffort($project = '')
{
    return $this->loadExtension('effort')->getTaskEffort($project);
}

public function judgeWeekend($date = '', $type = '')
{
    return $this->loadExtension('effort')->judgeWeekend($date, $type);
}
