<?php
if(!isset($lang->attend)) $lang->attend = new stdclass();
$lang->attend->common       = 'Attendance';
$lang->attend->personal     = 'My Attendance';
$lang->attend->department   = 'Department';
$lang->attend->company      = 'Company';
$lang->attend->detail       = 'Details';
$lang->attend->edit         = 'Edit';
$lang->attend->edited       = 'Clock In';
$lang->attend->leave        = 'Leave';
$lang->attend->leaved       = 'Leave asked';
$lang->attend->makeup       = 'Makeup times';
$lang->attend->makeuped     = 'Made up';
$lang->attend->lieu         = 'Lieu';
$lang->attend->lieud        = 'Lieu taken';
$lang->attend->trip         = 'Trip';
$lang->attend->triped       = 'Trip taken';
$lang->attend->egress       = 'Egress';
$lang->attend->egressed     = 'Egress taken';
$lang->attend->overtime     = 'Overtime';
$lang->attend->overtimed    = 'Overtime taken';
$lang->attend->review       = 'Review Attendance';
$lang->attend->settings     = 'Settings';
$lang->attend->export       = 'Export';
$lang->attend->stat         = 'Report';
$lang->attend->saveStat     = 'Save';
$lang->attend->exportStat   = 'Export Report';
$lang->attend->exportDetail = 'Export Details';
$lang->attend->browseReview = 'Review List';
$lang->attend->batchReview  = 'Batch Review';
$lang->attend->batchPass    = 'Batch Pass';

$lang->attend->id            = 'ID';
$lang->attend->date          = 'Date';
$lang->attend->account       = 'User';
$lang->attend->signIn        = 'Clock-In';
$lang->attend->signOut       = 'Clock-Out';
$lang->attend->status        = 'Status';
$lang->attend->ip            = 'IP';
$lang->attend->device        = 'Device';
$lang->attend->desc          = 'Description';
$lang->attend->dayName       = 'Day';
$lang->attend->report        = 'Report';
$lang->attend->AM            = 'AM';
$lang->attend->PM            = 'PM';
$lang->attend->ipList        = 'IP List';
$lang->attend->noAttendUsers = 'Not required';
$lang->attend->signInClient  = 'Client';
$lang->attend->rejectReason  = 'Reject Reason';

$lang->attend->user          = 'User';
$lang->attend->begin         = 'Begin';
$lang->attend->end           = 'End';
$lang->attend->search        = 'Search';

$lang->attend->manualIn     = 'Clock-In';
$lang->attend->manualOut    = 'Clock-Out';
$lang->attend->reason       = 'Reasons';
$lang->attend->reviewStatus = 'Review';
$lang->attend->reviewedBy   = 'Reviewed By';
$lang->attend->reviewedDate = 'Reviewed';
$lang->attend->deserveDays  = 'Expected Days';
$lang->attend->actualDays   = 'Actual Days';

$lang->attend->clientList['all']     = 'All';
$lang->attend->clientList['desktop'] = 'Desktop';

$lang->attend->statusList['normal']   = 'Normal';
$lang->attend->statusList['late']     = 'Late';
$lang->attend->statusList['early']    = 'Leave early';
$lang->attend->statusList['both']     = 'Late and Leave early';
$lang->attend->statusList['absent']   = 'Absent';
$lang->attend->statusList['leave']    = 'Ask for leave';
$lang->attend->statusList['makeup']   = 'Makeup times';
$lang->attend->statusList['overtime'] = 'Overtime';
$lang->attend->statusList['lieu']     = 'Lieu';
$lang->attend->statusList['trip']     = 'Biz trip';
$lang->attend->statusList['egress']   = 'Biz egress';
$lang->attend->statusList['rest']     = 'Off';

$lang->attend->abbrStatusList['normal']   = '???';
$lang->attend->abbrStatusList['late']     = 'Late';
$lang->attend->abbrStatusList['early']    = 'Early';
$lang->attend->abbrStatusList['both']     = 'L+E';
$lang->attend->abbrStatusList['absent']   = 'Absent';
$lang->attend->abbrStatusList['leave']    = 'Leave';
$lang->attend->abbrStatusList['makeup']   = 'Makeup';
$lang->attend->abbrStatusList['overtime'] = 'OT';
$lang->attend->abbrStatusList['lieu']     = 'Lieu';
$lang->attend->abbrStatusList['trip']     = 'Biz';
$lang->attend->abbrStatusList['egress']   = 'Out';
$lang->attend->abbrStatusList['rest']     = 'Off';

