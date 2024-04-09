<?php
session_start();
include 'Utils\Connection.php';

function verifyOTP($conn, $email, $otp) {
    $selectQuery = "SELECT * FROM user WHERE `email` = '$email' AND `otp` = '$otp'";
    echo $selectQuery;
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) > 0) {
        $updateQuery = "UPDATE user SET `otp` = '$otp' WHERE `email` = '$email'"; // Clear OTP after successful verification
        $query = mysqli_query($conn, $updateQuery);

        if ($query) {
            $_SESSION['message'] = "Account Updated Successfully";
            $row = mysqli_fetch_assoc($result);
            $_SESSION["role"] = $row["role"];
            $_SESSION['uName'] = $row['uName'];
            $_SESSION["isLoggedin"] = true;
            $_SESSION['mobile'] = $row['mobileNumber'];
            $_SESSION['uId'] = $row['uId'];
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['message'] = "Account Not Updated";
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid OTP";
        header('Location: index.php');
        exit();
    }
}

if (isset($_POST['submit'])) {
    $email = $_SESSION['email'] ?? '';
    $user_otp = mysqli_real_escape_string($conn, $_POST['email']);

    echo "Email: $email, OTP: $user_otp"; // Adding debug statement to check the values

    verifyOTP($conn, $email, $user_otp);
}
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
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content_center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">OTP Verification</p>
                                <form class="mx-1 mx-md-4" style="width: 95%" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa fa-key fa-lg mx-4 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0 ">
                                            <input type="text" id="email" class="form-control" style="color: #070808" required name="email" />
                                            <label class="form-label" for="email">Enter Your OTP</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg btn-success" name="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="./images/sweet1.png" class="img-fluid" style="width: 400px" alt="Sample image">
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
