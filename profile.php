<?php
    require("Utils\Connection.php");    
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include 'Links/links.php' ?>
    <style>

    </style>
</head>

<body>
    <?php
    require('Utils\Navbar.php');
    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
    

            <!-- Main Content -->
            <div class="col-md-9 h-1000">
                <h1 class="" style="color:#EDA43D; margin-top:2%; margin-left:3.5%;">Profile</h1>
                <hr style="height: 4px; background-color:#EDA43D ;  color:#EDA43D; width: 15%; margin-left:2%;">

                <div class="box d-flex align-items-start">
                    <?php
                        echo '
                            <img src="https://api.dicebear.com/5.x/initials/svg?seed='.$_SESSION['uName'].'" alt="" style="width:15%; height:15%; margin-top:7%; margin-left:5%; border-radius:50%;">
                        ';
                    ?>
                    
    
                    <div class="content ml-5" style="padding-top:5%; margin-top:4%;">
                        <?php
                        if (isset($_POST['submit'])) {
                            $_SESSION['uName'] = $_POST['uName'];
                            $_SESSION['email'] = $_POST['email'];
                            $_SESSION['mobile'] = $_POST['mobileNumber'];
                        }

                        if (isset($_SESSION)) {
                            $name = $_SESSION['uName'];
                            $email = $_SESSION['email'];
                            $mobileNumber = $_SESSION['mobile'];
                            
                            echo "<h5 id='name' >" . "Name : " . $name . "</h5>";
                            echo "<h5> Email : " . $email . "</h5>";
                            echo "<h5> Contact No. : " . $mobileNumber . "</h5>";
                        }
                        ?>
                    </div>
                </div>

                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-success" onclick="gotoupdate()"
                        name="submit">Update Profile</button>
                </div>

            </div>
        </div>
    </div>


    <script>
        function gotoupdate() {
            window.location.href = "updateProfile.php";
        }

    </script>

</body>

</html>