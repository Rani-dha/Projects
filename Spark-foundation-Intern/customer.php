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
  <title>Customers</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
      background-color: #36acbf;
    }

    /* #17a2b8 */
  </style>


</head>

<body>
  <nav class="navbar navbar-dark navbar-expand-sm fixed-top bg-info">

    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand mr-auto" href="index.php"></a>

      <div class="collapse navbar-collapse" id="Navbar">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item text-white"><a class="nav-link" href="index.php"><span style="margin-right:5px;" class="fa fa-home fa-lg"></span>Home</a></li>
          <li class="nav-item text-white active"><a class="nav-link" href="#">Customers</a></li>
          <li class="nav-item text-white"><a class="nav-link" href="transfer.php">Transfer Money</a></li>

        </ul>

      </div>
    </div>
  </nav>
  <center>
    <p class="text-info" style="margin-top: 60px"></p>

    <div class="container">
      <div class="row align-items-center">
        <ol class="col-12 breadcrumb">
          <li class="breadcrumb-item "><a href="./index.php">Home</a></li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
      </div>
      <table class="border border-info" style="margin: 10px 40px 40px 40px; width:60%; height:30%;">
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

          echo ("</td><td>");
          echo ($row['email_id']);
          echo ("</td><td>");
          echo ($row['balance']);
          echo ("</td></tr>\n");
        }
        ?>


      </table>
  </center>

</body>

</html>