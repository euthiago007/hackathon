<?php
session_start();
if (empty($_SESSION['empresa_id'])) {
    header('Location: login.php');
    exit;
}
