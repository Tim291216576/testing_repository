<?php
/**
 * Get menu of a flow.
 *
 * @param  object $flow
 * @param  array  $labels
 * @access public
 * @return void
 */
public function getModuleMenu($flow, $labels)
{
    return $this->loadExtension('flow')->getModuleMenu($flow, $labels);
}

/**
 * Post data of a flow.
 *
 * @param  object $flow
 * @param  object $action
 * @param  int    $dataID
 * @param  string $prevModule
 * @access public
 * @return array
 */
public function post($flow, $action, $dataID = 0, $prevModule = '')
{
    return $this->loadExtension('flow')->post($flow, $action, $dataID, $prevModule);
}

/**
 * Print workflow defined fields for view and form page.
 *
 * @access public
 * @param  string $moduleName 
 * @param  string $methodName
 * @param  object $object
 * @param  string $type
 * @param  string $extras
 * @return void
 */
public function printFields($moduleName, $methodName, $object, $type, $extras)
{
    return $this->loadExtension('flow')->printFields($moduleName, $methodName, $object, $type, $extras);
}

/**
 * Get field value.
 * 
 * @param  string $field 
 * @param  object $object 
 * @access public
 * @return string
 */
public function getFieldValue($field, $object)
{
    return $this->loadExtension('flow')->getFieldValue($field, $object);
}

/**
 * Print workflow defined fields for browse page.
 *
 * @access public
 * @param  string $module
 * @param  object $object
 * @param  string $id
 * @return void
 */
public function printFlowCell($module, $object, $id)
{
    return $this->loadExtension('flow')->printFlowCell($module, $object, $id);
}

/**
 * Import from excel.
 * 
 * @param  object $flow 
 * @access public
 * @return array
 */
public function import($flow)
{
    return $this->loadExtension('flow')->import($flow);
}

/**
 * Get extend fields.
 * 
 * @param  string $module 
 * @param  string $method 
 * @access public
 * @return array
 */
public function getExtendFields($module, $method)
{
    return $this->loadExtension('flow')->getExtendFields($module, $method);
}

/**
 * getFieldControl 
 * 
 * @param  object $field 
 * @param  object $object 
 * @param  string $controlName 
 * @access public
 * @return string
 */
public function getFieldControl($field, $object, $controlName = '')
{
    return $this->loadExtension('flow')->getFieldControl($field, $object, $controlName);
}

/**
 * Check rule.
 * 
 * @param  object $field 
 * @param  string $value 
 * @access public
 * @return bool|string
 */
public function checkRule($field, $value)
{
    return $this->loadExtension('flow')->checkRule($field, $value);
}

public function buildControl($field, $fieldValue, $element = '', $childModule = '', $emptyValue = false, $preview = false)
{
    return $this->loadExtension('flow')->buildControl($field, $fieldValue, $element, $childModule, $emptyValue, $preview);
}

public function checkLabel($flow, $labels, $label)
{
    if($flow->buildin) return true;
    return parent::checkLabel($flow, $labels, $label);
}

public function getDataByID($flow, $dataID, $decode = true)
{
    return $this->loadExtension('flow')->getDataByID($flow, $dataID, $decode);
}

