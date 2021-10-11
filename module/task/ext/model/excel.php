<?php
public function setListValue($projectID)
{
    return $this->loadExtension('excel')->setListValue($projectID);
}

public function createFromImport($projectID)
{
    return $this->loadExtension('excel')->createFromImport($projectID);
}
