<?php

require 'sesija.php';

$sezone = $baza->vratiSveSezone();


if(isset($_POST['izmeni'])){
    $epizodaIzmena = $_POST['epizodaIzmena'];
    $ocenaIzmena = $_POST['ocenaIzmena'];

    $baza->izmeni($epizodaIzmena, $ocenaIzmena);
}

if(isset($_POST['brisanje'])){
    $epizodaBrisanje = $_POST['epizodaBrisanje'];

    $baza->obrisi($epizodaBrisanje);
}


$epizode = $baza->pretraziSveEpizode(0,'asc');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>La Casa De Papel</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

        <nav id="navbar" class="navbar">
            <ul>
                <li>Sve o vasoj omiljenoj seriji</li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>

<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1>Ocene epizoda i review</h1>
                <h2>Mali podsetnik o tome kako sam ocenio epizode posto sam odgledao</h2>
                <br/>

                <?php
                    if($_SESSION['planUToku']){
                        ?>
                        <a href="zaustaviPlan.php" class="btn btn-primary">Zaustavi plan </a>
            <?php
                    }else{
                        ?>
                        <form action="" method="post">
                            <label for="nazivPlana">Naziv Plana</label>
                            <input type="text" name="nazivPlana" id="nazivPlana" class="form-control">
                            <hr>
                            <button type="submit" name="plan" class="btn btn-primary">Pokreni plan</button>
                        </form>
                <?php
                    }
                ?>

            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
                <img src="assets/img/slika.jpeg" class="img-fluid" alt="">
            </div>
        </div>
    </div>

</section>

<main id="main">

    <section id="services" class="services section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Epizode</h2>
                <p>Pretraga, unos, promena, i brisanje svakog review-a </p>
            </div>

            <div class="row">

                <div class="col-6">
                    <label for="pretraga">Pretrazi po sezoni</label>
                    <select class="form-control" id="pretraga">
                        <option value="0">Sve sezone</option>
                        <?php
                        foreach ($sezone as $sezona){
                            ?>
                            <option value="<?= $sezona->sezonaID; ?>">Sezona: <?= $sezona->nazivSezone; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6">
                    <label for="sortiranje">Sortiraj po oceni</label>
                    <select id="sortiranje" class="form-control">
                        <option value="asc">Rastuce</option>
                        <option value="desc">Opadajuce</option>
                    </select>
                </div>
                <hr>
                <div class="col-12">
                    <button onclick="pretrazi()" class="btn btn-primary">Pretrazi</button>
                </div>

            </div>
            <div class="row">
                <div class="col-12" id="rezultat">

                </div>
            </div>

            <?php
                if($_SESSION['allowNew']){
                    ?>
                    <label for="nazivEpizode">Naziv epizode</label>
                    <input type="text" class="form-control" id="nazivEpizode">
                    <label for="brojEpizode">Broj epizode</label>
                    <input type="number" class="form-control" id="brojEpizode">
                    <label for="sezonaNew">Sezona</label>
                    <select class="form-control" id="sezonaNew">
                        <?php
                        foreach ($sezone as $sezona){
                            ?>
                            <option value="<?= $sezona->sezonaID; ?>">Sezona: <?= $sezona->nazivSezone; ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <label for="review">Review</label>
                    <input type="text" class="form-control" id="review">

                    <label for="ocena">Ocena</label>
                    <select id="ocena" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>

                    <hr>
                    <button class="btn btn-primary" onclick="unesi()">Unesi novi review</button>
            <?php
                }
            ?>

            <?php
            if($_SESSION['allowEdit']){
            ?>
                <form action="" method="post">
                <label for="epizodaIzmena">Epizoda</label>
                <select name="epizodaIzmena" id="epizodaIzmena" class="form-control">
                    <?php
                    foreach ($epizode as $epizoda){
                        ?>
                        <option value="<?= $epizoda->id; ?>"><?= $epizoda->nazivEpizode; ?></option>
                        <?php
                    }
                    ?>
                </select>

                <label for="ocenaIzmena">Nova ocena</label>
                <select name="ocenaIzmena" id="ocenaIzmena" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                    <hr>
                    <button type="submit" name="izmeni" class="btn btn-primary">Izmeni ocenu</button>
                </form>
            <?php
                }
            ?>

            <?php
            if($_SESSION['allowDelete']){
                ?>
                <form action="" method="post">
                    <label for="epizodaBrisanje">Epizoda</label>
                    <select name="epizodaBrisanje" id="epizodaBrisanje" class="form-control">
                        <?php
                        foreach ($epizode as $epizoda){
                            ?>
                            <option value="<?= $epizoda->id; ?>"><?= $epizoda->nazivEpizode; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <hr>
                    <button type="submit" name="brisanje" class="btn btn-primary">Obrisi epizodu</button>
                </form>
                <?php
            }
            ?>

        </div>
    </section>

</main>

<footer id="footer">

    <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>La Casa De Pape team</span></strong>. All Rights Reserved
        </div>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/jquery.js"></script>

<script>
    function pretrazi() {
        let pretraga = $("#pretraga").val();
        let sortiranje = $("#sortiranje").val();

        $.ajax({
            url: "pretrazi.php",
            data: {
                pretraga : pretraga,
                sortiranje : sortiranje
            },
            success: function (podaci) {
                $("#rezultat").html(podaci);
            }
        });
    }

    pretrazi();

    function unesi() {
        let nazivEpizode = $("#nazivEpizode").val();
        let brojEpizode = $("#brojEpizode").val();
        let sezonaID = $("#sezonaNew").val();
        let review = $("#review").val();
        let ocena = $("#ocena").val();

        $.ajax({
            url: "unesi.php",
            type: 'post',
            data: {
                nazivEpizode : nazivEpizode,
                brojEpizode : brojEpizode,
                sezonaID: sezonaID,
                review : review,
                ocena: ocena
            },
            success: function (podaci) {
                pretrazi();
            }
        });
    }
</script>

</body>

</html>

