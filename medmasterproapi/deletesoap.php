<?php 
	header ("Content-Type:text/xml"); 
	$ignoreAuth = true;
	require 'classes.php';
	
	$xml_string = "";
	$xml_string = "<soap>";
	
	$token = $_POST['token'];
	$soap_id = $_POST['id'];

	if ($userId = validateToken($token)) {
    	$user = getUsername($userId);
		$strQuery = "DELETE FROM form_soap WHERE id =".$soap_id;
	 	$result = $db->query($strQuery);

		if ($result) {
			newEvent($event = 'soap-record-delete', $user, $groupname = 'Default', $success = '1', $comments = $strQuery);	
			$xml_string .= "<status>0</status>";
			$xml_string .= "<reason>Soap Deleted successfully</reason>";
		} else {
			$xml_string .= "<status>-1</status>";	
			$xml_string .= "<reason>Could not delete soap</reason>";
		}
	} else {
    	$xml_string .= "<status>-2</status>";	
		$xml_string .= "<reason>Invalid Token</reason>";
	}
	
	$xml_string .= "</soap>";	
	echo $xml_string;
?>