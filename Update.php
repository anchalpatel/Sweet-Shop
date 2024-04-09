
<?php
    require ("Utils\Connection.php");
    session_start();
    require('Utils\Navbar.php');

    $productId = isset($_GET['productId']) ? $_GET['productId'] : null;

    if (isset($_POST['submit'])) {
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productCategory = $_POST['product_category'];
        $productQuantity = $_POST['product_quantity'];

        // Update product details and quantity in the database
        $sql = "UPDATE product SET pName='$productName', price='$productPrice', category='$productCategory', quantity=quantity+'$productQuantity' WHERE pId='$productId'";
        if (mysqli_query($conn, $sql)) {
            ?>
            <script>
                alert('Product Updated Successfully')
            </script>
            <?php
                header("Location: Products.php");
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
            $productQuantity = $row['quantity'];
            $productImage = base64_encode($row['pImage']);
        } else {
            ?>
            <script>
                alert('No product found')
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
                    <input type="text" class="form-control" name="product_name" value="<?php echo isset($row['pName']) ? $row['pName'] : ''; ?>" required>
                </div>
                <div>
                    <label for="product_price" class="form-label">Update Product Price</label>
                    <input type="text" class="form-control" name="product_price" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="product_category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="product_category" required>
                    <option selected>Open this select menu</option>
                    <option value="Sweet">Sweet</option>
                    <option value="Farshan">Farshan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="product_image" class="form-label">Update Image</label>
                <input type="file" class="form-control" name="product_image" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="product_quantity" class="form-label">Update Available Quantity</label>
                <input type="text" class="form-control" name="product_quantity" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success">UPDATE PRODUCT</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>

