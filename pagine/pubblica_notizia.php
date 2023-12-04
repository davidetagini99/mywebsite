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
    <link rel="stylesheet" href="../stili/pubblicanotizia.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Davide Tagini | pubblica notizia</title>
</head>
<body class="pubblicanotiziabody">
<?php
        $nomeadmin = $_SESSION["nome_admin"];

        if(!isset($nomeadmin)) {
            header("Location: area_riservata.php");
        }
    ?>
    <main>
        <form action="pubblica_notizia.php" method="POST" autocomplete="off">
            <label for="titolonotizia">Titolo notizia</label>
            <input type="text" name="titolonotizia" id="" class="form-control">
            <label for="taglinenotizia">Tagline notizia</label>
            <input type="text" name="taglinenotizia" id="" class="form-control">
            <label for="descrizionenotizia">Descrizione notizia</label>
            <textarea name="descrizionenotizia" id="" cols="30" rows="10" class="form-control"></textarea>
            <div>
                <button type="submit" class="btn" id="pulsantePubblicaNotizia">Pubblica notizia</button>
            </div>
        </form>
    </main>
</body>
</html>