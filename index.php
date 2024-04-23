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
  </style>
</head>

<body>
  <?php
  // require('Utils\Navbar.php');
  ?>

  <!-- <div class="container col-md-7">
      <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">

          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>

        </div>

      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images\HomepageCrouser.jpg" class="d-block  " alt="...">
        </div>
        <div class="carousel-item">
          <img src="images\HomepageCrouser3.jpg" class="d-block " alt="...">
        </div>
        <div class="carousel-item">
          <img src="images\HomePageCrowser1.jpg" class="d-block  " alt="...">
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      
      </div>
    </div>

    <div class="text-center" style="margin-top: 20px;">
      <h2>Our Products!!</h2>
    </div>

    <div class="image_gallary">
      <?php

      $query = "SELECT pImage FROM product LIMIT 4";

      $result = mysqli_query($conn, $query);

      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<img src="data:image/jpeg;base64,' . base64_encode($row['pImage']) . '" class="image">';
        }
      } else {
        echo "No images found.";
      }

      ?>

    </div>

    <div class="text-center">
      <a href="products.php">
        <button type="submit" name="submit" class="btn btn-success">Explore More</button>
      </a>
    </div>
   -->

  <!-- Nav Bar -->
  <div class="Header py-16">
    <div class="Rectangle6 w-full h-full  bg-white"></div>
    <div class="Group2 w-full left-14 top-14">
      <ul class="Frame1 w-fit h-4 flex gap-12 mx-auto">
        <li class="Home text-yellow-600 text-sm font-normal font-['Inter'] uppercase">Home </li>
        <li class="Gifts text-yellow-950 text-sm font-normal font-['Inter'] uppercase">Gifts</li>
        <li class="Shop text-yellow-950 text-sm font-normal font-['Inter'] uppercase">Shop</li>
        <li class="AboutUs text-yellow-950 text-sm font-normal font-['Inter'] uppercase">About us</li>
        <li class="ContactUs text-yellow-950 text-sm font-normal font-['Inter'] uppercase">Contact us</li>
      </ul>
    </div>
    <!-- <div class="Group82 w-32 h-5 absolute left-60 top-12">
        <div class="MaskGroup w-5 h-5 absolute left-28 top-0">
            <img class="ShoppingCart2169842 w-5 h-5 absolute left-0 top-0" src="https://via.placeholder.com/21x21" />
            <div class="Rectangle65 w-7 h-6 absolute left-[-4px] top-[-1px] bg-yellow-950"></div>
        </div>
    </div> -->
  </div>

  <section class="flex flex-col gap-5">

    <div class="hero-section custom-bg bg-cover bg-center h-[500px] border w-full flex justify-around items-center text-center">
      <div class="hero-content w-[50%] flex flex-col justify-center items-center gap-4">
        <p class="text-yellow-950 mb-4 text-2xl font-light font-petrona leading-8 uppercase">
          ALL TIME FAVOURITE
        </p>
        <div class="text-center text-yellow-950 text-4xl font-light font-petrona leading-8 w-2/3">Where Tradition Meets Passion In Every Bite.</div>
        <button class="mx-auto text-yellow-900 text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-2 rounded-md hover:bg-yellow-900 hover:text-white transition duration-300 ease-in-out">View All</button>
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
          <div class="w-80 bg-zinc-300 h-auto shadow-lg rounded-lg overflow-hidden">
            <div class="relative">
              <img class="w-full h-80 object-cover rounded-t-lg" src="images/heroSection/new arrival1.png" alt="Product Image" />
            </div>
            <div class="bg-black text-white px-4 py-2 flex justify-between items-center">
              <div class="text-base font-normal font-inter">$350.00</div>
              <button class="border border-white bg-transparent text-white px-4 py-2 rounded-lg hover:bg-white hover:text-black hover:border-transparent transition duration-300">
                Add to cart
              </button>
            </div>
          </div>
          <div class="w-80 bg-zinc-300 h-auto shadow-lg rounded-lg overflow-hidden">
            <div class="relative">
              <img class="w-full h-80 object-cover rounded-t-lg" src="images/heroSection/new arriaval 2.png" alt="Product Image" />
            </div>
            <div class="bg-black text-white px-4 py-2 flex justify-between items-center">
              <div class="text-base font-normal font-inter">$350.00</div>
              <button class="border border-white bg-transparent text-white px-4 py-2 rounded-lg hover:bg-white hover:text-black hover:border-transparent transition duration-300">
                Add to cart
              </button>
            </div>
          </div>
          <div class="w-80 bg-zinc-300 h-auto shadow-lg rounded-lg overflow-hidden">
            <div class="relative">
              <img class="w-full h-80 object-cover rounded-t-lg" src="images/heroSection/new arrival 3.png" alt="Product Image" />
            </div>
            <div class="bg-black text-white px-4 py-2 flex justify-between items-center">
              <div class="text-base font-normal font-inter">$350.00</div>
              <button class="border border-white bg-transparent text-white px-4 py-2 rounded-lg hover:bg-white hover:text-black hover:border-transparent transition duration-300">
                Add to cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Categories -->
    <div class="flex flex-col">
      <!-- Categories -->
      <div class="text-yellow-950 text-center text-3xl mb-4 font-extralight font-petrona capitalize leading-relaxed">categories</div>
      <div class="flex mx-auto gap-4">

        <!-- Dry Fruits -->
        <div class="w-80  flex flex-col border p-4 rounded-lg shadow-md">
          <img class="w-56 h-56 rounded-full mx-auto mb-4" src="images/heroSection/Dryfruites.png" alt="Dry fruits image" />
          <div class="text-center">
            <h3 class="text-xl text-yellow-900 font-semibold font-petrona capitalize mb-2">Dry Fruits</h3>
            <button class="text-yellow-900 text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md hover:bg-yellow-900 hover:text-white transition duration-300 ease-in-out">View All</button>
          </div>
        </div>
        <!-- Sweets -->
        <div class="w-80  flex flex-col border p-4 rounded-lg shadow-md">
          <img class="w-56 h-56 rounded-full mx-auto mb-4" src="images/heroSection/Sweet.png" alt="Dry fruits image" />
          <div class="text-center">
            <h3 class="text-xl text-yellow-900 font-semibold font-petrona capitalize mb-2">Sweets</h3>
            <button class="text-yellow-900 text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md hover:bg-yellow-900 hover:text-white transition duration-300 ease-in-out">View All</button>
          </div>
        </div>
        <div class="w-80  flex flex-col border p-4 rounded-lg shadow-md">
          <img class="w-56 h-56 rounded-full mx-auto mb-4" src="images/heroSection/Farsan.png" alt="Dry fruits image" />
          <div class="text-center">
            <h3 class="text-xl text-yellow-900 font-semibold font-petrona capitalize mb-2">Farsan</h3>
            <button class="text-yellow-900 text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md hover:bg-yellow-900 hover:text-white transition duration-300 ease-in-out">View All</button>
          </div>
        </div>
        <div class="w-80  flex flex-col border p-4 rounded-lg shadow-md">
          <img class="w-56 h-56 rounded-full mx-auto mb-4" src="images/heroSection/Dryfruites.png" alt="Dry fruits image" />
          <div class="text-center">
            <h3 class="text-xl text-yellow-900 font-semibold font-petrona capitalize mb-2">Dry Fruits</h3>
            <button class="text-yellow-900 text-sm font-medium font-inter uppercase tracking-wide border border-yellow-900 px-4 py-1 rounded-md hover:bg-yellow-900 hover:text-white transition duration-300 ease-in-out">View All</button>
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