<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Regestration Form</title>
    <?php include 'Links/links.php'?>
    <style>
      .signup{
        border: 0.5px solid ; /* Set the border color to EAB76F */
        border-radius: 10px; /* Set the border radius to 10px for a rounded border */
        padding: 10px; /* Adjust the padding for better spacing */
        width: 100%;
        background-color: #EAB76F;
        color:#070808
      }
      i{
        color: #EDA43D;
      }
    </style>
</head>

<body>
<?php
include 'Utils\Connection.php';

if(isset($_POST['submit'])) {
    $uName = mysqli_real_escape_string($conn, $_POST['uName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobile']);

    // Generating token and OTP
    $token = bin2hex(random_bytes(10));
    $otp = rand(100000, 999999);

    $emailQuery = "SELECT * FROM user WHERE email = '$email'";
    $query = mysqli_query($conn, $emailQuery);
    $emailCount = mysqli_num_rows($query);

    if ($emailCount > 0) {
        $alertMessage = "Email already exists.";
    } else {
        // Insert user data into the database
        $insertQuery = "INSERT INTO user (uName, email, mobileNumber, token, status, role, otp) 
                        VALUES ('$uName', '$email', '$mobileNumber', '$token', 'inactive', 'customer', '$otp')";
        $iquery = mysqli_query($conn, $insertQuery);

        
        if ($iquery) {

            include 'emailSending.php';
            ?><script>
               alert("Check Your Mail For activation Your account");
            </script>
           <?php
        } else {
            $alertMessage = "Something went wrong.";
        }
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
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1" >

                <p class="text-center h1 fw-bold mb-2 mx-1 mx-md-4 ">Create New Account</p>
                <p class="text-center   ">Go Started With Your Account</p>

                <form class="mx-1 mx-4 md-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fa fa-user fa-lg fa-fw bg-EDA43D mx-4"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="uName" name="uName" class="form-control signup" style="margin-top: 20px;" required />
                      <label class="form-label" for="uName" >Enter Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-envelope fa-lg  fa-fw mx-4"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control signup" style="margin-top: 20px;" required name="email"/>
                      <label class="form-label" for="form3Example3c" >Enter Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-phone fa-lg mx-4 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="mobile" class="form-control signup" style="margin-top: 20px;" required name="mobile" />
                      <label class="form-label" for="mobile" >Enter Your mobile Number</label>
                    </div>
                  </div>



                  <div class="form-check d-flex justify-content-center mb-5">
                    
                    <label class="form-check-label" for="form2Example3">
                      Have an account?<a href="login.php"> Login</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 ">
                    <button type="submit" class="btn btn-primary btn-lg btn-success" name="submit">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="./images/sweet1.png"
                  class="img-fluid" alt="Sample image" width="700px" >

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
    var alertMessage = "<?php echo $alertMessage; ?>";
    if (alertMessage !== "") {
        alert(alertMessage);
    }
</script>
</body>
</html>