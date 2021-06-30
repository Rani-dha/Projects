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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Bootstrap Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->

    <!-- Sweet alert Js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .navbar:hover,
        .navbar:active {
            text-decoration-style: underline;
        }

        /* X-Small devices (portrait phones, less than 576px) */
        @media (max-width: 575.98px) {
            .sendbtnAlign {
                padding-left: 35%;
            }

        }

        /* Small devices (landscape phones, less than 768px) */
        @media (max-width: 767.98px) {
            .sendbtnAlign {
                padding-left: 35%;
            }
        }
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
        <p class="text-info" style="margin-top: 80px"></p>

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
            //  $clicked = '';
            // if(isset($_POST['submit_button'])) 
            $clicked = $_GET['email_id'];
            ?>
            <center>
                <form class="form-horizontal" action="send.php" method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-xs-2 col-sm-3 col-md-3 offset-md-2 offset-xs-2" for="sendto"><b>Send to</b></label>
                        <select class="form-control form-control-sm col-xs-10 col-sm-3 col-md-4 offset-xs-1" name="sendto">
                            <?php
                            foreach ($rows as $row) { ?>
                                <option value="<?php echo $row['email_id']; ?>"><?php echo $row['email_id']; ?>
                                <?php } ?>

                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 offset-md-2" for="amount"><b>Amount to be transfered</b></label>
                        <input class="form-control form-control-sm col-sm-4" type="number" name="amount" required />
                    </div>

                    <input type="hidden" name="sender" value="<?= $clicked ?>" />

                    <div class="form-group row">
                        <label class="col-md-3 offset-md-2"></label>
                        <div class="sendbtnAlign">
                            <button class="btn btn-primary btn-sm text-white" name="submit_button" type="submit">Send money</button>
                        </div>
                    </div>
                </form>
            </center>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>





<!-- <p style = "padding: 200px;"></p>  -->
<?php
//echo $_GET['email_id'];
//echo $clicked;
?>