<?php

header("Content-Type:text/xml");
$ignoreAuth = true;
//ini_set('display_errors', '1');
require 'classes.php';

$xml_string = "";
$xml_string = "<Message>";

$token = $_POST['token'];
$patientId = $_POST['patientId'];
$authorized = $_POST['authorized'] ? $_POST['authorized'] : 1;
$activity = $_POST['activity'] ? $_POST['activity'] : 1;
$title = $_POST['title'];
$newtext = $_POST['newtext'];
$assigned_to = $_POST['assigned_to'];
$message_status = $_POST['message_status'];

$message_id = isset($_POST['message_id']) && !empty($_POST['message_id']) ? $_POST['message_id'] : '';

//$token = '76819b1907da2b252844bce9565cbd00';
//$patientId = 42;
//$title = 'My Post Title';
//$newtext = 'This is new message send from Haroon';
//$assigned_to = 'admin';
//$message_status = 'New';


if ($userId = validateToken($token)) {
    $user = getUsername($userId);
    $provider_id = getUserProviderId($userId);
//	$strQuery = "INSERT INTO form_soap 
//            (pid, user, date, groupname, authorized, activity, subjective, objective, assessment,  plan) 
//            VALUES (" . $patientId . ", '" . $user . "', '" . date('Y-m-d H:i:s') . "','" . $groupname . "', '" . $authorized . "','" . $activity . "',  '" . $subjective . "' , '" . $objective . "' , '" . $assessment . "', '" . $plan . "')";
//    $result = $db->query($strQuery);
//	$last_inserted_id = mysql_insert_id();

    $assigned_to_array = explode(',', $assigned_to);
    $_SESSION['authUser'] = $user;
    $_SESSION['authProvider'] = 'Default';

    foreach ($assigned_to_array as $assignee) {
        if ($message_status == 'Done' && !empty($message_id)) {
            updatePnoteMessageStatus($message_id, $message_status);
            $result = 1;
            break;
        } else {
            $result = addPnote($patientId, $newtext, $authorized, $activity, $title, $assignee, $datetime = '', $message_status);
            $device_token_badge = getDeviceTokenBadge($assignee,'message');
//            var_dump($device_token_badge);exit;
            $badge = $device_token_badge ['badge'];
            $deviceToken = $device_token_badge ['device_token'];
//            echo $device_token;
            if ($deviceToken) {
                $notification_res = notification($deviceToken, $badge, $msg_count = 0, $apt_count = 0, $message = 'New Message Notification!');
//                $notification_res = sendAllNotifications($device_token, $assignee, $provider_id, 'Appointment/Message Notification');
            }
        }
    }
    if ($result) {
        $xml_string .= "<status>0</status>";
        $xml_string .= "<reason>Message send successfully</reason>";
        if ($notification_res) {
            $xml_string .= "<notification>Notification({$notification_res}) Sent.</notification>";
        } else {
            $xml_string .= "<notification>Notification Failed.</notification>";
        }
    } else {
        $xml_string .= "<status>-1</status>";
        $xml_string .= "<reason>Could not send message</reason>";
    }
} else {
    $xml_string .= "<status>-2</status>";
    $xml_string .= "<reason>Invalid Token</reason>";
}

$xml_string .= "</Message>";
echo $xml_string;
?>