<?php
    require("Utils\Connection.php");
    session_start();
    // session_destroy();

    if(!isset($_SESSION['isLoggedin']) ){
        echo '<div class=="text-center">Please First Login</div>';
        header('Location: login.php');
    }

    if(isset($_POST['addCart'])){
        $id = $_POST['id'];
        $pName = $_POST['pName'];
        $pPrice = $_POST['pPrice'];
        $quantity = $_POST['quantity'];
        $number = $_POST['number'];
        $userId = $_SESSION['uId'];
        $sql = "SELECT cartItemId from cart where userId = '$userId' AND productId='$id'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            echo '
                <script>
                    console.log("Product is already in the cart.");
                    alert("Product is already in the cart.");
                    window.location.href = "Products.php";
                </script>
            ';
        }
        
        else{
            $sql = "INSERT INTO cart (userId, productId, pQuantNum) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $_SESSION['uId'], $id, $number); // Assuming $id and $number are integers
            $stmt->execute();
            // print_r($_SESSION['cart']); 

        }
        header('location:Products.php'); 
       
    }
    if(isset($_POST['remove'])){
        if(isset($_SESSION['uId']) && isset($_SESSION['role']) && $_SESSION['role']=='customer'){
            $userId = $_SESSION['uId'];
            $productId = $_POST['id'];
            $sql = "DELETE  FROM cart where userId = $userId AND productId = $productId";
            mysqli_query($conn, $sql);
            header('location:Cart.php');
        }
        
    }
    if(isset($_POST['update'])){
        $productId = $_POST['id'];
        header('Location: Update.php?productId=' . $productId);
        exit;
    }

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM `product` WHERE `product`.`pId` = $id";

        $result = mysqli_query($conn, $sql);

        if($result){
           echo '
            <script>
                alert("Product deleted successfully");
            </script>
           ';
           header('location:Products.php');
        }
        else{
            echo '
            <script>
                alert("Error has occured while deleting the product");
            </script>
           ';
           header('location:Products.php');
        }
        mysqli_close($conn);

    }

    if(isset($_POST['addProduct'])){
        header('location:add_product.php');
    }

    if(isset($_POST['buy'])){
        if (empty($_POST['deliveryDate'])) {
            echo '<script>alert("Please set delivery date.");</script>';
            // Redirect to the cart page after the alert is closed
            echo '<script>window.location.href = "Cart.php";</script>';
            // Stop further execution
            exit;
        } else{
        $uId = $_SESSION['uId'];
        $pPrice = $_POST['price'];
        $pId = $_POST['id'];
        $quantity = $_POST['quantity'];
        $select = "SELECT `pId`, `pName`, `price`, `category`, `pImage`, `quantity`, `createdAt`, `stock`, `sold` FROM `product` WHERE `pId`=$pId";
        $row = mysqli_query($conn, $select);
        $queryResult = mysqli_fetch_assoc($row);

        $pQuantity = $queryResult['quantity'];

        if($pQuantity==250 || $pQuantity==500){
            $pQuantity = $pQuantity/1000;
        }

        $stock = $queryResult['stock'] - $pQuantity * $quantity;

        if($stock<0){
            echo '
                <script>
                    alert("Insufficient stock");
                </script>';
            header('Location:Products.php');
        }
        else{

            $pName = $queryResult['pName'];

            $sold = $queryResult['sold'] + $pQuantity * $quantity;
            $photo = $queryResult['pImage'];
            $pPrice = $queryResult['price'];
            $pQuantity = $queryResult['quantity'];
            $deliveryDate = $_POST['deliveryDate'];
            $token = md5(uniqid().rand(10000, 99999));
            $createdAt = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("INSERT INTO `orders`(`oName`, `pId`, `uId`, `price`, `photo`, `number`, `deliveryDate`, `token`, `pPrice`, `pQuantity`,`createdAt`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdssssssss", $pName, $pId, $uId, $pPrice, $photo, $quantity, $deliveryDate, $token, $pPrice, $pQuantity, $createdAt);


           $getEmailQuery = "SELECT `email` FROM `user` WHERE `uId` = ?";
           $stmt_email = $conn->prepare($getEmailQuery);
           $stmt_email->bind_param("d", $uId);
           $stmt_email->execute();
           $stmt_email->store_result();
           $stmt_email->bind_result($email);
           if($stmt_email->num_rows > 0){
            include('./smtp/PHPMailerAutoload.php');
            $stmt_email->fetch();

            // Send email to the user
            $msg = "Hi, Your Order is $pName and your price for the product is $pPrice. Here is your token for the further purpose $token ";
            //smtp_mailer($email, 'Buy Product', $msg); // Call the function to send the email
            function smtp_mailer($to, $subject, $msg) {
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                // $mail->SMTPDebug = 2;
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                // $mail->SMTPDebug = 2;
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
                    $_SESSION['message'] = "Check Your Mail to Activate Your Account";
                    header('location:Products.php');
                }
            }
            smtp_mailer($email, 'Buy Product', $msg); // Call the function to send the email
        } else {
            echo "No user found with the given uId.";
        
    }
            if ($stmt->execute()) {
                
            } else {
                // Handle the error
                echo "Error: " . $stmt->error;
            }

            $update = "UPDATE `product` SET `stock`='$stock', `sold`='$sold' WHERE `pId`=$pId";
            $updateResult = mysqli_query($conn, $update);

            if ($updateResult) {
               

                echo '<script>
                        alert("Product bought successfully");
                        winow.location.href = "Products.php";
                    </script>';
               
            } else {
                // Handle the update error
                echo "Error updating product: " . mysqli_error($conn);
            }

        }
       
        

        
    }
}
?>