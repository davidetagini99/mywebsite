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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Davide Tagini | Home area riservata</title>
</head>
<body>
<?php
        $nomeadmin = $_SESSION["nome_admin"];

        if(!isset($nomeadmin)) {
            header("Location: area-riservata.php");
        }
    ?>
    <?php
        require("../componenti/navbaradmin.php");
    ?>
    <main class="md:h-screen md:flex md:flex-col md:p-5 md:justify-start md:align-top h-screen flex flex-col p-3 justify-start align-top">
        <form action="home-area-riservata.php" method="post">
        <?php
            if(isset($_POST["btneliminaprogetto"])) {
                $indiceProgetto = $_POST["progetto_id"];

                $queryCancellaProgetto = "DELETE FROM portfolio WHERE id=?";
                $stmt = mysqli_prepare($conn, $queryCancellaProgetto);
                mysqli_stmt_bind_param($stmt, "i", $indiceProgetto);
                $resultQueryCancellaProgetto = mysqli_stmt_execute($stmt);

                if($resultQueryCancellaProgetto === true) {
                    echo '<script>alert("Progetto cancellato"); window.location.href="home-area-riservata.php"; </script>';
                } else {
                    echo '<script>alert("Errore durante la cancellazione del progetto");</script>';
                }
            }
        ?>
        <?php
            $queryPrendiProgettiPortfolio = "SELECT * FROM portfolio";
            $resultQueryPrendiProgettiPortfolio = mysqli_query($conn, $queryPrendiProgettiPortfolio);

            if($resultQueryPrendiProgettiPortfolio->num_rows > 0) {
                echo '<p class="text-center md:text-start">Lista progetti</p>';
                while($row = $resultQueryPrendiProgettiPortfolio->fetch_assoc()) {
                    echo '<ul class="md:flex md:flex-row md:justify-between md:p-5 flex flex-row justify-between py-7">';
                    echo '<li> ' . $row["titolo_progetto"] . ' </li>';
                    echo '<div class="">';
                    echo '<a href="modifica-progetto.php?progetto_id=' . $row["id"] . '" name="btnmodificaprogetto" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 uppercase">Modifica</a>';
                    // Add a hidden input field to store the project ID
                    echo '<input type="hidden" name="progetto_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" name="btneliminaprogetto" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 uppercase">Elimina</button>';
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
    <script src="../interazioni/gestioneadminbarra.js"></script>
</body>
</html>