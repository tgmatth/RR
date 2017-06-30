<?php
//start the session
session_start();

//turn on all error reporting. Only for debugging.
error_reporting(E_ALL);

//////////////////////////////////////////////////////
// Begin variables to be written out by RapidWeaver //
//////////////////////////////////////////////////////

//set the return URL
$return_url = "../sponsorship.php";

//set the users email address
$email = "tgmatth@gmail.com";
//$email = "tgmatth@gmail.com";

//array of fields in form. (In the format "field_name" => "field_label")
$form_fields = array(
"element0" => 'Event Name:',
"element1" => 'Event Date:',
"element2" => 'Event Time:',
"element3" => 'What city is this event located?:',
"element4" => 'Event Website:',
"element5" => 'Event Facebook:',
"element6" => 'Please list any other Social media for this event:',
"element7" => 'Please list the organization(s) that will be benefiting from this event and if they are 501c3:',
"element8" => 'Race Director/Point of Contact - First Name:',
"element9" => 'Last Name:',
"element10" => 'E-mail Address:',
"element11" => 'Phone:',
"element12" => 'Address Line 1:',
"element13" => 'Address Line 2:',
"element14" => 'City:',
"element15" => 'State:',
"element16" => 'Zip:',
"element17" => 'How many participants do you expect at this event?:',
"element18" => 'Is this the first year for this event?',
"element19" => 'How many participants did you have at this event last year?:',
"element20" => 'Please state the level of sponsorship/donation that you are seeking for this event. Our goal is to provide a quality experience for the events that we support:',
"element21" => 'Depending on sponsorship level it will be required to have on-site packet pickup at a Rush Running location.  Do you agree with this requirement?',
"element22" => 'Rush Running reserves the right to be the sole running shoe retailer for running events it sponsors. Do you agree to this requirement?',
"element23" => 'Signature:'
);

$required_fields = array("element0", "element1", "element2", "element3", "element7",
	"element8", "element9", "element10", "element11", "element17", "element20", "element21");

//$required_fields = array("element0", "element1", "element2", "element3", "element4", "element5", "element6",
//	"element7", "element8", "element9", "element10", "element11", "element12", "element13", "element14",
//	"element15", "element16", "element17", "element18", "element19", "element20", "element21", "element22",
//	"element23");

$mail_from_name 	= "element23";
$mail_from_email 	= "element10";
$mail_subject 		= "element0";

//uses the email address defined above as the from email.
$send_from_users_email = false;

//sets the PHP setting 'sendmail_from' for use on a windows server.
$windows_server = false;

// Set up the error and success messages.
$message_success = 'Thank you, your sponsorship request has been sent.';
$message_unset_fields = "Fields marked with * are required.";


////////////////////////////////////////////////////
// End variables to be written out by RapidWeaver //
////////////////////////////////////////////////////

//Check key variable from form against session key.
if(!isset($_POST['form_token']) || $_POST['form_token'] != $_SESSION['security_token']) {
	//Set a fixed error message if the key's don't match.
	$_SESSION['formMessage'] = "We cannot verify that you are trying to send an email from this form. Please try again.";
	//If they don't match, send back to form.
	header("Location: ".$return_url);
	exit;
}

//SPAM checking. If the "comment" form field has been filled out, send back to form asking to remove content and exit the script.
if ($_POST['comment']) {
	$_SESSION['formMessage'] = "Please remove content from the last textarea before submitting the form again. This is to protect against SPAM abuse.";
	header("Location: ".$return_url);
	exit;
}

/////////////////////////
// PROCESS FORM FIELDS //
/////////////////////////
foreach($_POST['form'] as $key => $value) {
	$_SESSION['form'][$key] = safe_escape_string($value);
}

///////////////////////////
// CHECK REQUIRED FIELDS //
///////////////////////////

