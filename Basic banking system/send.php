<?php
session_start();
require_once "pdo.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transaction</title>
    <!-- Bootstrap5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Sweet alert -->
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

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="customer.php">Customers</a></li>
                <li class="breadcrumb-item"><a href="transfer.php">Transfer Money</a></li>
                <li class="breadcrumb-item" aria-current="page">Transaction</li>
            </ol>
        </nav>

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
        $b1 = $senderCurrentAmount - $_POST['amount']; // Debit the amount from sender
        $e1 = $_POST['sender'];
        if ($b1 < 0) { // If sender mistakenly tries to send money above his/her current balance the 
            // Alert pop as Insufficient balance and redirects to customers page.        
        ?>
            <script>
                swal({
                    title: " Insufficient balance",
                    text: "Please enter sufficient amount",
                    icon: "error",
                    button: "Retry!!",
                }).then(okay => {
                    if (okay) {
                        window.location.href = "customer.php";
                    }
                });
            </script>
        <?php return;
        }
        if ($stmt->execute()) {
            $pdo->commit(); // Making permanent transaction in database. 
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
        $b2 =  $receiverCurrentAmount +  $_POST['amount']; // Credit the amount to the receiver.
        $e2 = $_POST['sendto'];

        if ($stmt->execute()) {
            $pdo->commit();  // Making permanent transaction in database. 
        ?>
            <script>
                swal({
                    title: "Transaction Successful",
                    text: "Happy banking, Stay safe",
                    icon: "success",
                    button: "Aww yiss!",
                });
            </script>
        <?php } ?>

        <div class="container">
            <div class="row row-cols-2">
                <div class="col">
                    <?php $stmt = $pdo->prepare("SELECT id, customer_name, email_id, balance FROM customer where email_id= :em3");
                    $stmt->execute(['em3' => $sender]);
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <h3> Sender </h3>
                    <table class="table">
                        <tr>
                            <td><b>Customer name</b></td>
                            <td><b>Balance</b></td>
                        </tr>
                        <?php echo "<tr><td>";
                        foreach ($rows as $row) {
                            echo ($row["customer_name"]);
                            echo ("</td><td>");
                            echo ($row['balance']);
                            echo ("</td></tr>");
                        }
                        ?>
                    </table>

                </div>
                <div class="col">
                    <?php $stmt = $pdo->prepare("SELECT id, customer_name, email_id, balance FROM customer where email_id= :em3");
                    $stmt->execute(['em3' => $receiver]);
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <h3> Receiver </h3>
                    <table class="table">
                        <tr>
                            <td><b>Customer name</b></td>
                            <td><b>Balance</b></td>
                        </tr>
                        <?php echo "<tr><td>";
                        foreach ($rows as $row) {
                            echo ($row["customer_name"]);
                            echo ("</td><td>");
                            echo ($row['balance']);
                            echo ("</td></tr>");
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- Include every Bootstrap JavaScript plugin and dependency with one of our two bundles.
        Both bootstrap.bundle.js and bootstrap.bundle.min.js include Popper for our tooltips and popovers. -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </boby>

</html>