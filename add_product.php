<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
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
        .form-label {
            font-weight: bold;
        }
        .custom-input {
            background-color: #EAB76F;
        }
        .btn {
            margin-left: 50%;
            transform: translateX(-50%);
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
    require ("Utils\Connection.php");
    require("Utils\Navbar.php");

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_category = $_POST['product_category'];
        $product_quantity = $_POST['product_quantity'];
    
        // Check if a file is uploaded
        if (isset($_FILES['product_image'])) {
            $image = $_FILES['product_image']['tmp_name'];
            $imageData = file_get_contents($image);
        } else {
            // Handle the case where no image is uploaded
            $imageData = null;
        }
    
        // Insert data into the database, including the image data
        $insertQuery = "INSERT INTO product (pName, price, category, pImage, quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
    
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssssb", $product_name, $product_price, $product_category, $imageData, $product_quantity);
    
        // Execute the query
        $result = mysqli_stmt_execute($stmt);
    
        // Check if the insertion was successful
        if ($result) {
            // Redirect to a success page or display a success message
            echo '
                <script>window.location.href = "Products.php";</script>
            ';
            
            exit;
        } else {
            // Display an error message
            echo "Product could not be added.";
        }
        // Close the statement
        mysqli_stmt_close($stmt);
    }
?>
        <div class="main-div">
        <h1 class="heading">ADD PRODUCT</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 flex">
                <div>
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" required>
                </div>
                <div>
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="text" class="form-control" name="product_price" required>
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
                <label for="product_image" class="form-label">Image</label>
                <input type="file" class="form-control" name="product_image" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="product_quantity" class="form-label">Available Quantity</label>
                <input type="text" class="form-control custom-input" name="product_quantity" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success">ADD PRODUCT</button>
        </form>
    </div>

    <script src="script.js"></script>

    <script src="script.js"></script>
</body>
</html>
