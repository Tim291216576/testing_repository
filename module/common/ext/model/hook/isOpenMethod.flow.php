<?php
if($this->loadModel('user')->isLogon() or ($this->app->company->guest and $this->app->user->account == 'guest'))
{
    if($module == 'flow' and $method == 'browse')         return true;
    if($module == 'flow' and $method == 'create')         return true;
    if($module == 'flow' and $method == 'batchcreate')    return true;
    if($module == 'flow' and $method == 'edit')           return true;
    if($module == 'flow' and $method == 'operate')        return true;
    if($module == 'flow' and $method == 'batchoperate')   return true;
    if($module == 'flow' and $method == 'view')           return true;
    if($module == 'flow' and $method == 'delete')         return true;
    if($module == 'flow' and $method == 'link')           return true;
    if($module == 'flow' and $method == 'unlink')         return true;
    if($module == 'flow' and $method == 'export')         return true;
    if($module == 'flow' and $method == 'exporttemplate') return true;
    if($module == 'flow' and $method == 'import')         return true;
    if($module == 'flow' and $method == 'showimport')     return true;

    if($module == 'workflowfield' and $method == 'checkfieldlength') return true;
    if($module == 'workflowfield' and $method == 'addSqlVar')        return true;
    if($module == 'workflowfield' and $method == 'delSqlVar')        return true;
    if($module == 'workflowfield' and $method == 'buildVarControl')  return true;
}
