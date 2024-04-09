<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crowdmanagement";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if($conn)
    {
        ?>
        <!-- <script>
            alert("Connection successfully");
        </script> -->
        <?php
    }
    else
    {
        ?>
        <script>
            alert("No connection");
        </script>
        <?php
    }



?>