//if any of the required fields are empty
if(check_required_fields($required_fields) == false) {
	
	//set the error message
	$_SESSION['formMessage'] = $message_unset_fields;
	
	//then send back to form
	header("Location: ".$return_url);
	
	//and exit the script
	exit;
	
	//else they have filled in all required fields
} else {
	
	///////////////////////////////////
	// ALL IS OK, SETUP GLOBAL VAR'S //
	///////////////////////////////////
	
	//check email address
	if (!check_email($email)) unset($email);
	
	//set mime boundry. Needed to send the email. Mixed seperates text from attachments. 
	$mixed_mime_boundary = "rms-mix-x".md5(mt_rand())."x";
	//alt seperates html from plain text.
	$alt_mime_boundary = "rms-alt-x".md5(mt_rand())."x";
	
	//set the from address if user supplied email is invalid use form owners.
	$submitted_email = $_SESSION['form'][$mail_from_email];
	
	if(check_email($submitted_email) && $send_from_users_email == false) {
		$from = $reply_to = stripslashes($_SESSION['form'][$mail_from_name])."<".stripslashes($submitted_email).">";
	} else {
		$from = "<".$email.">";
		$reply_to = check_email($submitted_email) ? "<".stripslashes($submitted_email).">" : $from;
	}
	
	//set the email subject
	$subject= prepare_plain_text($_SESSION['form'][$mail_subject]);
	
	//Email headers
	$headers = "From: $from\n";
	$headers .= "Reply-to: $reply_to\n";
	$headers .= "MIME-Version: 1.0\n"."Content-Type: multipart/mixed; ";
	$headers .= "boundary=$mixed_mime_boundary";
	
	////////////////////////////
	// CONSTRUCT HTML CONTENT //
	////////////////////////////
	
	//Construct HTML email content, looping through each form element
	
	//Note: When you get to a file attachment you need to use $_FILES['form_element']['name']
	//This will just output the name of the file. The files will actually be attached at the end of the message.
	
	//Set a variable for the message content
	$html_content = '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
	<html xml:lang=\"en-us\" xmlns=\"http://www.w3.org/1999/xhtml\">
	<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<title>$subject</title>
	</head>
	<body><p>';
	
	////////////////////////////
	// CONSTRUCT TEXT CONTENT //
	////////////////////////////
	
	//Construct a plain text version of the email.
	$text_content = "";
	
	//build a message from the reply for both HTML and text in one loop.
	foreach($form_fields as $field => $label) {
		$html_content .= "<b>$label</b> ";
		$text_content .= $label." ";
		if(isset($_FILES[$field])) {
			$string = (isset($_FILES[$field]['name'])) ? $_FILES[$field]['name'] : "";
		} else {
			$string = (isset($_SESSION['form'][$field])) ? $_SESSION['form'][$field] : "";
		}
		$html_content .= $string."<br /><br />";
		$text_content .= $string."\n\n";
	}
	
	//close the HTML content.
	$html_content .= '</p></body></html>';
	
	/////////////////////////////
	// CONSTRUCT EMAIL MESSAGE //
	/////////////////////////////
	
	//Now we combine both HTML and plain text version of the email into one.
	//Creating the message body which contains a Plain text version and an HTML version, users email client will decide which version to display
	$message = 	"\n" . "--$mixed_mime_boundary\n" . 
	"Content-Type: multipart/alternative; boundary=$alt_mime_boundary\n\n" .
	"--$alt_mime_boundary\n" .
	"Content-Type: text/plain; charset=UTF-8; format=flowed\n" . 
	"Content-Transfer-Encoding: Quoted-printable\n\n" .
	prepare_plain_text($text_content)."\n\n" . 
	"--$alt_mime_boundary\n" . 
	"Content-Type: text/html; charset=UTF-8\n" . 
	"Content-Transfer-Encoding: Quoted-printable\n\n" . 
	stripslashes($html_content). "\n\n" .
	"--".$alt_mime_boundary."--\n\n" .
	"\n\n--$mixed_mime_boundary";	
	
	
	//////////////////////
	// FILE ATTACHMENTS //
	//////////////////////
	
	//IMPORTANT: Only add this if an attachment is added to the form.
	
	//Loop through the $_FILES global array and add each attachment to the form.
	if (isset($_FILES)) {
		foreach ($_FILES as $attachment) {
			//if the file exists
			if (file_exists($attachment['tmp_name'])){
				//if the file has been uploaded
				if(is_uploaded_file($attachment['tmp_name'])){
					$file = fopen($attachment['tmp_name'],'rb');
					$data = fread($file,filesize($attachment['tmp_name']));
					fclose($file);
					$data = chunk_split(base64_encode($data));
					
					$message .= "\nContent-Type: application/octet-stream; " . " name=".$attachment['name']."\n"."Content-Disposition: attachment; "." filename=".$attachment['name']."\n"."Content-Transfer-Encoding: base64\n\n".$data."\n\n--$mixed_mime_boundary";
				} else { //else there was an error uploading the file
					$_SESSION['formMessage'] = "There has been an error uploading the attachments, please try again.\n"; //set error message
					header("Location: ".$return_url); //send back to form
					exit; //exit script
				}
			} 
		}
	}
	
	
	//finish off message
	$message .= "--";
	
	//for windows users.
	if($windows_server == true) ini_set('sendmail_from', $email);
	
	//if the mail sending works
	if (@mail($email, stripslashes($subject), stripslashes($message), $headers)) {
		//set the success message
		$_SESSION["formMessage"] = $message_success;
		unset($_SESSION['form']);
	} else { //if mail sending fails
		$_SESSION["formMessage"] = "I'm sorry, there seems to have been an error trying to send your email. Please try again.";
	}
	
	//redirect to the form
	header("Location: ".$return_url);
}

//////////////////////
// GLOBAL FUNCTIONS //
//////////////////////	

// Function to escape data inputted from users. This is to protect against an crazy characters.
// Sample code: safe_escape_string($_POST['form_field'])
function safe_escape_string($string, $encode_all_entites = false) {
	if (!get_magic_quotes_gpc()) $string = addslashes($string);
	if($encode_all_entites === true) {
		$string = htmlentities($string, ENT_QUOTES);
	} else {
		$string = htmlspecialchars($string, ENT_QUOTES);
	}
	return $string;
}

// Function to decode escaped data for use in the text only email.
function prepare_plain_text($text_content) {
	return stripslashes(@ html_entity_decode($text_content, ENT_QUOTES));
}

// Function to check the validity of email address.
function check_email($email) {
	//return eregi("^([a-z0-9_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,4}$", $email);
	return preg_match("/^([a-z0-9_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,4}$/i", $email);
}

// Function to check the required fields are filled in.
function check_required_fields($required_fields) {
	foreach($required_fields as $field) {
		if((!isset($_SESSION['form'][$field]) || empty($_SESSION['form'][$field])) && (!isset($_FILES[$field]) || empty($_FILES[$field]['name']))) return false;
	}
	return true;
}
?>