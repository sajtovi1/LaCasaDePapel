<?php
require 'sesija.php';

$pretraga = trim($_GET['pretraga']);
$sortiranje = trim($_GET['sortiranje']);

$epizode = $baza->pretraziSveEpizode($pretraga, $sortiranje);

$ukupnoOcena = 0.00;
$counter = 0.00;

?>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Naziv</th>
            <th>Broj epizode</th>
            <th>Sezona</th>
            <th>Review</th>
            <th>Ocena</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($epizode as $epizoda){
            $ukupnoOcena += (double) $epizoda->ocena;
            $counter++;
            ?>

            <tr>
                <td><?= $epizoda->nazivEpizode ?></td>
                <td><?= $epizoda->brojEpizode ?></td>
                <td><?= $epizoda->nazivSezone ?></td>
                <td><?= $epizoda->review ?></td>
                <td><?= $epizoda->ocena ?></td>
            </tr>


        <?php
        }

        ?>

    </tbody>
    <tfoot>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Prosecna ocena</td>
        <td><?= round($ukupnoOcena/$counter , 2) ?></td>
    </tr>
    </tfoot>
</table>
