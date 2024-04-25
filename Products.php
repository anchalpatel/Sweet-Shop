<?php
require("Utils\Connection.php");
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .cd {
            transition: all 400ms ease-in;
        }

        .cd:hover {
            transform: scale(1.1);
        }

        .bt {
            transition: all 400ms ease-in;
            background-color: white;
            color: #198754;
        }

        .bt:hover {
            background-color: #198754;
            color: white;
        }

        input {
            font-weight: 800;
            border: none;
            width: fit-content;
            outline: none;
        }

        .buttonADD {
            display: flex;
            gap: 1rem;
            padding: 0.4rem 2rem;
            background-color: #198754;
            color: white;
            align-self: flex-end;
            margin-top: 2rem;
            border: none;
            font-weight: 700;
            justify-content: center;
            align-items: center;
        }
        .quantityDiv{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <?php
    require('Utils\Navbar.php');
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo '
            <div class="container col-md-10" style="display:flex; justify-content:flex-end;">
                <form action="AddTOCart.php" method="POST">
                    <button name="addProduct" class="rounded buttonADD">Add Product
                    <i class="fa-regular fa-plus"></i>
                    </button>
                </form>
            </div>';
    }
    ?>



    <div class="row mt-5">
        <div class="container col-md-10">
            <div class="row">
                <?php
                $sql = "SELECT * FROM `product` WHERE `stock` != 0";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) < 1) {
                    echo "No Product is available yet";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                       
                        echo '
                        <div class="col-3 mb-5 mt-2">
                            <form action="AddToCart.php" method="POST">
                                <div class="card cd shadow text-success" style="width: 17rem;">
                                    <!-- Product Image -->
                                    <img src="data:image/jpeg;base64,' . base64_encode($row['pImage']) . '" class="card-img-top" alt="Product Image" style="max-height: 200px; max-width: 100%;">
                                    <div class="card-body px-4">
                                        <div class="d-flex flex-row justify-content-between">
                                            <!-- Product Name -->
                                            <input type="text" readonly name="pName" style="font-weight:900;font-size:1.3rem; width:10.77rem; border:none; outline:none; color:#198754;" value="' . $row['pName'] . '"></input>
                                            <div class="d-flex flex-row align-items-center">
                                                <!-- Product Price -->
                                                <div style="font-weight:800; border:none; outline:none; color:#198754;">₹</div>
                                                <input class="fw-bold" readonly style="font-weight:800; border:none; outline:none; width:3.55rem; color:#198754;" name="pPrice" value="' . $row['price'] . '"></input>
                                            </div>
                                        </div>
                                        <!-- Hidden Input for Product ID -->
                                        <input name="id" style="display:none;" type="number" value="' . $row['pId'] . '">
                                        <div class="d-flex flex-row justify-content-between mt-2">
                                            <div class="quantityDiv">
                                                <!-- Product Quantity -->
                                                <label htmlfor="quantity">Quantity : </label>
                                                <select name="quantity" style="font-weight: 500; border: none; width: 3rem; outline: none; color: #198754;">
                                                    <option value="250">250</option>
                                                    <option value="500">500 </option>
                                               
                                            </select>
                                            </div class="quantityDiv">
                                            <!-- Quantity Input -->
                                            
                                            <input id="numberOfPrdct" style="font-weight:700; width:3rem; border:1px solid:#198754; color:#198754;" type="number" value="1" name="number" id="" step="1">
                                        </div>
                                        <div class="d-flex flex-row justify-content-between mt-2">';
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                            echo ' 
                                <!-- Admin Buttons -->
                                <button name="update" style="border:none;outline:none background-color:none; color:#198754;"><i class="fa-solid fa-pen-to-square" style="font-size: 1.2rem; margin: 1rem 1.2rem;"></i></button>
                                <button name="delete" style="border:none;outline:none background-color:none; color:#198754;"><i class="fa-solid fa-trash" style="font-size: 1.2rem; margin: 1rem 1.7rem;"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>';
                        } else {
                            echo '
                                <!-- Add To Cart Button -->
                                <button type="submit" name="addCart" class="px-4 fs-6 py-1 border border-2 border-success rounded bt" onclick="">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Footer Section -->
    <?php
    $footer_path = 'Utils\Footer.php';
    if (file_exists($footer_path)) {
        require($footer_path);
    } else {
        echo "Footer file not found!";
    }
    ?>
    <!-- Bootstrap and Font Awesome Scripts -->
    <script src="https://kit.fontawesome.com/8effadc23e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
