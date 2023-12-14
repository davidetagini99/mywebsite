<?php
    session_start();

    include_once("../funzioni/conndb.php");

    function sanitizeInput($conn, $data) {
        return mysqli_real_escape_string($conn, $data);
    }

    function sanitizeOutput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
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

    if (!isset($nomeadmin)) {
        header("Location: area_riservata.php");
        exit();
    }

    if (isset($_POST["btnpubblicaprogetto"])) {
        $titoloprogetto = sanitizeInput($conn, $_POST["titoloprogetto"]);
        $descrizioneprogetto = sanitizeInput($conn, $_POST["descrizioneprogetto"]);
        $linkprogetto = sanitizeInput($conn, $_POST["linkprogetto"]);
        $tecnologieprogetto = sanitizeInput($conn, $_POST["tecnologieprogetto"]);

        if (empty($titoloprogetto) || empty($descrizioneprogetto) || empty($linkprogetto) || empty($_FILES["immagineprogetto"])) {
            echo '<div class="alert alert-warning" role="alert">' . sanitizeOutput('Compila tutti i campi per caricare il progetto') . '</div>';
        } else {
            if (isset($_FILES["immagineprogetto"]) && $_FILES["immagineprogetto"]["error"] == 0) {
                $targetDir = "../immagini";
                $targetFile = $targetDir . basename($_FILES["immagineprogetto"]["name"]);

                if (move_uploaded_file($_FILES["immagineprogetto"]["tmp_name"], $targetFile)) {
                    $queryInserisciProgetto = "INSERT INTO portfolio (titolo_progetto, descrizione_progetto, link_progetto, tecnologie_progetto, immagine_progetto) VALUES ('$titoloprogetto', '$descrizioneprogetto', '$linkprogetto', '$tecnologieprogetto', '$targetFile')";

                    $resultQueryInserisciProgetto = mysqli_query($conn, $queryInserisciProgetto);

                    if ($resultQueryInserisciProgetto === true) {
                        echo '<script>alert("Progetto caricato con successo"); window.location.href = "aggiungi_progetto.php"; </script>';
                        exit();
                    } else {
                        echo '<div class="alert alert-danger" role="alert">' . sanitizeOutput('Non è possibile caricare il progetto.') . '</div>';
                        die();
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">' . sanitizeOutput('Errore durante il caricamento dell\'immagine.') . '</div>';
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">' . sanitizeOutput('Compila tutti i campi per caricare un nuovo progetto.') . '</div>';
            }
        }
    }
?>

<main>
    <form action="aggiungi_progetto.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <label for="titoloprogetto">Titolo progetto</label>
        <input type="text" name="titoloprogetto" id="" class="form-control">
        <label for="immagineprogetto">Immagine progetto</label>
        <input type="file" name="immagineprogetto" id="" class="form-control">
        <label for="descrizioneprogetto">Descrizione progetto</label>
        <textarea name="descrizioneprogetto" id="" cols="30" rows="10" class="form-control"></textarea>
        <label for="tecnologieprogetto">Tecnologie utilizzate</label>
        <textarea name="tecnologieprogetto" id="" cols="30" rows="10" class="form-control"></textarea>
        <label for="linkprogetto">Link progetto</label>
        <input type="text" name="linkprogetto" id="" class="form-control">
        <div>
            <button type="submit" class="btn" name="btnpubblicaprogetto" id="pulsantePubblicaProgetto">Pubblica progetto</button>
        </div>
    </form>
</main>
</body>
</html>
