
<?php
    if(isset($_POST['login'])){
        header('location:login.php');
    }
    if(isset($_POST['signup'])){
        header('location:signup.php');
    }
    if(isset($_POST['logout'])){
        session_start();
        session_unset();
        session_abort();
        header("location: login.php");
        exit;
      
    }
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
        .nav{
            background-color: #EDA43D;
            color: white;
        }
        .buttonContainer{
            display: flex;
            gap: 1rem;
        }

        .auth{
            background-color: #198754;
            border: none;
            color: white;
            padding: 0.2rem 1rem;
        }
        .cnt{
            display: flex;
            gap: 2rem;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
  <body>
  <?php
        require("Utils\Connection.php");
        //session_start();
    ?>
<nav class="navbar navbar-expand-lg nav">
  <div class="container-fluid col-md-10">
    <a class="navbar-brand" href="index.php">
        <i class="fa-solid fa-house" style="color:white"></i>
    </a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="color:white" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Products.php" style="color:white">Products</a>
        </li>
      
        <?php
                    if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
                        echo '
                            <li>
                                <a  class="nav-link" href="stockProfit.php" style="color:white" style="text-decoration: none;color: white;">Profits & Stock</a>
                            </li>
                            <li>
                                <a  class="nav-link" href="PendingOrders.php" style="color:white" style="text-decoration: none;color: white;">Pending Orders</a>
                            </li>
                        ';
                    }
                ?>
        
      </ul>
      <div class="cnt">
    <div>
        <?php
            if(isset($_SESSION['role']) && $_SESSION['role'] === 'customer'){
                echo '
                    <a href="Cart.php" style="text-decoration: none;color: white; margin-right: 10px;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                ';
            }
        ?>

        <?php
            if(isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] === true){
                echo '
                    <a href="profile.php" style="text-decoration: none;color: white; margin-left: 10px;">
                        <i class="fa-solid fa-user"></i>
                    </a>
                ';
            }
        ?>

    </div>

    <div>
        <?php
            if(!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] === false){
                echo '
                    <form action="" method="POST">
                        <div class="buttonContainer">
                            <button name="signup" class="auth rounded">SignUp</button>
                            <button name="login" class="auth rounded">Login</button>
                        </div>
                    </form>
                ';
            }
            else{
                echo '
                    <form action="" method="POST">
                        <button name="logout" class="auth rounded">Logout</button>
                    </form>
                ';
            }
        ?>
    </div>
</div>

  </div>
</nav>
    <script src="https://kit.fontawesome.com/8effadc23e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>





