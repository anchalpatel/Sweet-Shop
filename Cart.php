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
        .crd{
            display: flex;
        
            align-items: center;
            gap: 7rem;
            margin-top: 2rem;
            
        }
        .content{
            gap: 0.8rem;
        }
        .title{
            color: #198754;
        }
        .img{
            margin-top: 3rem;
        }
        .buyAll{
            
            color: white;
            background-color: #198754;
            padding: 0.5rem 3rem;
            border: none;
            font-size: 0.7rem;
        }
        .mainContainer{
            display: flex;
            flex-direction: row;
            justify-content: space-between;

        }
        .cardContainer{
            display: flex;
            flex-direction: column;
            flex-wrap: wrap-reverse;
            gap: 1.2rem;
        }
    </style>
  </head>
  <body>
  <?php
        require('Utils\Navbar.php');
    ?>
    <h1 class="text-center fw-bold mt-4" style="color:#EDA43D;">CART</h1>
    <div class="container col-md-10 mainContainer" style="display:flex; flex-direction:column; justify-content:space-between;">
        <div class="container cardContainer" style="gap:10px;"></div>
            <?php
                if(isset($_SESSION['cart'])){
                    
                    foreach($_SESSION['cart'] as $value){
                        $fPrice = $value['pPrice'];
                        if($value['quantity']==500){
                            $fPrice = $value['pPrice']/2;
                        }
                        else if($value['quantity']==250){
                            $fPrice = $value['pPrice']/4;
                        }
                    
                        $fPrice = $fPrice * $value['number'];
                        $pid = $value['id'];

                        $sql = "SELECT * FROM `product` WHERE `pId`= $pid";
                        $result = mysqli_query($conn, $sql);

                        $tPrice += $fPrice;
                        while($row = mysqli_fetch_assoc($result)){
                            $image = $row['pImage'];
                            break;
                        }
                        echo '
                        <form action="AddToCart.php" method="POST">
                            <div class="crd">
                                <div class="d-flex flex-column content">
                                    <input type="hidden" name="pPrice" value="'.$value['pPrice'].'"></input>
                                    <input type="hidden" name="pQuantity" value="'.$value['quantity'].'"></input>
                                    <div name="name" class="title text-center fs-3 fw-bold">'.$value['pName'].'</div>
                                    <div class="d-flex fw-semibold mt-3">Quantity : <input name="quantity" style="width: 70px; border:none; outline:none margin-left:1.5rem;" value="'.$value['number'].'"></input></div>
                                    <input name="deliveryDate" type="date" value="<?php echo date('.'d-m-y'.')?>" required>
                                    <div class="d-flex fw-semibold">
                                        <div>Final Price : </div><input type="text" name="price" class="fw-semibold" style="border:none; outline:none;"  value="'.$fPrice.'"></input>
                                    </div>
                                    
                                    <div>
                                        <button name="buy" class="btn rounded" style="padding: 0.3rem 1.5rem; color:white; background-color: #198754">Buy</button>
                                        <button name="remove" class="btn rounded" style="padding: 0.3rem 1.5rem; color:white; background-color: #198754">Remove</button>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <img name="pImage" src="data:image/jpeg;base64,'.base64_encode($image).'" alt="" height="200rem" width="200rem" class="rounded mt-4 img">
                                    <div name="price" class="fw-bold mt-2">Price : ₹'.$value['pPrice'].'/kg</div>
                                </div>
                            </div>
                            <input value="'.$value['id'].'" name="id" style="opacity:0;"></input>
                        </form>
                        
                    ';
                    }
                }

                else{
                    echo '<div class="text-center">Cart Is Empty</div>';
                }
            ?>

            
        </div>

        <div class="d-flex flex-column final" style="margin-top:2rem; margin-bottom:4rem; align-self:center;"></div></div>
            <?php
                echo '
                    <div class="fw-bold">Total Amount : '.$tPrice.'</div>
                    <button class="buyAll rounded"  style="border:none; margin-top: 1rem; width:max-content;">Buy All</button>
                ';
            ?>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  </body>
</html>