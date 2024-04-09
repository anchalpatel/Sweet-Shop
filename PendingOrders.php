<?php
    include 'Utils\Connection.php';
    
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .tbl{
            margin-top: 2rem;
        }
        button{
            border: none;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        i{
            align-self: center;
        }
    </style>
  </head>
  <body>
    <?php
        require("Utils\Navbar.php");
    ?>
    <div class="container col-md-10 mt-4">
        <form action="OrderHandling.php" method="POST">
            <table id="myTable" class="table-bordered">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Token</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Products</th>
                        <th>Accept</th>
                        <th>Reject</th>
                        <th>Delivered</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $date = date("Y-m-d");
                        $sql = "SELECT `oId`, `oName`, `uId`, `number`, `price`, `deliveryDate`, `token`, `pQuantity`, `status` FROM `orders` WHERE `status` = 'Pending' OR `status`='Accepted' OR `status` = 'Rejected' AND `deliveryDate` = '$date'";
                        $result = mysqli_query($conn, $sql);

                        $srNo = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $uId = $row['uId'];
                            $uDate = "SELECT `uId`, `uName`, `email`, `mobileNumber` FROM `user` WHERE `uId` = $uId";
                            $res = mysqli_query($conn, $uDate);
                            $data = mysqli_fetch_assoc($res);

                            $status = $row['status'];
                            echo '
                                
                                <tr>
                                    <input name="pName" type="hidden" value="'.$row['oName'].'">
                                    <input name="token" type="hidden" value="'.$row['token'].'">
                                    <input name="pQuantity" type="hidden" value="'.$row['pQuantity'].'">
                                    <input name="number" type="hidden" value="'.$row['number'].'">
                                    <input name="price" type="hidden" value="'.$row['price'].'">
                                    <input name="uId" type="hidden" value="'.$data['uId'].'">
                                    <input name="oId" type="hidden" value="'.$row['oId'].'">
                                    <td>' . $srNo++ . '</td>
                                    <td>' . $row['token'] . '</td>
                                    <td>' . $data['uName'] . '</td>
                                    <td>' . $data['mobileNumber'] . '</td>
                                    <td>' . $data['email'] . '</td>
                                    <td>' . $row['oName'] . ' ' . $row['pQuantity'] . '*' . $row['number'] . '</td>
                                    <td>
                                        <button name="accept" type="submit">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button name = "reject" type="submit">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button name="delivered" type="submit"><i class="fa-solid fa-truck"></i></button>
                                    </td>
                                    <td>' . $status . '</td>

                                </tr>
                               
                            ';
                        }
                    ?>
                </tbody>
            </table>
            
        </form>
       
    

    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/8effadc23e.js" crossorigin="anonymous"></script>
    
    
    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
    } );
    </script>
  </body>
</html>
