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
            $sql = "INSERT INTO cart (userId, productId, pQuantNum, quantity) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiii", $_SESSION['uId'], $id, $number, $quantity); // Assuming $id and $number are integers
            $stmt->execute();
            // print_r($_SESSION['cart']); 

        }
        header('location:Products.php'); 
       
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

   
?>