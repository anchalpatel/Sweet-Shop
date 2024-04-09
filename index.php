
<?php
  require ("Utils\Connection.php");
  session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
      .btn{
        
        margin-top:23px;
        margin-bottom:23px;
      }
      img{
        height: 25rem;
        width: 100%;
        margin-top:43px;
      }
      .image{
        height: 200px;
        width: 250px;
        margin-right: 20px;
        
      }
      .image_gallary{
        margin-left:236px;
      }
    </style>
  </head>
  <body>
    <?php
        require('Utils\Navbar.php');
    ?>

    <div class="container col-md-7">
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
      <?Php
      
      $query = "SELECT pImage FROM product LIMIT 4";

      $result = mysqli_query($conn, $query);
      
      if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo '<img src="data:image/jpeg;base64,'.base64_encode($row['pImage']).'" class="image">';
          }
      } else {
          echo "No images found.";
      }
      
      // Close the database connection
      $conn->close();
      ?>

    </div>

    <div class="text-center">
      <a href="products.php">
        <button type="submit" name="submit" class="btn btn-success">Explore More</button>
      </a>
    </div>
   
    <script src="https://kit.fontawesome.com/8effadc23e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


  </body>
</html>