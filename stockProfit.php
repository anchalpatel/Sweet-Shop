<?php
    require ("Utils\Connection.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .product_card {
            background-color: #EEEBEB;
            margin: 50px 0px 0px 30px;
            border-radius: 20px;
            padding-left: 15px;
        }
        #profit{
            float: right;
            margin-top: 30px;
            margin-right: 50px;
        }
    </style>
</head>

<body>
    <?php
        require('Utils\Navbar.php');
    ?>

<?php
   

    // Define the SQL query to fetch data
    $sql = "SELECT pName, stock, orders.price, sold, nvl(sum(pPrice),0) as profit FROM orders left join product using (pId) group by pName, stock, price, sold ORDER BY stock desc";
    // $sql = "SELECT p.pName, p.stock, o.pPrice, o.pQuantity FROM product p join orders o on p.pId = o.pId ORDER BY p.stock desc";

    // Execute the query
    $result = mysqli_query($conn, $sql);
    

    // Check if the query was successful
    if ($result) {
        // Loop through the result set and fetch data
        $total_profit = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $total_profit += $row['profit'];
            echo '
            <div class="card w-50 product_card">
                <div class="card-body">
                    <h2 class="card-title">' . $row['pName'] . '</h2>
                    <p class="card-text">Stock: ' . $row['stock'] . ' kg</p>
                    <p class="card-text">Price: ₹ ' . $row['price'] . '</p>
                    <p class="card-text">Quantity Sold: ' . $row['sold'] . ' kg</p>
                    <p class="card-text">Profit: ₹ ' . $row['profit'] . '</p>
                </div>
            </div>';
        }
       
        echo '<h1 id="profit"> Total Profit : '. $total_profit . '</h1>';
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the database connection
   
    ?>
    
</body>

</html>