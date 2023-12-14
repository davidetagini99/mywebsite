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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="../stili/navbars/reusablenavbarareariservata.css">
    <link rel="stylesheet" href="../stili/homeareariservata.css">
    <title>Davide Tagini | area riservata</title>
</head>
<body class="homeareariservatabody">
    <?php
        $nomeadmin = $_SESSION["nome_admin"];

        if(!isset($nomeadmin)) {
            header("Location: area_riservata.php");
        }
    ?>
    <?php
        require("../componenti/navbaradmin.php");
    ?>
    <main>
        <form action="home_area_riservata.php" method="post">
        <?php
            if(isset($_POST["btneliminaprogetto"])) {
                $indiceProgetto = $_POST["progetto_id"];

                $queryCancellaProgetto = "DELETE FROM portfolio WHERE id=?";
                $stmt = mysqli_prepare($conn, $queryCancellaProgetto);
                mysqli_stmt_bind_param($stmt, "i", $indiceProgetto);
                $resultQueryCancellaProgetto = mysqli_stmt_execute($stmt);

                if($resultQueryCancellaProgetto === true) {
                    echo '<script>alert("Progetto cancellato"); window.location.href="home_area_riservata.php"; </script>';
                } else {
                    echo '<script>alert("Errore durante la cancellazione del progetto");</script>';
                }
            }
        ?>
        <?php
            $queryPrendiProgettiPortfolio = "SELECT * FROM portfolio";
            $resultQueryPrendiProgettiPortfolio = mysqli_query($conn, $queryPrendiProgettiPortfolio);

            if($resultQueryPrendiProgettiPortfolio->num_rows > 0) {
                echo '<p>Lista progetti</p>';
                while($row = $resultQueryPrendiProgettiPortfolio->fetch_assoc()) {
                    echo '<ul>';
                    echo '<li> ' . $row["titolo_progetto"] . ' </li>';
                    echo '<div class="actionsbuttonscontainer">';
                    echo '<a href="modifica_progetto.php?progetto_id=' . $row["id"] . '" name="btnmodificaprogetto" class="btn bg-green-500 text-white text-uppercase hover:bg-green-500" style="padding: 10px; min-width: 12vw;">Modifica</a>';
                    // Add a hidden input field to store the project ID
                    echo '<input type="hidden" name="progetto_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" name="btneliminaprogetto" class="btn bg-red-500 text-white text-uppercase hover:bg-red-500" style="padding: 10px; min-width: 12vw;">Elimina</button>';
                    echo '</div>';
                    echo '</ul>';
                }
            }
            else {
                echo '<p>Non è presente nessun progetto</p>';
            }
        ?>
        </form>
    </main>
    <script src="../script_js/gestione_barra_navigazione_admin.js"></script>
</body>
</html>
