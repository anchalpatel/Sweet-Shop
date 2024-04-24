<?php
    require("Utils\Connection.php");
    
    $tPrice = 0;
    session_start();
    // session_destroy();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="Cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .crd {
            display: flex;
            gap:15px;
            align-items: center;
            justify-content: space-between; /* Adjust alignment */
            margin-top: 15px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
        }

        .content {
            flex: 1; /* Let the content take remaining space */
            gap:10px;
        }

        .img {
            flex-shrink: 0; /* Prevent image from shrinking */
            margin-top: 0; /* Remove extra margin */
        }

        .buyAll {
            display:flex;
            margin-top: 20px; /* Add margin to the button */
            justify-content:center;
            margin-bottom:20px;
        }

        .total_amt{
            display:flex;
            justify-content:center;
        }

        .title{
            color: #198754;
        }
    
        .mainContainer{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        .cardContainer{
            display: flex;
            flex-direction: column;
            flex-wrap: wrap-reverse;
            gap: 1.2rem;
        }
        input[type="date"] {
            width: 200px; /* Set the desired width */
        }
    </style>
  </head>
  <body>
  <?php
        require('Utils\Navbar.php');
        require("Utils\Connection.php");    
    ?>
    <h1 class="text-center fw-bold mt-4" style="color:#EDA43D;">CART</h1>
    <div class="container col-md-10 mainContainer" style="display:flex; flex-direction:column; justify-content:space-between;">
        <div class="container cardContainer" style="gap:10px;"></div>
            <?php
                if(isset($_SESSION['uId']) && isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin']==true){
                    $sql = "SELECT p.pId, p.pName, p.price, p.pImage, p.quantity, c.pQuantNum
                    FROM cart c
                    JOIN product p ON c.productId = p.pId
                    WHERE c.userId = '{$_SESSION['uId']}'";
                    $result = mysqli_query($conn, $sql);
                    
                    foreach($result as $value){
                        $fPrice = $value['price'];
                        if($value['quantity']==500){
                            $fPrice = $value['price']/2;
                        }
                        else if($value['quantity']==250){
                            $fPrice = $value['price']/4;
                        }
                    
                        $fPrice = $fPrice * $value['pQuantNum'];
                        $pid = $value['pId'];

                        $sql = "SELECT * FROM `product` WHERE `pId`= $pid";
                        $result = mysqli_query($conn, $sql);

                        $tPrice += $fPrice;
                        $image = $value['pImage'];
                        echo '
                        <form action="AddToCart.php" method="POST">
                            <div class="crd">
                                <div class="d-flex flex-column content">
                                    <input type="hidden" name="pPrice" value="'.$value['price'].'"></input>
                                    <input type="hidden" name="pQuantity" value="'.$value['quantity'].'"></input>
                                    <div name="name" class="title text-center fs-3 fw-bold">'.$value['pName'].'</div>
                                    <div class="d-flex fw-semibold mt-3">Quantity : <input name="quantity" style="width: 70px; border:none; outline:none margin-left:1.5rem;" value="'.$value['pQuantNum'].'"></input></div>
                                    <input name="deliveryDate" type="date" value="<?php echo date('.'d-m-y'.')?>">
                                    <div class="d-flex fw-semibold">
                                        <div>Final Price : </div><input type="text" name="price" class="fw-semibold" style="border:none; outline:none;"  value="'.$fPrice.'"></input>
                                    </div>
                                    
                                    <div>
                                        <button name="buy" class="btn rounded" style="padding: 0.3rem 1.5rem; color:white; background-color: #198754">Buy</button>
                                        <button name="remove" class="btn rounded" style="padding: 0.3rem 1.5rem; color:white; background-color: #198754">Remove</button>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <img name="pImage" src="data:image/jpeg;base64,'.base64_encode($value['pImage']).'" alt="" height="200rem" width="200rem" class="rounded mt-4 img">
                                    <div name="price" class="fw-bold mt-2">Price : ₹'.$value['price'].'/kg</div>
                                </div>
                            </div>
                            <input value="'.$value['pId'].'" name="id" style="opacity:0;"></input>
                        </form>
                        
                    ';
                    }
                }

                else{
                    echo '<div class="text-center">Cart Is Empty</div>';
                }
            ?>

            
        </div>

        <div class="d-flex flex-column final" style="margin-top:2rem; margin-bottom:8px; align-self:center;"></div></div>
            <?php
                echo '
                    <div class="total_amt fw-bold" >Total Amount : '.$tPrice.'/-</div>
                    <div class="buyAll">
                        <button class="btn rounded"  style="padding: 0.3rem 1.5rem; color:white; background-color: #EDA43D;">Buy All</button>
                    </div>

                ';
            ?>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  </body>
</html>