<?php

header("Content-Type:text/xml");
$ignoreAuth = true;
require 'classes.php';

$xml_array = array();

$token = $_POST['token'];

$title = $_POST['title'];
$language = $_POST['language']; //d
$firstname = $_POST['firstname']; // d
$lastname = $_POST['lastname']; //d
$middlename = $_POST['middlename']; //d
$dob = $_POST['dob']; //d
$street = $_POST['street']; // streetAddressLine1, streetAddressLine2
$postal_code = $_POST['postal_code']; // ZipCode d
$city = $_POST['city']; //d
$state = $_POST['state']; //d
$country_code = $_POST['country_code'];
$ss = $_POST['ss']; // if suffix d
$occupation = $_POST['occupation'];

$phone_home = $_POST['phone_home']; //d
$phone_biz = $_POST['phone_biz']; //d
$phone_contact = $_POST['phone_contact']; // d
$phone_cell = $_POST['phone_cell']; //d

$status = $_POST['status'];
$drivers_lincense = $_POST['drivers_license'];

$contact_relationship = $_POST['contact_relationship']; //d
$mothersname = $_POST['mothersname'];
$guardiansname = $_POST['guardiansname'];

$sex = $_POST['sex']; //d
$email = $_POST['email']; //d
$race = $_POST['race']; //d
$ethnicity = $_POST['ethnicity']; //d
$usertext1 = $_POST['notes']; // note d
$nickname = $_POST['nickname'];

$p_insurance_company = $_POST['p_provider'];
$p_subscriber_employer_status = $_POST['p_subscriber_employer'];
$p_group_number = $_POST['p_group_number'];
$p_plan_name = $_POST['p_plan_name'];
$p_subscriber_relationship = $_POST['p_subscriber_relationship'];
$p_insurance_id = $_POST['p_insurance_id'];


$s_insurance_company = $_POST['s_provider'];
$s_subscriber_employer_status = $_POST['s_subscriber_employer'];
$s_group_number = $_POST['s_group_number'];
$s_plan_name = $_POST['s_plan_name'];
$s_subscriber_relationship = $_POST['s_subscriber_relationship'];
$s_insurance_id = $_POST['s_insurance_id'];

$o_insurance_company = $_POST['o_provider'];
$o_subscriber_employer_status = $_POST['o_subscriber_employer'];
$o_group_number = $_POST['o_group_number'];
$o_plan_name = $_POST['o_plan_name'];
$o_subscriber_relationship = $_POST['o_subscriber_relationship'];
$o_insurance_id = $_POST['o_insurance_id'];

$image_data = isset($_POST['image_data']) ? $_POST['image_data'] : '';


//$token = 'fe15082d987f3fd5960a712c54494a68';
//$token = '8c8ac0c8581785e6f3faf24485a784fa';
////
//$title = 'Patient Title';
//$language = 'patient language'; //d
//$firstname = 'Qasim'; // d
//$lastname = 'Malik'; //d
//$middlename = 'Ahmad'; //d
//$dob = '2012-12-10'; //d
//$street = '15 street North Islamabad'; // streetAddressLine1, streetAddressLine2
//$postal_code = '123444'; // ZipCode d
//$city = 'city'; //d
//$state = 'state'; //d
//$country_code = '0';
//$ss = '1234568754'; // if suffix d
//$occupation = 'Sc';
//$phone_home = '1234564574'; //d
//$phone_biz = '1234564741'; //d
//$phone_contact = '3335556625'; // d
//$phone_cell = '1234561235'; //d
//$status = '1';
//$drivers_lincense = '74518';
//$contact_relationship = 'brother'; //d
//$sex = 'male'; //d
//$email = 'email@email.com'; //d
//$race = 'race'; //d
//$ethnicity = 'ethnicity'; //d
//$usertext1 = 'Theses are notes'; // note d
//$nickname = 'Kodo';
//$p_insurance_company = $_POST['p_provider'];
//$p_subscriber_employer_status = $_POST['p_subscriber_employer'];
//$p_group_number = $_POST['p_group_number'];
//$p_plan_name = $_POST['p_plan_name'];
//$p_subscriber_relationship = $_POST['p_subscriber_relationship'];
//$p_insurance_id = $_POST['p_insurance_id'];
//$s_insurance_company = $_POST['s_provider'];
//$s_subscriber_employer_status = $_POST['s_subscriber_employer'];
//$s_group_number = $_POST['s_group_number'];
//$s_plan_name = $_POST['s_plan_name'];
//$s_subscriber_relationship = $_POST['s_subscriber_relationship'];
//$s_insurance_id = $_POST['s_insurance_id'];
//
//$o_insurance_company = $_POST['o_provider'];
//$o_subscriber_employer_status = $_POST['o_subscriber_employer'];
//$o_group_number = $_POST['o_group_number'];
//$o_plan_name = $_POST['o_plan_name'];
//$o_subscriber_relationship = $_POST['o_subscriber_relationship'];
//$o_insurance_id = $_POST['o_insurance_id'];
//$image_data = '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';


