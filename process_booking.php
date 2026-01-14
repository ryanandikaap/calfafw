<?php
include "config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $name        = $_POST['name'];
  $treatment   = $_POST['treatment'];
  $price       = $_POST['price'];
  $date        = $_POST['date'];
  $time        = $_POST['time'];
  $gender      = $_POST['gender'];
  $hairstylist = $_POST['hairstylist'];
  $note        = $_POST['note'];

  /* ==== UPLOAD BUKTI ==== */
  $buktiName = time() . '_' . $_FILES['bukti']['name'];
  move_uploaded_file(
    $_FILES['bukti']['tmp_name'],
    "uploads/bukti/" . $buktiName
  );

  /* ==== SIMPAN DATABASE ==== */
  $sql = "INSERT INTO bookings 
    (name, treatment, price, booking_date, booking_time, gender, hairstylist, note, bukti)
    VALUES (?,?,?,?,?,?,?,?,?)";

  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param(
    $stmt,
    "ssissssss",
    $name,
    $treatment,
    $price,
    $date,
    $time,
    $gender,
    $hairstylist,
    $note,
    $buktiName
  );

  if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error']);
  }
}
