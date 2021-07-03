<?php
require_once "pdo.php";
session_start();

if (!isset($_GET['email_id'])) {
    header("location: customer.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer money</title>
    <!-- Bootstrap Font Icon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Sweet alert Js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                        <a class="nav-link" href='customer.php'> Customers </a>
                    </li>
                    <li>
                        <a class="nav-link active" href='#'> Tranfer money</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <center>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="customer.php">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transfer Money</li>
                </ol>
            </nav>

            <?php
            $stmt = $pdo->prepare("SELECT * FROM `customer` where email_id = ':email'");
            $stmt->bindParam(':email', $email);
            $email = $_GET['email_id'];
            $stmt->execute();

            $stmtt = $pdo->query("SELECT id, email_id FROM customer");
            $rows = $stmtt->fetchAll(PDO::FETCH_ASSOC);
            $clicked = $_GET['email_id'];
            ?>

            <form class="form-horizontal " action="send.php" method="post">
                <div class="form-group mb-3 row ">
                    <label class="col-sm-4 col-form-label" for="sendto"><b>Send to</b></label>
                    <div class="col-sm-8">
                        <select name="sendto" class="form-control">
                            <?php
                            foreach ($rows as $row) { ?>
                                <option value="<?php echo $row['email_id']; ?>"><?php echo $row['email_id']; ?>
                                <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3 row ">
                    <label class="col-sm-4 col-form-label" for="amount"><b>Amount to be transfered</b></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="number" name="amount" required />
                    </div>
                </div>

                <input type="hidden" name="sender" value="<?= $clicked ?>" />

                <div class="form-group mb-3 row ">
                    <div class="sendbtnAlign">
                        <button class="btn btn-primary btn-sm text-white" name="submit_button" type="submit">Send money</button>
                    </div>
                </div>

            </form>
        </div>
    </center>
    <!-- Include every Bootstrap JavaScript plugin and dependency with one of our two bundles.
     Both bootstrap.bundle.js and bootstrap.bundle.min.js include Popper for our tooltips and popovers. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>