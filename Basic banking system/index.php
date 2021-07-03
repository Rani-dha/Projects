<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Spark Bank</title>
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
                        <a class="nav-link active" href='#'> Home </a>
                    </li>
                    <li>
                        <a class="nav-link" href='customer.php'> Customers </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container" style="margin-top:5%;">
        <div>
            <div class="row ">
                <img class="d-block d-sm-block d-md-block d-lg-none" src="bank.jpg" alt="bank image">
                <h5 style="margin-top:0%;"> <em> About us</em></h5>
                <p class=" lead col-md-12 col-lg-5 col-xs-12 float-start">
                    The Spark Foundation Bank is an Indian multinational, public sector banking and financial services company.
                    It is the third largest public sector bank in India, with 131 million customers,
                    a total business of US$218 billion, and a global presence of 100 overseas
                    offices<a href="https://www.thesparksfoundationsingapore.org/join-us/internship-positions/"> to know more...</a><br /></p>
            </div>
            <img class="col-md-5 float-end d-none d-lg-block" style="margin-top:-20%; width:55%" src="bank.jpg" alt="bank image">
        </div>
    </div>
        <!-- Include every Bootstrap JavaScript plugin and dependency with one of our two bundles.
     Both bootstrap.bundle.js and bootstrap.bundle.min.js include Popper for our tooltips and popovers. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>