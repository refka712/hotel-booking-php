<?php
include 'db.php'; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $checkin = $_POST['checkin'];

    $sql = "SELECT * FROM reservations WHERE email='$email' AND checkin='$checkin'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
    
        $delete = "DELETE FROM reservations WHERE email='$email' AND checkin='$checkin'";
        if (mysqli_query($conn, $delete)) {
            $message = "<span style='color:green;'>Ihre Buchung vom $checkin wurde erfolgreich storniert.</span>";
        } else {
            $message = "<span style='color:red;'>Fehler beim Stornieren: " . mysqli_error($conn) . "</span>";
        }
    } else {
        $message = "<span style='color:red;'>Keine Buchung gefunden für diese E-Mail und Anreisedatum.</span>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buchung stornieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Buchung stornieren</h1>
        <form method="POST">
            <label for="email">E-Mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="checkin">Anreisedatum:</label>
            <input type="date" id="checkin" name="checkin" required>

            <button type="submit">Stornieren</button>
        </form>
        <p style="text-align:center;"><?php echo $message; ?></p>
        <p style="text-align:center;"><a href="index.html">Zurück zur Buchung</a></p>
    </div>
</body>
</html>
