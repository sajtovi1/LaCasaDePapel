<?php
require 'sesija.php';

$nazivEpizode = trim($_POST['nazivEpizode']);
$brojEpizode = trim($_POST['brojEpizode']);
$sezonaID = trim($_POST['sezonaID']);
$review = trim($_POST['review']);
$ocena = trim($_POST['ocena']);

$epizode = $baza->usesiEpizodu($nazivEpizode, $brojEpizode, $sezonaID, $review, $ocena);

