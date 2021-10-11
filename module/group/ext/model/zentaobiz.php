<?php
public function getList($programID = 0)
{
    return $this->loadExtension('zentaobiz')->getList($programID);
}

public function create()
{
    return $this->loadExtension('zentaobiz')->create();
}

public function getPairs($programID = 0)
{
    return $this->loadExtension('zentaobiz')->getPairs($programID);
}
