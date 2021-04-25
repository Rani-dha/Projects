<?php
require_once "pdo.php";


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <li class="nav-item text-white "><a class="nav-link" href="customer.php">Customers</a></li>
                    <li class="nav-item text-white active"><a class="nav-link" href="#">Transfer Money</a></li>

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
                    <li class="breadcrumb-item "><a href="./customer.php">Customer</a></li>
                    <li class="breadcrumb-item active">Transfer money</li>
                </ol>
            </div>


            <div class="mt-30">
            </div>


            <?php


            $stmt = $pdo->prepare("SELECT * FROM `customer` where email_id = ':email'");
            $stmt->bindParam(':email', $email);
            $email = $_GET['email_id'];
            $stmt->execute();


            $stmtt = $pdo->query("SELECT id, email_id FROM customer");
            $rows = $stmtt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <?php

            $clicked = $_GET['email_id'];
            ?>


            <center>
                <form class="form-horizontal" action="send.php" method="post">


                    <div class="form-group row">

                        <label class="col-form-label col-md-3 offset-md-2" for="sendto"><b>Send to</b></label>
                        <select class="form-control col-sm-4" name="sendto">
                            <?php
                            foreach ($rows as $row) { ?>
                                <option value="<?php echo $row['email_id']; ?>"><?php echo $row['email_id']; ?>
                                <?php } ?>

                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 offset-md-2" for="amount"><b>Amount to be transfered</b></label>
                        <input class="form-control col-sm-4" type="number" name="amount" required />
                    </div>

                    <input type="hidden" name="sender" value="<?= $clicked ?>" />

                    <div class="form-group row">
                        <label class="col-md-3 offset-md-2"></label>
                        <div class=" col-sm-offset-3">
                            <button class="btn btn-info btn-sm text-white" name="submit_button" type="submit">Send money</button>
                        </div>
                    </div>
                </form>
            </center>
</body>

</html>