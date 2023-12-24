<?php
session_start();
unset($_SESSION['nombre']);
unset($_SESSION['cesta']);
header('location:login.php');