$lang->attend->markStatusList['normal']   = '???';
$lang->attend->markStatusList['late']     = '=';
$lang->attend->markStatusList['early']    = '>';
$lang->attend->markStatusList['both']     = '=>';
$lang->attend->markStatusList['absent']   = 'x';
$lang->attend->markStatusList['leave']    = '!';
$lang->attend->markStatusList['makeup']   = '???';
$lang->attend->markStatusList['overtime'] = '+';
$lang->attend->markStatusList['lieu']     = '???';
$lang->attend->markStatusList['trip']     = '$';
$lang->attend->markStatusList['egress']   = '#';
$lang->attend->markStatusList['rest']     = '~';

$lang->attend->reasonList['normal']   = 'Normal';
$lang->attend->reasonList['leave']    = 'Ask for leave';
$lang->attend->reasonList['makeup']   = 'Makeup times';
$lang->attend->reasonList['overtime'] = 'Overtime';
$lang->attend->reasonList['lieu']     = 'Lieu';
$lang->attend->reasonList['trip']     = 'Biz trip';
$lang->attend->reasonList['egress']   = 'Biz egress';

$lang->attend->reviewStatusList['wait']   = 'Wait';
$lang->attend->reviewStatusList['pass']   = 'Pass';
$lang->attend->reviewStatusList['reject'] = 'Reject';

$lang->attend->inSuccess  = 'Clocked in.';
$lang->attend->inFail     = 'Clock-in failed.';
$lang->attend->outSuccess = 'Clocked out.';
$lang->attend->outFail    = 'Clock-out failed.';

$lang->attend->signInLimit   = 'Clock-in';
$lang->attend->signOutLimit  = 'Clock-out';
$lang->attend->workingDays   = 'Working days';
$lang->attend->workingHours  = 'Working hours';
$lang->attend->mustSignOut   = 'Required';
$lang->attend->denied        = 'Access is denied.';
$lang->attend->nodata        = 'No data is selected.';
$lang->attend->reviewSuccess = 'Reviewed';

$lang->attend->workingDaysList['5']  = "Monday ~ Friday";
$lang->attend->workingDaysList['6']  = "Monday ~ Saturday";
$lang->attend->workingDaysList['7']  = "Monday ~ Sunday";
$lang->attend->workingDaysList['12'] = "Sunday ~ Thursday";
$lang->attend->workingDaysList['13'] = "Sunday ~ Friday";

$lang->attend->mustSignOutList['yes'] = 'Yes';
$lang->attend->mustSignOutList['no']  = 'No';

$lang->attend->weeks = array('1st week', '2nd week', '3rd week', '4th week', '5th week', '6th week');

$lang->attend->notice['today']    = "<p>Your attendance yesterday was %s, <a href='%s' %s> Click here to edit.</a></p>";
$lang->attend->notice['yestoday'] = "<p>Your attendance today is %s, <a href='%s' %s> Click here to edit.</a></p>";
$lang->attend->notice['absent']   = "N/A";

$lang->attend->confirmReview['pass']   = 'Do you want to pass it?';
$lang->attend->confirmReview['reject'] = 'Do you want to reject it?';

$lang->attend->settings         = 'Company Settings';
$lang->attend->personalSettings = 'Personal Settings';
$lang->attend->setManager       = 'Department Manager Settings';
$lang->attend->setDept          = 'Set Department';

$lang->attend->beginDate = new stdClass();
$lang->attend->beginDate->company  = 'Start Date';
$lang->attend->beginDate->personal = 'Start Date';

$lang->attend->note = new stdClass();
$lang->attend->note->ip           = "Use comma to separate IPs, and IP segment is OK, e.g. 192.168.1.*";
$lang->attend->note->allip        = 'All IPs';
$lang->attend->note->IPDenied     = 'IP denied.';
$lang->attend->note->beginDate    = 'Set a date to begin record attendance. The attenance before this date will not be record.';
$lang->attend->note->signInClient = 'Select All to clock in via any way, otherwise users have to clock in via the selected one.';

$lang->attend->h = 'hours';
$lang->attend->m = 'minutes';
$lang->attend->s = 'seconds';

$lang->attend->signInClientError = 'Clockin failed. The settings is to clock-in via %s only.';
$lang->attend->waitReviews       = 'There are <strong>%s</strong> records waiting to be reviewed.';
