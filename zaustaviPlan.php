<?php
 require 'sesija.php';

 session_destroy();

 header("Location: index.php");