if ($userId = validateToken($token)) {

    $user_data = getUserData($userId);

    $user = $user_data['user'];
    $emr = $user_data['emr'];
    $username = $user_data['username'];
    $password = $user_data['password'];

//    echo $user ." / ".$emr." / ".$username." / ".$password;
//    exit;

    switch ($emr) {
        case 'openemr':

            $provider_id = getUserProviderId($userId);
            $patientId = 1;
            $pid = 1;
            sqlStatement("lock tables patient_data read");
            $result = sqlQuery("select max(pid)+1 as pid from patient_data");
            sqlStatement("unlock tables");

            if ($result['pid'] > 1) {
                $patientId = $result['pid'];
                $pid = $result['pid'];
            }

            $postData = array(
//        'id' => $pid,
                'title' => $title,
                'fname' => $firstname,
                'lname' => $lastname,
                'mname' => $middlename,
                'sex' => $sex,
                'status' => $status,
                'drivers_license' => $drivers_lincense,
                'contact_relationship' => $contact_relationship,
                'phone_biz' => $phone_biz,
                'phone_cell' => $phone_cell,
                'phone_contact' => $phone_contact,
                'phone_home' => $phone_home,
                'DOB' => $dob,
                'language' => $language,
                'financial' => $financial,
                'street' => $street,
                'postal_code' => $postal_code,
                'city' => $city,
                'state' => $state,
                'country_code' => $country_code,
                'ss' => $ss,
                'occupation' => $occupation,
                'email' => $email,
                'race' => $race,
                'ethnicity' => $ethnicity,
                'pubpid' => $pid,
                'usertext1' => $usertext1,
                'genericname1' => $nickname,
                'mothersname' => $mothersname,
                'guardiansname' => $guardiansname,
                'providerID' => $provider_id,
                'ref_providerID' => 0,
                'financial_review' => '0000-00-00 00:00:00',
                'hipaa_allowsms' => '',
                'hipaa_allowemail' => '',
                'deceased_date' => '0000-00-00 00:0'
            );


            $p_id = updatePatientData($patientId, $postData, $create = true);

            if ($p_id) {

                $primary_insurace_data = getInsuranceData($p_id);

                $secondary_insurace_data = getInsuranceData($p_id, 'secondary');

                $other_insurace_data = getInsuranceData($p_id, 'tertiary');

                $p_insurace_data = array(
                    'provider' => $p_insurance_company,
                    'group_number' => $p_group_number,
                    'plan_name' => $p_plan_name,
                    'subscriber_employer' => $p_subscriber_employer_status,
                    'subscriber_relationship' => $p_subscriber_relationship,
                    'policy_number' => $p_insurance_id
                );

                if ($primary_insurace_data) {
                    updateInsuranceData($primary_insurace_data['id'], $p_insurace_data);
                } else {
                    newInsuranceData(
                            $patientId, $type = "primary", $p_insurance_company, $policy_number = $p_insurance_id, $group_number = $p_group_number, $plan_name = $p_plan_name, $subscriber_lname = "", $subscriber_mname = "", $subscriber_fname = "", $subscriber_relationship =
                            $p_subscriber_relationship, $subscriber_ss = "", $subscriber_DOB = "", $subscriber_street = "", $subscriber_postal_code = "", $subscriber_city = "", $subscriber_state = "", $subscriber_country = "", $subscriber_phone = "", $subscriber_employer =
                            $p_subscriber_employer_status, $subscriber_employer_street = "", $subscriber_employer_city = "", $subscriber_employer_postal_code = "", $subscriber_employer_state = "", $subscriber_employer_country = "", $copay = "", $subscriber_sex = "", $effective_date = "0000-00-00", $accept_assignment = "TRUE"
                    );
                }

                $s_insurace_data = array(
                    'provider' => $s_insurance_company,
                    'group_number' => $s_group_number,
                    'plan_name' => $s_plan_name,
                    'subscriber_employer' => $s_subscriber_employer_status,
                    'subscriber_relationship' => $s_subscriber_relationship,
                    'policy_number' => $s_insurance_id
                );

                if ($secondary_insurace_data) {
                    updateInsuranceData($secondary_insurace_data['id'], $s_insurace_data);
                } else {
                    newInsuranceData(
                            $p_id, $type = "secondary", $s_insurance_company, $policy_number = $s_insurance_id, $group_number = $s_group_number, $plan_name = $s_plan_name, $subscriber_lname = "", $subscriber_mname = "", $subscriber_fname = "", $subscriber_relationship = $s_subscriber_relationship, $subscriber_ss = "", $subscriber_DOB = "", $subscriber_street = "", $subscriber_postal_code = "", $subscriber_city = "", $subscriber_state = "", $subscriber_country = "", $subscriber_phone = "", $subscriber_employer = $s_subscriber_employer_status, $subscriber_employer_street = "", $subscriber_employer_city = "", $subscriber_employer_postal_code = "", $subscriber_employer_state = "", $subscriber_employer_country = "", $copay = "", $subscriber_sex = "", $effective_date = "0000-00-00", $accept_assignment = "TRUE");
                }

                $o_insurace_data = array(
                    'provider' => $o_insurance_company,
                    'group_number' => $o_group_number,
                    'plan_name' => $o_plan_name,
                    'subscriber_employer' => $o_subscriber_employer_status,
                    'subscriber_relationship' => $o_subscriber_relationship,
                    'policy_number' => $o_insurance_id
                );

                if ($other_insurace_data) {
                    updateInsuranceData($other_insurace_data['id'], $o_insurace_data);
                } else {
                    newInsuranceData(
                            $patientId, $type = "tertiary", $o_insurance_company, $policy_number = $o_insurance_id, $group_number = $o_group_number, $plan_name = $o_plan_name, $subscriber_lname = "", $subscriber_mname = "", $subscriber_fname = "", $subscriber_relationship = $o_subscriber_relationship, $subscriber_ss = "", $subscriber_DOB = "", $subscriber_street = "", $subscriber_postal_code = "", $subscriber_city = "", $subscriber_state = "", $subscriber_country = "", $subscriber_phone = "", $subscriber_employer = $o_subscriber_employer_status, $subscriber_employer_street = "", $subscriber_employer_city = "", $subscriber_employer_postal_code = "", $subscriber_employer_state = "", $subscriber_employer_country = "", $copay = "", $subscriber_sex = "", $effective_date = "0000-00-00", $accept_assignment = "TRUE");
                }

                $xml_array['status'] = 0;
                $xml_array['patientId'] = $patientId;
                $xml_array['reason'] = 'The Patient has been added';
            } else {
                $xml_array['status'] = -1;
                $xml_array['reason'] = 'ERROR: Sorry, there was an error processing your data. Please re-submit the information again.';
            }

            if ($image_data) {
                $id = 1;
                $type = "file_url";
                $size = '';
                $date = date('Y-m-d H:i:s');
                $url = '';
                $mimetype = 'image/jpeg';
                $hash = '';
                $patient_id = $patientId;
                $ext = 'png';
                $cat_title = 'Patient Profile Image';

                $strQuery2 = "SELECT id from `categories` WHERE name LIKE '{$cat_title}'";
                $result3 = $db->get_row($strQuery2);

                if ($result3) {
                    $cat_id = $result3->id;
                } else {
                    sqlStatement("lock tables categories read");

                    $result4 = sqlQuery("select max(id)+1 as id from categories");

                    $cat_id = $result4['id'];

                    sqlStatement("unlock tables");

                    $cat_insert_query = "INSERT INTO `categories`(`id`, `name`, `value`, `parent`, `lft`, `rght`) 
                VALUES ({$cat_id},'{$cat_title}','',1,0,0)";

                    sqlQuery($cat_insert_query);
                }


//                $image_path = $_SERVER['DOCUMENT_ROOT'] . "/openemr/sites/default/documents/{$patient_id}";
                $image_path = $sitesDir . "{$site}/documents/{$patient_id}";


                if (!file_exists($image_path)) {
                    mkdir($image_path);
                }

                $image_date = date('Y-m-d_H-i-s');

                file_put_contents($image_path . "/" . $image_date . "." . $ext, base64_decode($image_data));


                sqlStatement("lock tables documents read");

                $result = sqlQuery("select max(id)+1 as did from documents");

                sqlStatement("unlock tables");

                if ($result['did'] > 1) {
                    $id = $result['did'];
                }

                $hash = sha1_file($image_path . "/" . $image_date . "." . $ext);

                $url = "file://" . $image_path . "/" . $image_date . "." . $ext;

                $size = filesize($url);

                $strQuery = "INSERT INTO `documents`( `id`, `type`, `size`, `date`, `url`, `mimetype`, `foreign_id`, `docdate`, `hash`, `list_id`) 
             VALUES ({$id},'{$type}','{$size}','{$date}','{$url}','{$mimetype}',{$patient_id},'{$docdate}','{$hash}','{$list_id}')";

                $result = $db->query($strQuery);

                $strQuery1 = "INSERT INTO `categories_to_documents`(`category_id`, `document_id`) VALUES ({$cat_id},{$id})";

                $result1 = $db->query($strQuery1);
            }
            break;
        case 'greenway';
            include 'greenway/patientAddNew.php';
            break;
    }
} else {
    $xml_array['status'] = -2;
    $xml_array['reason'] = 'Invalid Token';
}

$xml = ArrayToXML::toXml($xml_array, 'Patient');
echo $xml;
?>