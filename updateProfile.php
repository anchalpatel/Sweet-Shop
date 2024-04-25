<?php
require("Utils\Connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <?php include 'Links/links.php';
    include 'Utils/Connection.php';
    ?>
    <style>
        #uName,
        #conatct,
        #email {
            border: 0.5px solid;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            background-color: #EAB76F;
            color: #070808;
        }

        #uName:focus,#email:focus,#conatct:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }
    </style>

</head>

<body>
    <?php
        require('Utils\Navbar.php');
        if(isset($_POST['submit'])){
            $uName = $_POST['uName'];
            $email = $_POST['email'];
            $mobileNumber = $_POST['mobile'];
            $uId = $_SESSION['uId'];

            $sql = "UPDATE user SET uname = '$uName', email = '$email', mobileNumber = '$mobileNumber' WHERE uId = $uId";

            $result = mysqli_query($conn, $sql);

            if($result){
                echo '
                    <script>alert("Profile Updated successfully")
                    </script>

                ';
                $_SESSION['uName'] = $uName;
                $_SESSION['mobileNumber'] = $mobileNumber;
                $_SESSION['email'] = $email;

                echo '
                    <script>
                        window.location.href = "profile.php";
                    </script>
                ';
            }
            else{
                echo '
                    <script>alert("Error occured whileaupdating profile")</script>
                ';
            }
        }

    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
      
            <!-- Main Content -->
            <div class="col-md-9 h-1000 mt-5" style="text-align : center;">
                <h1 style="text-align : center; color:#EDA43D;">Update Profile</h1>

                <form action="" method="POST">
                    <!-- <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="name">Your Name</label>
                <input type="text" id="name" name="name" class="form-control signup" required />
            </div> -->


                    <div class="form_update" style="margin-left:20%; margin-top:4%; margin-bottom:2%;">
                        <div class="row ml-5 mb-3 mt-4 text-align-center">
                            <label for="uName" class="col-sm-1 col-form-label">Name </label>
                            <div class="col-sm-6 ">
                                <input type="text" name="uName" class="form-control updatep" id="uName"
                                    value="<?php echo $_SESSION['uName']; ?>"
                                    onkeypress="return((event.charCode>=65 && event.charCode<=90)||(event.charCode>=97 && event.charCode<=122)||(event.charCode==32))"
                                    required>
                            </div>
                        </div>

                        <div class="row ml-5 mb-3 mt-4 text-align-center">
                            <label for="email" class="col-sm-1 col-form-label ">Email </label>
                            <div class="col-sm-6 ">
                                <input type="email" name="email" class="form-control updatep" id="email"
                                    value="<?php echo $_SESSION['email']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3 ml-5 text-align-center">
                            <label for="conatct" class="col-sm-1 col-form-label">Contact </label>
                            <div class="col-sm-6 mt-1">
                                <input type="tel" name="mobile" id="conatct" class="form-control updatep"
                                    value="<?php echo $_SESSION['mobile']; ?>" min="0" minlength="10" maxlength="10"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">

                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mt-4 mb-lg-4">
                        <button type="submit" class="btn btn-primary btn-lg btn-success"
                            name="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</body>

</html>