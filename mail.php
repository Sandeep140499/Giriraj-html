<?php
//get data from form  
$name = $_POST['name'];
$email= $_POST['email'];
$message= $_POST['message'];
$number = $_POST['number'];
$to = "cbco1@gmail.com";
$subject = "Mail From delhihairclinic";
$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Message =" . $message . "\r\n mobile number =". $number;
$headers = "From: noreply@delhiclinic.ankurbhogia.com/" . "\r\n" .
"CC: ";
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect
header("Location:thankyou.html");
?>