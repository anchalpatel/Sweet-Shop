<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Crowd Management</title>
    <?php include 'Links/links.php'; ?>
    <style>
      #email {
        border: 0.5px solid ; /* Set the border color to EAB76F */
        border-radius: 10px; /* Set the border radius to 10px for a rounded border */
        padding: 10px; /* Adjust the padding for better spacing */
        width: 100%;
        background-color: #EAB76F;
        color:#070808
      }
      i {
        color: #EDA43D;
      }
      .conf {
        border-radius: 10px;
        padding-top: 12px;
        padding-bottom: 12px;
        
      }
    </style>
</head>

<body>

<?php
include 'Utils\Connection.php';

// Function to send OTP via email

function smtp_mailer($to, $subject, $msg) {
  // Include the PHPMailerAutoload
  require './smtp/PHPMailerAutoload.php';

  // Initialize the PHPMailer instance
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 587;
  // $mail->SMTPDebug = 2; // Set SMTP debug level
  $mail->IsHTML(true);
  $mail->CharSet = 'UTF-8';
  $mail->Username = "hgandhi1810@gmail.com";
  $mail->Password = "lizmefabcskdpnqz";
  $mail->SetFrom("hgandhi1810@gmail.com");
  $mail->Subject = $subject;
  $mail->Body = $msg;
  $mail->AddAddress($to);
  $mail->SMTPOptions = array('ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => false
  ));
  if (!$mail->Send()) {
      echo "Email Sending Failed";
  } else {
      $_SESSION['message'] = "Check Your Mail to Activate Your Account $to";
  }
}

function updateOTP($conn, $email, $otp) {
    $updateQuery = "UPDATE user SET otp = '$otp' WHERE email = '$email'";
    $query = mysqli_query($conn, $updateQuery);

    if ($query) {
        echo "OTP updated successfully.";
        header('location:activateLogin.php');
    } else {
        echo "Failed to update OTP: " . mysqli_error($conn);
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $emailSearch = "SELECT * FROM user WHERE email = '$email' ";
    $query = mysqli_query($conn, $emailSearch);

    $emailCount = mysqli_num_rows($query);

    if ($emailCount > 0) {
        $pass = mysqli_fetch_assoc($query);
        $_SESSION['uName'] = $pass['uName'];
        $_SESSION['email'] = $pass['email'];
        // Generate and send OTP
        $otp = rand(100000, 999999);
        $msg = "Hi, " . $_SESSION['uName'] . ". Your OTP is: $otp. Click here to access your account http://localhost/DE/activate.php";
        smtp_mailer($email, 'Login Through OTP', $msg);
        updateOTP($conn, $email, $otp);

    } else {
        ?>
        <script>
            alert("Invalid Email. Please Sign Up First");
        </script>
        <?php
    }
}

mysqli_close($conn);
?>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Log In</p>

                <div>
                  <!-- <p class=" bg-success text-white px-4 conf"><?php 
                  
                  if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                  }
                  else {
                    echo $_SESSION['message'] = "You are Logged Out Please Logged in Again.";
                  }
                  
                  ?></p> -->
                </div>

                <form class="mx-5 mx-md-5" style="margine-right:-30px" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">



                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-envelope fa-lg mx-4 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="email" class="form-control" required name="email" value="<?php if(isset($_COOKIE['emailcookie'])){
                        echo $_COOKIE['emailcookie'];
                      }?>"/>
                      <label class="form-label" for="email" >Enter Your Email</label>
                    </div>
                  </div>

                 
                  <div class="form-check d-flex justify-content-center mb-5">
         
                  </div>


                  <div class="form-check d-flex justify-content-center mb-5">
                    
                    <label class="form-check-label" for="form2Example3">
                      Does Not Have an account?<a href="signup.php">Sign Up</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-success" name="submit">Log In</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
              <img src="./images/sweet1.png"
                  class="img-fluid" alt="Sample image" width="400px" >

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>