<?php
    session_start();

    include_once('../funzioni/conndb.php');

    function sanitizeOutput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    // Function to sanitize input data to prevent SQL injection
    function sanitizeInput($conn, $data) {
        return mysqli_real_escape_string($conn, $data);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="../stili/infoprogetto.css">
    <link rel="stylesheet" href="../stili/footers/reusablefooterhome.css">
    <title>Davide Tagini | info progetto</title>
</head>
<body class="infoprogettobody">
    <main>
        <div class="descprogettocontainer">
        <?php
            $indiceProgetto = isset($_GET["progetto_id"]) ? sanitizeInput($conn, $_GET["progetto_id"]) : null;

            if($indiceProgetto !== null) {
                // Using prepared statement to prevent SQL injection
                $queryPrendiTestoInfoProgetto = "SELECT titolo_progetto, descrizione_progetto, immagine_progetto, link_progetto FROM portfolio WHERE id=?";
                $stmt = mysqli_prepare($conn, $queryPrendiTestoInfoProgetto);
                
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $indiceProgetto);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) > 0) {
                        mysqli_stmt_bind_result($stmt, $titoloProgetto, $descrizioneProgetto, $immagineProgetto, $linkProgetto);
                        mysqli_stmt_fetch($stmt);

                        $titoloProgetto = sanitizeOutput($titoloProgetto);
                        $descrizioneProgetto = sanitizeOutput($descrizioneProgetto);
                        $immagineProgetto = sanitizeOutput($immagineProgetto);
                        $linkProgetto = sanitizeOutput($linkProgetto);

                        echo '<p class="testotitoloprogetto"> ' . $titoloProgetto . ' </p>';
                        echo '<div class="sottodescprogcontainer">';
                        echo '<textarea readonly cols="30" rows="10" class="form-control"> ' . $descrizioneProgetto . ' </textarea>';
                        echo '<img src=" ' . $immagineProgetto . ' " />';
                        echo '</div>';
                        echo '<div class="gotoprojectcontainer">';
                        echo '<a href=" ' . $linkProgetto . ' " class="text-center text-uppercase font-semibold py-2 px-4 border border-gray-400 rounded shadow">Visita progetto</a>';
                        echo '</div>';
                    }
                    else {
                        echo '<p class="testoinfoprogettoassente">Non è stato caricato ancora nessun progetto</p>';
                    }

                    mysqli_stmt_close($stmt);
                }
                else {
                    echo '<p class="testoinfoprogettoassente">Errore nella query SQL</p>';
                }
            }
            else {
                echo '<p class="testoinfoprogettoassente">Non è possibile leggere le info del progetto</p>';
            }
        ?>
        </div>
    </main>
    <?php
        require("../componenti/footer.php");
    ?>
</body>
</html>
