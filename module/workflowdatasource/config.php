<?php
$config->workflowdatasource->require = new stdclass();
$config->workflowdatasource->require->create = 'name, datasource';
$config->workflowdatasource->require->edit   = 'name, datasource';

$config->workflowdatasource->modules['crm']   = array('order', 'contract', 'customer', 'contact', 'product', 'invoice', 'feedback', 'address');
$config->workflowdatasource->modules['oa']    = array('holiday', 'leave', 'overtime', 'trip');
$config->workflowdatasource->modules['proj']  = array('project', 'task');
$config->workflowdatasource->modules['doc']   = array('doc');
$config->workflowdatasource->modules['cash']  = array('balance', 'depositor', 'trade');
$config->workflowdatasource->modules['hr']    = array('commission');
$config->workflowdatasource->modules['psi']   = array('batch', 'order');
$config->workflowdatasource->modules['flow']  = array('workflow');
$config->workflowdatasource->modules['ameba'] = array('ameba', 'amebareport', 'budget', 'deal', 'fee', 'rule');
$config->workflowdatasource->modules['sys']   = array('company', 'entry', 'group', 'schema', 'tree', 'user', 'usercontact');

$config->workflowdatasource->methods['crm']['order']    = array('getPairs');
$config->workflowdatasource->methods['crm']['contract'] = array('getPairs');
$config->workflowdatasource->methods['crm']['customer'] = array('getPairs');
$config->workflowdatasource->methods['crm']['contact']  = array('getPairs', 'getCustomerPairs');
$config->workflowdatasource->methods['crm']['product']  = array('getPairs', 'getPropertyList');
$config->workflowdatasource->methods['crm']['invoice']  = array('getTrades', 'getMonthMoney');
$config->workflowdatasource->methods['crm']['feedback'] = array('getCustomerPairs');
$config->workflowdatasource->methods['crm']['address']  = array('getPairsByObject');

$config->workflowdatasource->methods['oa']['holiday']  = array('getYearPairs');
$config->workflowdatasource->methods['oa']['leave']    = array('getPairs');
$config->workflowdatasource->methods['oa']['overtime'] = array('getPairs');
$config->workflowdatasource->methods['oa']['trip']     = array('getPairs');

$config->workflowdatasource->methods['proj']['project'] = array('getMemberPairs', 'getPairs', 'getProjectsToImport');
$config->workflowdatasource->methods['proj']['task']    = array('getMemberPairs', 'getUserTaskPairs');

$config->workflowdatasource->methods['doc']['doc'] = array('getLibPairs', 'getAllLibsByType', 'getLimitLibs', 'getProjectModulePairs');

$config->workflowdatasource->methods['cash']['balance']   = array('getDateOptions', 'getDatePairs');
$config->workflowdatasource->methods['cash']['depositor'] = array('getPairs');
$config->workflowdatasource->methods['cash']['trade']     = array('getDatePairs', 'getSystemCategoryPairs', 'getIncomeCategories', 'getExpenseCategories', 'getSearchTraders', 'getSearchCategories');

$config->workflowdatasource->methods['hr']['commission'] = array('getCommissionedUsers');

$config->workflowdatasource->methods['psi']['batch']   = array('getPairs', 'getUninvoicedBatchList', 'getSentProductsByOrderID');
$config->workflowdatasource->methods['psi']['order']   = array('getPairs');
$config->workflowdatasource->methods['crm']['product'] = array('getPairs', 'getPropertyList');

$config->workflowdatasource->methods['flow']['workflow']           = array('getApps', 'getAppMenus', 'getBuildinModules', 'getPairs', 'getVersionPairs');
$config->workflowdatasource->methods['flow']['workflowaction']     = array('getPairs', 'getUsers2Notice'); 
$config->workflowdatasource->methods['flow']['workflowdatasource'] = array('getAppModules', 'getModuleMethods', 'getDefaultParams', 'getPairs'); 
$config->workflowdatasource->methods['flow']['workflowfield']      = array('getPairs', 'getFieldPairs', 'getCustomFields', 'getExportFields', 'getValueFields'); 
$config->workflowdatasource->methods['flow']['workflowlayout']     = array('getFields'); 
$config->workflowdatasource->methods['flow']['workflowhook']       = array('getTableFields'); 
$config->workflowdatasource->methods['flow']['workflowrule']       = array('getPairs'); 

$config->workflowdatasource->methods['ameba']['ameba']       = array('getLaborCategories', 'getIncomeCategories');
$config->workflowdatasource->methods['ameba']['amebareport'] = array('getWorkingDates');
$config->workflowdatasource->methods['ameba']['budget']      = array('getYearList', 'getWeekList', 'getCategoryList');
$config->workflowdatasource->methods['ameba']['deal']        = array('getTradePairs', 'getCategoryPairs', 'getDeptPairs');
$config->workflowdatasource->methods['ameba']['fee']         = array('getYearList', 'getCategoryPairs', 'getDeptPairs', 'getDeptUserCount');
$config->workflowdatasource->methods['ameba']['rule']        = array('getPairs', 'getYearList', 'getCategoryList', 'getDeptList', 'getProductPairs');

$config->workflowdatasource->methods['sys']['company']     = array('getPairs');
$config->workflowdatasource->methods['sys']['entry']       = array('getPairs');
$config->workflowdatasource->methods['sys']['flow']        = array('getDataPairs');
$config->workflowdatasource->methods['sys']['group']       = array('getPairs', 'getUserPairs');
$config->workflowdatasource->methods['sys']['schema']      = array('getPairs');
$config->workflowdatasource->methods['sys']['tree']        = array('getPairs', 'getFamily', 'getAllChildID', 'getOptionMenu', 'getOptionMenuByMajor');
$config->workflowdatasource->methods['sys']['user']        = array('getPairs', 'getRealNamePairs', 'getUserRoles', 'getRoleList', 'getUserManagerPairs');
$config->workflowdatasource->methods['sys']['usercontact'] = array('getPairs');

$config->workflowdatasource->langList['productStatus']   = array('app' => 'sys', 'module' => 'product',  'field' => 'statusList');
$config->workflowdatasource->langList['customerType']    = array('app' => 'sys', 'module' => 'customer', 'field' => 'typeList');
$config->workflowdatasource->langList['customerSize']    = array('app' => 'sys', 'module' => 'customer', 'field' => 'sizeNameList');
$config->workflowdatasource->langList['customerLevel']   = array('app' => 'sys', 'module' => 'customer', 'field' => 'levelNameList');
$config->workflowdatasource->langList['customerStatus']  = array('app' => 'sys', 'module' => 'customer', 'field' => 'statusList');
$config->workflowdatasource->langList['role']            = array('app' => 'sys', 'module' => 'user',     'field' => 'roleList');
