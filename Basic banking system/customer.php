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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
      <!-- <img  class="d-none d-sm-none d-md-none d-lg-block" src="spark.png" style="width:5%; height:5%;"> visible in lg and above screens -->
      <a href="#" class="navbar-brand text-white" style="margin-left: 3%;"> The Spark Foundation</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toogleMobileMenu" aria-controls="toogleMobileMenu" aria-expanded="false" aria-label="Toogle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse  navbar-collapse" id="toogleMobileMenu">
        <ul class="navbar-nav ms-auto text-center" style="margin-right: 3%;">
          <li>
            <a class="nav-link" href='index.php'> Home </a>
          </li>
          <li>
            <a class="nav-link active" href='#'> Customers </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Customers</li>
      </ol>
    </nav>

    <table class="table table-hover" style="margin: 5px 0px 100px 0px;">
      <tr>
        <td><b> ID</b></td>
        <td><b> Customer name</b></td>
        <td><b> Email Id</b></td>
        <td><b> Balance</b></td>
      </tr>
      <?php
      foreach ($rows as $row) {
        echo "<tr><td>";
        echo ($row['id']);
        echo ("</td><td>"); ?>
        <a style="color:black;" href="transfer.php?email_id=<?php echo $row["email_id"]; ?>">
          <?php echo $row['customer_name']; ?>
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

    <!-- Include every Bootstrap JavaScript plugin and dependency with one of our two bundles.
     Both bootstrap.bundle.js and bootstrap.bundle.min.js include Popper for our tooltips and popovers. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>