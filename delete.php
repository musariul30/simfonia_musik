<?php
include "db_conn.php";

if (isset($_GET["nama"])) {
  $nama = $_GET["nama"];
  $nama = mysqli_real_escape_string($conn, $nama);

  $sql = "DELETE FROM `crud` WHERE nama = '$nama'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: halamanAdmin.php?msg=Data deleted successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
} else {
  echo "No name parameter provided.";
}
?>
