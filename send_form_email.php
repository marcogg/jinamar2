<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = " ops@jinamar.com.mx";
    $email_subject = "Nueva entrada en formulario desde Sitio Web";
 
    function died($error) {
        // your error code can go here
        echo '<script type="text/javascript">alert("We are very sorry, but there were error(s) found with the form you submitted.");
        window.location.href = "contacto.html";</script>';
        echo '<script type="text/javascript">alert("An error has ocurred.");
        window.location.href = "contacto.html";</script>';
        echo $error."<br /><br />";
        echo '<script type="text/javascript">alert("Please check form inputs");
        window.location.href = "contacto.html";</script>';
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= '<script type="text/javascript">alert("The Email Address you entered does not appear to be valid.");
    window.location.href = "contacto.html";</script>';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= '<script type="text/javascript">alert("The First Name you entered does not appear to be valid.<br />");
    window.location.href = "contacto.html";</script>';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= '<script type="text/javascript">alert("The Last Name you entered does not appear to be valid.<br />");
    window.location.href = "contacto.html";</script>';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= '<script type="text/javascript">alert("The Comments you entered do not appear to be valid.<br />");
    window.location.href = "contacto.html";</script>';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Full Name: ".clean_string($first_name)."\n";
    //$email_message .= "City: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->

<script type="text/javascript">
  alert("Message has been sent, we will contact you soon");
  window.location='contact.html';
</script>


<?php
 
}
?>