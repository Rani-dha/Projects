<?php
require_once "pdo.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Transfer money</title>
    <link rel="stylesheet" href="/styles/style.css">
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        tr,td {
            padding: 20px;
        }
    </style>

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
            <!-- <img src= "spark.png" style = "width:30px; height:25px; margin-right:40px;"> -->
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item text-white"><a class="nav-link" href="index.php"><span style="margin-right:5px;" class="fa fa-home fa-lg"></span>Home</a></li>
                    <li class="nav-item text-white "><a class="nav-link" href="customer.php">Customers</a></li>
                    <li class="nav-item text-white active"><a class="nav-link" href="#">Transfer Money</a></li>
                    <!-- <li class="nav-item text-white"><a class="nav-link" href="transaction.php"><span class="fa fa-address-card fa-lg"></span>Transaction</a></li> -->
                </ul>

            </div>
        </div>
    </nav>
    <p class="text-info" style="margin-top: 60px"></p>

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
            <center>
                <h5><b>Insufficient balance </b></h5>
            </center>
        <?php return;
        }
        if ($stmt->execute()) {
            $pdo->commit();

            echo ("<center> <h5><b>Transaction ");
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
            echo ("successfull!! </b></h5></center>");
        }

        ?>
        <?php
        $stmt = $pdo->prepare("SELECT id, customer_name, email_id, balance FROM customer where email_id= :em3");
        $stmt->execute(['em3' => $receiver]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <center>
            <table border=1 class="center border border-info text-center">
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


        </boby>

</html>