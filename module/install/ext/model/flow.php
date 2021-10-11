<?php
public function grantPriv()
{
    parent::grantPriv();
    $this->loadModel('upgrade')->importBuildinModules();
    $this->loadModel('upgrade')->addSubStatus();
}
