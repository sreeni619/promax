<!DOCTYPE html>
<html>

<head>
	<title>career action</title>
</head>

<body>
		<?php

		// servername => localhost
		// username => root
		// password => empty
		// database name => proindia
		$conn = mysqli_connect("localhost", "medha_promax", "j?_m?D_001ua", "medha_promax");
        ini_set('SMTP', "medhatech.in");
ini_set('smtp_port', "25");
ini_set('sendmail_from', "kavya@medhatech.in");

		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		// Taking all 5 values from the form data(input)
		$username = $_REQUEST['username'];
		$phone = $_REQUEST['phone'];
		$company = $_REQUEST['company'];
		$email = $_REQUEST['email'];
        $qualification = $_REQUEST['qualification'];
		$resume = $_FILES['resume']['name'];
        $target_path = "resumes/";  
            $target_path = $target_path.basename( $_FILES['resume']['name']);   
        
            if(move_uploaded_file($_FILES['resume']['tmp_name'], $target_path)) {  
                echo "File uploaded successfully!";  
            } else{  
                echo "Sorry, file not uploaded, please try again!";  
            }  
          
        $message = $_REQUEST['message'];
		
		// Performing insert query execution
		// here our table name is college
		$sql = "INSERT INTO resume (username,phone,company,email,qualification,resume,message) VALUES ('$username',
			'$phone','$company','$email','$qualification','$resume','$message')";
              mysqli_query($conn, $sql);

                // if(mysqli_query($conn, $sql)){
                //     header("Location: careers.php?msg=s");
         
                 
                //  } else{
                //        header("Location: careers.php?msg=e");
         
                //  }
		// Close connection
		mysqli_close($conn);
        
$message = ""; 
if(isset($_POST['submit'])){
	$to = "girish@medhatech.in"; // Your email address
	$username = $_POST['username'];
	$phone = $_POST['phone'];
	$company = $_POST['company'];
	$email=$_POST['email'];
    $qualification=$_POST['qualification'];
    $resume=$_POST['resume'];
    $message=$_POST['message'];
	$message = "<!DOCTYPE html>
	<html>
	<head>
	</head>
	<body>
	<table rules='all' border='1' style='border-color: #666;' cellpadding='10'>
    <tr style='background: #eee;'><td colspan='2'><strong>Contact Form Details</strong> </td></tr>
    <tr>
        <td><strong>Name:</strong></td>
        <td>".$_POST['username']."</td>
    </tr>
    <tr>
        <td><strong>Mobile:</strong></td>
        <td>".$_POST['phone']."</td>
    </tr>
    <tr>
        <td><strong>Email:</strong></td>
        <td>".$_POST['company']."</td>
    </tr>
    <tr>
        <td><strong>Subject:</strong></td>
        <td>".$_POST['email']."</td>
    </tr>
    <tr>
        <td><strong>Message:</strong></td>
        <td>".$_POST['qualification']."</td>
    </tr>
    <tr>
         <td><strong>Message:</strong></td>
         <td>".$_POST['resume']."</td>
    </tr>
    <tr>
        <td><strong>Message:</strong></td>
        <td>".$_POST['message']."</td>
    </tr>
	</table>
	</body>
	</html>";
	
	$subject = "Contact Form Details";
	
	// Set content-type header for sending HTML email 
	$headers = array("From: kavya@medhatech.in",
    "Reply-To: kavya@medhatech.in",
    "X-Mailer: PHP/" . PHP_VERSION,"Content-Type: text/html; charset=UTF-8\r\n");
    $headers = implode("\r\n", $headers);
	
	$result = mail($to,$subject,$message,$headers);
	$errorMessage = error_get_last()['message'];
	print_r(error_get_last());
    die();
	if ($result) {
		// $message = "Your Message was sent Successfully!";
		 header("Location: careers.php?msg=s");
		 echo '<script type="text/javascript">alert("Your Message was sent Successfully!");</script>';

	}else{
		// $message = "Sorry! Message was not sent, Try again Later.";
		header("Location: careers.php?msg=e");
		echo '<script type="text/javascript">alert("Sorry! Message was not sent, Try again Later.");</script>';
	}
	// header('Location: careers.php');
}
?>
</body>

</html>
