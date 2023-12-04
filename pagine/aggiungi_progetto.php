<?php
    session_start();

    include_once("../funzioni/conndb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Davide Tagini | aggiungi progetto</title>
</head>
<body>
<?php
        $nomeadmin = $_SESSION["nome_admin"];

        if(!isset($nomeadmin)) {
            header("Location: area_riservata.php");
            
        }
    ?>
</body>
</html>