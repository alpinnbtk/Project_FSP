<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabung ke Group</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: left;
            width: 500px;
        }

        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        img {
            width: 150px;
            height: 200px;
        }


        input {
            border-radius: 6px;
            padding: 10px;
            margin: 6px;

        }

        p {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'invalid') {
            echo "<p>Kode Pendaftaran tidak Valid!</p>";
        } else if ($_GET['error'] == 'idgrup') {
            echo "<p>Anda sudah tergabung dalam grup ini!</p>";
        }
    }
    ?>
    <h2>Gabung ke Group Baru</h2>
    <form action="gabung_group_proses.php" method="POST">

        <label>Kode Pendaftaran : </label>
        <input type='text' name='txtKode' required><br>

        <input type="submit" name="btnSubmit" value="Submit">
    </form>


</body>

</html>