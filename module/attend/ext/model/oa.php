<?php
public function computeStatus($attend)
{
    return $this->loadExtension('oa')->computeStatus($attend);
}

public function isClickable($attend, $action)
{
    $action    = strtolower($action);
    $clickable = commonModel::hasPriv('attend', $action);
    if(!$clickable) return false;

    $account = $this->app->user->account;

    switch($action)
    {
    case 'review' :
        $reviewedBy = $this->getReviewedBy($attend->account);
        $canReview  = $attend->reviewStatus == 'wait' && $reviewedBy == $account;

        return $canReview;
    }

    return true;
}
