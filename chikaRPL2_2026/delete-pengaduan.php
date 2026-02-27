<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = intval($_GET['id']);

$stmt = $koneksi->prepare("DELETE FROM input_aspirasi WHERE id_pelaporan = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit;