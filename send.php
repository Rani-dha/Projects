<?php
session_start();
require_once "pdo.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transfer money</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Bootstrap Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        tr,
        td {
            padding: 20px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark navbar-expand-sm fixed-top bg-primary">
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
    <p class="text-primary" style="margin-top: 60px"></p>

    <div class="container">
        <div class="row align-items-center">
            <ol class="col-12 breadcrumb">
                <li class="breadcrumb-item "><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="./customer.php">Customer</a></li>
                <li class="breadcrumb-item active">Transfer money</li>
            </ol>
        </div>

        <?php

        //sender part
        $sender = $_POST['sender'];
        $q = $pdo->prepare("SELECT balance FROM customer where email_id= :emailsender");
        $q->execute(['emailsender' => $sender]);
        $senderOrginalAmount = $q->fetch();
        $senderCurrentAmount = $senderOrginalAmount['balance'];

        $pdo->beginTransaction();
        $stmt = $pdo->prepare("UPDATE customer set balance = ? where email_id =?");
        $stmt->bindParam(1, $b1);
        $stmt->bindParam(2, $e1);
        $b1 = $senderCurrentAmount - $_POST['amount'];
        $e1 = $_POST['sender'];
        if ($b1 < 0) {
        ?>
            <script>
                swal({
                    title: " Insufficient balance",
                    text: "Please enter sufficient balance",
                    icon: "error",
                    button: "Retry!!",
                });
            </script>
        <?php return;
        }
        if ($stmt->execute()) {
            $pdo->commit();
        }

        //Receiver part
        $receiver = $_POST['sendto'];
        $s = $pdo->prepare("SELECT balance FROM customer where email_id= :emailreceiver");
        $s->execute(['emailreceiver' => $receiver]);
        $receiverOriginalAmount = $s->fetch();
        $receiverCurrentAmount = $receiverOriginalAmount['balance'];

        $pdo->beginTransaction();
        $stmt = $pdo->prepare("UPDATE customer set balance = ? where email_id =?");
        $stmt->bindParam(1, $b2);
        $stmt->bindParam(2, $e2);
        $b2 =  $receiverCurrentAmount +  $_POST['amount'];
        $e2 = $_POST['sendto'];
        if ($stmt->execute()) {
            $pdo->commit();
        ?>
            <script>
                swal({
                    title: "Transaction Successful",
                    text: "Happy banking, Stay safe",
                    icon: "success",
                    button: "Aww yiss!",
                });
            </script>
        <?php }
        $stmt = $pdo->prepare("SELECT id, customer_name, email_id, balance FROM customer where email_id= :em3");
        $stmt->execute(['em3' => $sender]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <center>
            <h3> Sender Details </h3>
            <table border=1 class="center border border-primary text-center">
                <tr>
                    <td> <b>ID</b></td>
                    <td><b>Customer name</b></td>
                    <td><b>Email Id</b></td>
                    <td><b>Balance</b></td>
                </tr>
                <?php echo "<tr><td>";
                foreach ($rows as $row) {
                    echo ($row['id']);
                    echo ("</td><td>");
                    echo ($row["customer_name"]);
                    echo ("</td><td>");
                    echo ($row['email_id']);
                    echo ("</td><td>");
                    echo ($row['balance']);
                    echo ("</td></tr>");
                }
                ?>
            </table>
        </center>
        <?php
        $stmt = $pdo->prepare("SELECT id, customer_name, email_id, balance FROM customer where email_id= :em3");
        $stmt->execute(['em3' => $receiver]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <center>
            <h3 style="margin: 20px"> Receiver Details </h3>
            <table border=1 class="center border border-primary text-center">
                <tr>
                    <td> <b>ID</b></td>
                    <td><b>Customer name</b></td>
                    <td><b>Email Id</b></td>
                    <td><b>Balance</b></td>
                </tr>
                <?php echo "<tr><td>";
                foreach ($rows as $row) {
                    echo ($row['id']);
                    echo ("</td><td>");
                    echo ($row["customer_name"]);
                    echo ("</td><td>");
                    echo ($row['email_id']);
                    echo ("</td><td>");
                    echo ($row['balance']);
                    echo ("</td></tr>");
                }
                ?>
            </table>
        </center>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        </boby>

</html>