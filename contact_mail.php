<?php
session_start();

echo "<title>Chandra Arun  Crop Science</title>";
if(empty($_SESSION['4_letters_code'] ) ||
	  strcasecmp($_SESSION['4_letters_code'], $_POST['4_letters_code']) != 0)
	{
		echo '<script language="JavaScript">alert("The captcha code does not match!!")</script>';
		echo "<script language=\"JavaScript\"><!--\n ";
		echo "var timer = setTimeout(function() { window.location='Contact.html'}, 000); \n// --></script>";
	}
	else
	{
// ------- three variables you MUST change below  -------------------------------------------------------
$replyemail="rajeshchauhan.niit@gmail.com"; //change to your email address
$valid_ref1="Contact.html";
$valid_ref2="Contact.html"; //chamge to your domain name

// -------- No changes required below here -------------------------------------------------------------
//
// email variable not set - load $valid_ref1 page
if (!isset($_POST['enqemail'])){
    echo "<script language=\"JavaScript\"><!--\n ";
    echo "top.location.href = \"$valid_ref1\"; \n// --></script>";
    exit;
}
//check provided email address is VALID.
if(filter_var($_POST["enqemail"], FILTER_VALIDATE_EMAIL)==FALSE ){
    echo "<script language=\"JavaScript\"><!--\n alert(\"ERROR - email address provided is invalid.\\n\\n\");\n";
    echo "top.location.href = \"$valid_ref1\"; \n// --></script>";
    exit;
}
$ref_page=$_SERVER["HTTP_REFERER"];
$valid_referrer=0;
if($ref_page==$valid_ref1) $valid_referrer=1;
elseif($ref_page==$valid_ref2) $valid_referrer=1;
/*if((!$valid_referrer) OR ($_POST["block_spam_bots"]!=12))//you can change this but remember to change it in the contact form too
{
 echo '<h2>ERROR - not sent.';
 if (file_exists("debug.flag")) echo '<hr>"$valid_ref1" and "$valid_ref2" are incorrect within the file:<br>
                                      contact_process.php <br><br>On your system these should be set to: <blockquote>
                                                                          $valid_ref1="'.str_replace("www.","",$ref_page).'"; <br>
                                                                          $valid_ref2="'.$ref_page.'";
                                                                          </blockquote></h2>Copy and paste the two lines above
                                                                          into the file: contact_process.php <br> (replacing the existing variables and settings)';
 exit;
}*/

//check user input for possible header injection attempts!
function is_forbidden($str,$check_all_patterns = true)
{
 $patterns[0] = '/content-type:/';
 $patterns[1] = '/mime-version/';
 $patterns[2] = '/multipart/';
 $patterns[3] = '/Content-Transfer-Encoding/';
 $patterns[4] = '/to:/';
 $patterns[5] = '/cc:/';
 $patterns[6] = '/bcc:/';
 $forbidden = 0;
 for ($i=0; $i<count($patterns); $i++)
  {
   $forbidden = preg_match($patterns[$i], strtolower($str));
   if ($forbidden) break;
  }
 //check for line breaks if checking all patterns
 if ($check_all_patterns AND !$forbidden) $forbidden = preg_match("/(%0a|%0d)/i", $str);
 if ($forbidden)
 {
  echo "<font color=red><center><h3>STOP! Message not sent.</center></h3></font>";
  
   echo "<script language=\"JavaScript\"><!--\n ";
	echo "var timer = setTimeout(function() { window.location='Contact.html'}, 1000); \n// --></script>";     
   
 }
}

foreach ($_REQUEST as $key => $value) //check all input
{

}

$name = $_POST['enqname'];
$email = $_POST['enqemail'];
$mobile = $_POST['enqmobileNumber'];
$themessage = $_POST['enqmes'];

    $message = "Chandra Arun Crop Science | Contact New Enquiry";
    			
			$body = '<html><head><style> table { border: thick solid blue; } </style></head><body>';
			$body .= '<table rules="all" style="border-color: #green;  font-size: 19px;" cellpadding="10">';
			$body .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['enqname']) . "</td></tr>";
			$body .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['enqemail']) . "</td></tr>";
			$body .= "<tr style='background: #eee;'><td><strong>Contact No:</strong> </td><td>" . strip_tags($_POST['enqmobileNumber']) . "</td></tr>";
			$body .= "<tr style='background: #eee;'><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['enqmes']) . "</td></tr>";
			$body .= "</table>";
			$body .= "</body></html>";	

$success_sent_msg='<p align="center"><strong>&nbsp;</strong></p>
                   <p align="center"><strong>Your message has been successfully sent to us<br>
                   </strong> and we will reply as soon as possible.</p>
                  
                   <p align="center">Thank you for contacting us.</p>';

$replymessage = "Hi $name

Thank you for your email.

We will endeavour to reply to you shortly.

Please DO NOT reply to this email.

Thank you";

$message = "name: $name \nQuery: $themessage";

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From: ' . $email . "\r\n";
	mail($replyemail,$message,$body,$headers);



mail("$email",
     "Receipt: $message",
     "$replymessage",
     "From: $replyemail\nReply-To: $replyemail");
echo $success_sent_msg;

echo "<script language=\"JavaScript\"><!--\n ";
echo "var timer = setTimeout(function() { window.location='Contact.html'}, 1000); \n// --></script>";
	
	}
?>