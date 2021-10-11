<?php
/**
 * Append data from flow.
 * 
 * @param  array  $fields 
 * @param  array  $objects 
 * @param  string $module 
 * @access public
 * @return array
 */
public function appendDataFromFlow($fields, $objects, $module = '')
{
    return $this->loadExtension('flow')->appendDataFromFlow($fields, $objects, $module);
}

/**
 * Process sub status of a record.
 *
 * @param  string $module
 * @param  object $record
 * @access public
 * @return string
 */
public function processSubStatus($module, $record)
{
    return $this->loadExtension('flow')->processSubStatus($module, $record);
}

public function setFlowListValue($module)
{
    return $this->loadExtension('flow')->setFlowListValue($module);
}
