<?php
$config->installed       = true;
$config->debug           = true;
$config->requestType     = 'PATH_INFO';
$config->timezone        = 'Asia/Shanghai';
$config->db->host        = '127.0.0.1';
$config->db->port        = '3306';
$config->db->name        = 'zentao';
$config->db->user        = 'root';
$config->db->encoding    = 'UTF8';
$config->db->password    = '';
$config->db->prefix      = 'zt_';
$config->webRoot         = getWebRoot();
$config->default->lang   = 'zh-cn';