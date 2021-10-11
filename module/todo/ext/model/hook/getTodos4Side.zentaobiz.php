<?php
if($account == '') $account = $this->app->user->account;

$todos             = array();
$todos['bug']      = $this->loadModel('bug')->getUserBugPairs($account);
$todos['task']     = $this->loadModel('task')->getUserTaskPairs($account, 'wait,doing');
$todos['story']    = $this->loadModel('story')->getUserStoryPairs($account);
$todos['feedback'] = $this->loadModel('feedback')->getUserFeedbackPairs($account); 

$userTodos = $this->dao->select('idvalue,type')->from(TABLE_TODO)
    ->where('account')->eq($account)
    ->andWhere('type')->in("bug,task,story,feedback")
    ->fetchGroup('type', 'idvalue');

foreach($todos as $type => $todo)
{
    if(!empty($todo) && !empty($userTodos[$type]))
    {
        $intersect = array_intersect(array_keys($todo), array_keys($userTodos[$type]));
        if(!empty($intersect)) foreach($intersect as $id) unset($todos[$type][$id]);
    }
}

return $todos;
