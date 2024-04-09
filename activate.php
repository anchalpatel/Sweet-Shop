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

function verifyOTP($conn, $email, $otp) {
    $selectQuery = "SELECT * FROM user WHERE email = '$email' AND otp = '$otp'";
    $result = mysqli_query($conn, $selectQuery);

    if(mysqli_num_rows($result) > 0) {
        $updateQuery = "UPDATE user SET status = 'active' WHERE email = '$email' AND otp = '$otp'";
        $query = mysqli_query($conn, $updateQuery);

        if($query) {
          ?><script>
            alert("Account Updated Successfully");
          </script>
          <?php
           $row = mysqli_fetch_assoc($result);
           $_SESSION["role"] = $row["role"];

           $_SESSION["isLoggedin"] = true;
           $_SESSION['uId'] = $row['uId'];
            header('location: index.php');
        } 
        else {
          ?><script>
          alert("Account Not Updated Successfully");
          </script><?php
            header('location: signup.php');
          }
    } else {
      ?><script>
      alert("Invalid OTP");
    </script><?php
      header('location: signup.php');
    }
}

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $selectQuery = "SELECT * FROM user WHERE token = '$token'";
    $result = mysqli_query($conn, $selectQuery);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email']; // Assuming your column name for storing email is 'email'
        $otp = $row['otp']; // Assuming your column name for storing OTP is 'otp'

        verifyOTP($conn, $email, $otp);
    } else {
      ?><script>
      alert("Invalid Token");
    </script><?php
        header('location: signup.php');
    }
}
?>



<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">OTP Verification</p>

                

                <form class="mx-1 mx-md-4" style="width:95%" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">



                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-key fa-lg mx-4 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 ">
                      <input type="text" id="email" class="form-control " style="color:#070808" required name="email"
                        />
                      <label class="form-label" for="email" >Enter Your OTP</label>
                    </div>
                  </div>

                 
                  <div class="form-check d-flex justify-content-center mb-5">
         
                  </div>


              

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-success" name="submit">Submit</button>
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
