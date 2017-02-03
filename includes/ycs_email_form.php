<?php 
if(isset($_POST['submit'])){
    $to = "yourcompusolutions@gmail.com,vulpineblazeyt@gmail.com,jacobmaestre916@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Form submission - YCS WebPage Email";
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    $mail_bool = mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
	echo '<script language="javascript">';
	echo 'alert("Mail Sent. Thank you ' . $first_name . ', we will contact you shortly. ")';
	echo '</script>';
    // You can also use header('Location: thank_you.php'); to redirect to another page. test.
    }
    //test for changes
?>