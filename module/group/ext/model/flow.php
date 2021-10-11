<?php
/**
 * __construct 
 * 
 * @access public
 * @return void
 */
public function __construct($appName = '')
{
    parent::__construct($appName);

    $this->loadExtension('flow')->loadCustomLang();
}

public function updateAccounts($groupID)
{
    $this->loadExtension('flow')->updateAccounts($groupID);
}
