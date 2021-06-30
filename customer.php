<?php
require_once "pdo.php";

$stmt = $pdo->query("SELECT id, customer_name, email_id, balance FROM customer");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transfer money</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Bootstrap Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
  
  <style>
    * {
      font-family: Arial, Helvetica, sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    td {
      text-align: center;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #DCDCDC	;
    }

    /* #17a2b8 */
  </style>


</head>

<body>
<nav class="navbar navbar-dark navbar-expand-sm fixed-top bg-primary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a style="font-size:150%;" class="navbar-brand mr-auto" href="index.php"><i style="font-size:30px;" class="bi  bi-bank2"></i> Spark Bank </a>
            <!-- <img src= "spark.png" style = "width:30px; height:25px; margin-right:40px;"> -->
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav ml-auto" style="font-size:120%;">
                    <li class="nav-item text-white"><a class="nav-link" href="index.php"><span style="margin-right:5px;"></span>Home</a></li>
                    <li class="nav-item text-white "><a class="nav-link" href="customer.php">Customers</a></li>
                    <li class="nav-item text-white active"><a class="nav-link" href="#">Transfer Money</a></li>

                </ul>

            </div>
        </div>
    </nav>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
  
  <center>
  
    <p class="text-info" style="margin-top: 6%"></p>

    <div class="container">
      <div class="row align-items-center">
        <ol class="col-12 breadcrumb">
          <li class="breadcrumb-item "><a href="./index.php">Home</a></li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
      </div>
      <table class="border border-primary" style="margin: 5px 0px 100px 0px; width:60%; height:30%;">
        <tr>
          <td> <b>ID</b></td>
          <td><b>Customer name</b></td>
          <td><b>Email Id</b></td>
          <td><b>Balance</b></td>
        </tr>
        <?php
        foreach ($rows as $row) {
          echo "<tr><td>";
          echo ($row['id']);
          echo ("</td><td>"); ?>
          <a style="color:black;" href="transfer.php?email_id=<?php echo $row["email_id"]; ?>">
            <?php echo $row["customer_name"]; ?>
          </a>
        <?php
          //echo($row['customer_name']);
          echo ("</td><td>");
          echo ($row['email_id']);
          echo ("</td><td>");
          echo ($row['balance']);
          echo ("</td></tr>\n");
        }
        ?>


      </table>
  </center>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>