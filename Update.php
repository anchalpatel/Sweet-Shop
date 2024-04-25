<?php
require("Utils\Connection.php");
session_start();
require('Utils\Navbar.php');

$productId = isset($_GET['productId']) ? $_GET['productId'] : null;

if (isset($_POST['submit'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    if(!is_numeric($product_price)){
        echo '
        <script>alert("Price can not be alphabet.")</script>';
        
    }
    $productCategory = $_POST['product_category'];
    $productStock = $_POST['product_stock'];
    if(!is_numeric($product_stock)){
        echo '
        <script>alert("Stock can not be alphabet.")</script>';
        
    }

    // Handle image upload
    if ($_FILES['product_image']['name']) {
        $image = addslashes(file_get_contents($_FILES['product_image']['tmp_name']));
        $sql = "UPDATE product SET pName='$productName', price='$productPrice', category='$productCategory', stock='$productStock', pImage='$image' WHERE pId='$productId'";
    } else {
        $sql = "UPDATE product SET pName='$productName', price='$productPrice', category='$productCategory', stock='$productStock' WHERE pId='$productId'";
    }

    if (mysqli_query($conn, $sql)) {
?>
        <script>
            window.location.href = "Products.php";
        </script>
<?php
    } else {
        echo "Error updating product details: " . mysqli_error($conn);
    }
}

if ($productId) {
    $sql = "SELECT * FROM product WHERE pId=$productId";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $productName = $row['pName'];
        $productPrice = $row['price'];
        $productCategory = $row['category'];
        $productStock = $row['stock'];
        $productImage = base64_encode($row['pImage']);
    } else {
?>
        <script>
            window.location.href = "Products.php";
        </script>
<?php
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .btn {
            margin-left: 200px;
        }

        form {
            margin-top: 23px;
        }

        .custom-input {
            background-color: #EAB76F;
        }

        .main-div {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 50px;
        }

        .heading {
            text-align: center;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="main-div">
        <h1 class="heading">UPDATE PRODUCT</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 flex">
                <div>
                    <label for="product_name" class="form-label">Update Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="<?php echo isset($productName) ? $productName : ''; ?>" required>
                </div>
                <div>
                    <label for="product_price" class="form-label">Update Product Price</label>
                    <input type="text" class="form-control" name="product_price" value="<?php echo isset($productPrice) ? $productPrice : ''; ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="product_category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="product_category" required>
                    <?php
                    $defaultCategory = isset($productCategory) ? $productCategory : '';
                    $options = array("Sweet", "Farshan");
                    foreach ($options as $option) {
                        if ($option == $defaultCategory) {
                            echo "<option value=\"$option\" selected>$option</option>";
                        } else {
                            echo "<option value=\"$option\">$option</option>";
                        }
                    }
                    ?>
                </select>
            </div>


            <div class="mb-3">
                <label for="product_image" class="form-label">Update Image (If you want to update)</label>
                <input type="file" class="form-control" name="product_image" accept="image/*">
            </div>

            

            <div class="mb-3">
                <label for="product_quantity" class="form-label">Update Available Quantity(In Kg) </label>
                <input type="text" class="form-control" name="product_stock" value="<?php echo isset($productStock) ? $productStock : ''; ?>" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success">UPDATE PRODUCT</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>