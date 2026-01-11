<?php
include 'db.php'; 

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$room_type = mysqli_real_escape_string($conn, $_POST['room_type']);

if (strtotime($checkout) <= strtotime($checkin)) {
    echo "<p style='color:red;text-align:center;'>Das Abreisedatum muss nach dem Anreisedatum liegen!</p>";
    echo "<p style='text-align:center;'><a href='index.html'>Zurück</a></p>";
    exit;
}

$sql = "INSERT INTO reservations (name, email, checkin, checkout, room_type)
        VALUES ('$name', '$email', '$checkin', '$checkout', '$room_type')";

if (mysqli_query($conn, $sql)) {
    echo "<p style='color:green;text-align:center;'>Vielen Dank, $name! Ihre Buchung für ein $room_type vom $checkin bis $checkout wurde erfolgreich übermittelt.</p>";
    echo "<p style='text-align:center;'><a href='index.html'>Neue Buchung</a></p>";
} else {
    echo "<p style='color:red;text-align:center;'>Fehler: " . mysqli_error($conn) . "</p>";
    echo "<p style='text-align:center;'><a href='index.html'>Zurück</a></p>";
}

mysqli_close($conn);
?>
