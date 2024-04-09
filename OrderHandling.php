<?php
    require('Utils\Connection.php');
    session_start();

    if(isset($_POST['accept'])){
        $pName = $_POST['pName'];
        $price = $_POST['price'];
        $token = $_POST['token'];
        $pQuantity = $_POST['pQuantity'];
        $uId = $_POST['uId'];
        $number = $_POST['number'];
        $oId = $_POST['oId'];
    
        $sql = "UPDATE `orders` SET `status`='Accepted' WHERE `oId` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $oId);
    
        if(mysqli_stmt_execute($stmt)){
            // Successfully accepted the order
            echo '<script>window.location.href = "PendingOrders.php";</script>';
            exit;
        }
        else{
            echo '<script>alert("Error while accepting order");</script>';
        }
    
        mysqli_stmt_close($stmt);
    }
    

    if(isset($_POST['reject'])){
        $pName = $_POST['pname'];
        $price = $_POST['price'];
        $token = $_POST['token'];
        $pQuantity = $_POST['pQuantity'];
        $uId = $_POST['uId'];
        $number = $_POST['number'];
        $oId = $_POST['oId'];
    
        $sql = "UPDATE `orders` SET `status`='Rejected' WHERE `oId` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $oId);
        
        if(mysqli_stmt_execute($stmt)){
            // Successfully rejected the order
            echo '<script>window.location.href = "PendingOrders.php";</script>';
        }
        else{
            echo '<script>alert("Error occurred while rejecting order");</script>';
        }
        
        mysqli_stmt_close($stmt);
    }

    if(isset($_POST['delivered'])){
        $pName = $_POST['pname'];
        $price = $_POST['price'];
        $token = $_POST['token'];
        $pQuantity = $_POST['pQuantity'];
        $uId = $_POST['uId'];
        $number = $_POST['number'];
        $oId = $_POST['oId'];
    
        $sql = "UPDATE `orders` SET `status`='Delivered' WHERE `oId` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $oId);
        
        if(mysqli_stmt_execute($stmt)){
            // Successfully marked the order as delivered
            echo '<script>window.location.href = "PendingOrders.php";</script>';
        }
        else{
            echo '<script>alert("Error occurred while marking order as delivered");</script>';
        }
        
        mysqli_stmt_close($stmt);
    }
?>
