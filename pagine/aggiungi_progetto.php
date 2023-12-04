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
    <link rel="stylesheet" href="../stili/aggiungiprogetto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Davide Tagini | aggiungi progetto</title>
</head>
<body class="aggiungiprogettobody">
<?php
        $nomeadmin = $_SESSION["nome_admin"];

        if(!isset($nomeadmin)) {
            header("Location: area_riservata.php");
            
        }
    ?>
    <main>
        <form action="aggiungi_progetto.php" method="POST">
            <label for="titoloprogetto">Titolo progetto</label>
            <input type="text" name="titoloprogetto" id="" class="form-control">
            <label for="descrizioneprogetto">Descrizione progetto</label>
            <textarea name="descrizioneprogetto" id="" cols="30" rows="10" class="form-control"></textarea>
            <div>
                <button type="submit" class="btn" id="pulsantePubblicaProgetto">Pubblica progetto</button>
            </div>
        </form>
    </main>
</body>
</html>