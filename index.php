<?php
require("Utils\Connection.php");
session_start();
?>
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
  <title>Crowd Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    .btn {

      margin-top: 23px;
      margin-bottom: 23px;
    }

    img {
      height: 25rem;
      width: 100%;
      margin-top: 43px;
    }

    .image {
      height: 200px;
      width: 250px;
      margin-right: 20px;

    }

    .image_gallary {
      margin-left: 236px;
    }

    .custom-bg {
      background-image: url('images/heroSection/Hero_BG.png');
    }
    .navbar {
      background-color: #EDA43D;
      color: white;
    }
    .auth {
      background-color: #198754;
      border: none;
      color: white;
      padding: 0.5rem 1rem; /* Adjusted padding for better button size */
      border-radius: 0.5rem; /* Added border-radius for rounded corners */
    }
    .buttonDiv:hover {
      background-color: #EDA43D;
     
    } 
    button:hover{
      color: white;
      background-color: #EDA43D;
    }
  </style>
</head>

<body>
<?php
  require("Utils\Connection.php");
  //session_start(); // Uncomment if session is used elsewhere
?>
<nav class="navbar shadow-md flex justify-between items-center fixed top-0 w-full">
  <div class="ml-8 md:ml-24">
    <ul class="flex space-x-4 mt-2 font-medium">
     
      <li>
        <a href="index.php" class="text-white hover:no-underline">Home</a>
      </li>
      <li>
        <a href="Products.php" class="text-white hover:no-underline">Products</a>
      </li>
      <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
          echo '
            <li>
              <a href="stockProfit.php" class="text-white hover:no-underline">Profits & Stock</a>
            </li>
            <li>
              <a href="PendingOrders.php" class="text-white hover:no-underline">Pending Orders</a>
            </li>
          ';
        }
      ?>
    </ul>
  </div>

  <div class="mr-8 md:mr-24">
    <div class="flex items-center space-x-2">
      <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer') {
          echo '
            <a href="Cart.php" class="text-white hover:no-underline px-2 py-1 rounded-md">
              <i class="fa-solid fa-cart-shopping"></i>
            </a>
          ';
        }
      ?>
      <?php
        if (isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] === true) {
          echo '
            <a href="profile.php" class="text-white hover:no-underline px-2 rounded-md">
              <i class="fa-solid fa-user"></i>
            </a>
          ';
        }
      ?>
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



  <section class="flex flex-col gap-5">

    <div class="hero-section custom-bg bg-cover bg-center h-[500px] border w-full flex justify-around items-center text-center">
      <div class="hero-content w-[50%] flex flex-col justify-center items-center gap-4">
        <p class="text-yellow-950 mb-4 text-2xl font-light font-petrona leading-8 uppercase">
          ALL TIME FAVOURITE
        </p>
        <div class="text-center text-yellow-950 text-4xl font-light font-petrona leading-8 w-2/3">Where Tradition Meets Passion In Every Bite.</div>
        <a href="products.php"><button class="no-underline text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md transition duration-300 ease-in-out">View All</button></a>
      </div>
      <div class="hero-image">
        <img src="images/bg3-removebg-preview.png" class="w-[500px] h-[500px] my-auto">
      </div>
    </div>





    <!-- HEro section -2 -->
    <div class="flex justify-center items-center">
      <div class="About flex items-center justify-center gap-10 bg-white rounded-xl">
        <img class="w-1/2 h-full" src="images/heroSection/Herosection_2.png" alt="Assorted Sweet Food" />
        <div class="w-1 h-80 bg-black"></div>
        <div class="flex gap-2">
          <div class="ml-20 w-1/2 flex flex-col gap-8">
            <div class="text-start text-yellow-950 text-2xl font-light font-petrona leading-8">Experience Kalya Delectable Ensemble. Savor the Taste of Royal India.</div>
            <div class=" text-start text-zinc-600 text-sm font-normal font-inter leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
          </div>
        </div>
      </div>
    </div>

    <!-- New Arrivales -->
    <div class="flex justify-center items-center">
  <div class="relative flex flex-col gap-10">
    <div>
      <p class="text-center text-yellow-950 text-3xl font-extralight leading-relaxed">New Arrivals</p>
    </div>
    <div class="flex justify-center items-center gap-10">
      <?php
      // Your PHP code to fetch images from the database
      require('Utils/Connection.php'); // Adjust the path as per your file structure
      
      $query = "SELECT pImage,pName,price FROM product LIMIT 4";
      $result = mysqli_query($conn, $query);
      
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $imageData = base64_encode($row['pImage']);
          $src = 'data:image/jpeg;base64,'.$imageData;
          $price=$row['price'];
          $pName=$row['pName'];
          echo '
          <div class="w-80 bg-zinc-300 h-auto shadow-lg rounded-lg overflow-hidden">
            <div class="relative">
              <img class="w-full h-80 object-cover rounded-t-lg" src="'.$src.'" alt="Product Image" />
            </div>
            <div class="bg-black text-white px-4 py-2 flex justify-between items-center">
            <div class="text-base font-normal font-inter">'.$pName.'</div>
              <div class="text-base font-normal font-inter">₹'.$price.'</div>
             
            </div>
          </div>';
        }
      } else {
        echo "No images found.";
      }
      
      // Close the database connection
      mysqli_close($conn);
      ?>
    </div>
    <div class="m-auto buttonDiv">
    <a href="products.php"><button class="no-underline text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md transition duration-300 ease-in-out">View All</button></a>
    </div>
  </div>
</div>


    <!-- Categories -->
    <div class="flex flex-col mb-4">
      <!-- Categories -->
      <div class="text-yellow-950 text-center text-3xl mb-4 font-extralight font-petrona capitalize leading-relaxed">categories</div>
      <div class="flex mx-auto gap-4">

       
        <!-- Sweets -->
        <div class="w-80  flex flex-col border p-4 rounded-lg shadow-md">
          <img class="w-56 h-56 rounded-full mx-auto mb-4" src="images/heroSection/Sweet.png" alt="Dry fruits image" />
          <div class="text-center">
            <h3 class="text-xl no-underline font-semibold font-petrona capitalize mb-2">Sweets</h3><a href="products.php"><button class="no-underline text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md  hover:text-white transition duration-300 ease-in-out">View All</button></a>
          </div>
        </div>
        <div class="w-80  flex flex-col border p-4 rounded-lg shadow-md">
          <img class="w-56 h-56 rounded-full mx-auto mb-4" src="images/heroSection/Farsan.png" alt="Dry fruits image" />
          <div class="text-center">
            <h3 class="text-xl no-underline font-semibold font-petrona capitalize mb-2">Farsan</h3>
            <a href="products.php"><button class="no-underline text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md hover:text-white transition duration-300 ease-in-out">View All</button></a>
          </div>
        </div>
     
      </div>
    </div>
  </section>

  <?php
  require('Utils\Footer.php');
  ?>

  <script src="https://kit.fontawesome.com/8effadc23e.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>