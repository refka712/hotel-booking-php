<?php
include 'db.php'; 
$sql = "SELECT * FROM reservations ORDER BY checkin ASC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Buchungen</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #555;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }
        h1 {
            text-align: center;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h1>Alle Buchungen</h1>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Anreisedatum</th>
                <th>Abreisedatum</th>
                <th>Zimmertyp</th>
                <th>Erstellt am</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['checkin']; ?></td>
                    <td><?php echo $row['checkout']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p style="text-align:center;color:red;">Keine Buchungen gefunden.</p>
    <?php } ?>

    <a href="index.html">Zurück zur Buchung</a>
</body>
</html>

<?php
mysqli_close($conn);
?>