<?php
public function getUsers($deptID, $pager = null, $orderBy = 'id')
{
    return $this->loadExtension('zentaobiz')->getUsers($deptID, $pager, $orderBy);
}

public function getDeptUserPairs($deptID = 0)
{
    return $this->loadExtension('zentaobiz')->getDeptUserPairs($deptID);
}

public function getManager($deptID)
{
    return $this->loadExtension('zentaobiz')->getManager($deptID);
}
