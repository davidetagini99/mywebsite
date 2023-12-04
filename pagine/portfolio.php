<?php
    session_start();

    include_once('../funzioni/conndb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stili/reusablenavbarportfolio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="../stili/footers/reusablefooterhome.css">
    <link rel="stylesheet" href="../stili/portfolio.css">
    <link rel="stylesheet" href="../stili/navbars/reusablenavbarportfolio.css">
    <title>Davide Tagini | portfolio</title>
</head>
<body class="portfoliopagebody">
    <?php
        require("../componenti/navbar.php")
    ?>
    <main>
        <?php
            $queryPrendiProgettiPortfolio = "SELECT id, titolo_progetto, immagine_progetto, link_progetto FROM portfolio";
            $resultQueryPrendiProgettiPortfolio = mysqli_query($conn, $queryPrendiProgettiPortfolio);

            if($resultQueryPrendiProgettiPortfolio->num_rows > 0) {
                while($row = $resultQueryPrendiProgettiPortfolio->fetch_assoc()) {
                   echo '<div class="card">';
                   echo '<div class="card-body">';
                   echo '<h5 class="card-title">' . $row["titolo_progetto"] . '</h5>'; // perché non legge il tag h5?
                   echo '</div>';
                   echo '<img src=" ' . $row["immagine_progetto"] . ' " alt="Immagine del progetto">';
                   echo '<div class="card-footer">';
                   echo '<a class="btn" href="infoprogetto.php?progetto_id=' . $row["id"] . '" target="_blank">Leggi info</a>';
                   echo '</div>';
                   echo '</div>';
                }
            }
            else {
                echo '<p class="messaggioerrore">Coming soon</p>';
            }
        ?>
    </main>
    <?php
        require("../componenti/footer.php");
    ?>
    <script src="../script_js/gestione_barra_navigazione.js"></script>
</body>
</html>

<!--
     echo '<div class="boxprogetto">';
                    echo '<p> ' . $row["titolo_progetto"] . ' </p>';
                    echo '<img src=" ' . $row["immagine_progetto"] . ' " alt="Ciao" />';
                    echo '<div class="boxprogetto-footer">';
                    echo '<a class="btn" href="infoprogetto.php?progetto_id=' . $row["id"] . '" target="_blank">Leggi info</a>';
                    echo '</div>';
                    echo '</div>';
-->