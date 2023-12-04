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
    <link rel="stylesheet" href="../stili/infoprogetto.css">
    <link rel="stylesheet" href="../stili/footers/reusablefooterhome.css">
    <title>Davide Tagini | info progetto</title>
</head>
<body class="infoprogettobody">
    <main>
        <div class="descprogettocontainer">
        <?php
            if(isset($_GET["progetto_id"])) {
                $queryPrendiTestoInfoProgetto = "SELECT titolo_progetto, descrizione_progetto, immagine_progetto FROM portfolio";
                $resultQueryPrendiTestoInfoProgetto = mysqli_query($conn, $queryPrendiTestoInfoProgetto);

                if($resultQueryPrendiTestoInfoProgetto->num_rows > 0) {
                    while($row = $resultQueryPrendiTestoInfoProgetto->fetch_assoc()) {
                        echo '<p class="testotitoloprogetto"> ' . $row["titolo_progetto"] . ' </p>';
                        echo '<div class="sottodescprogcontainer">';
                        echo '<p class="testodescrizioneprogetto"> ' . $row["descrizione_progetto"] . ' </p>';
                        echo '<img src=" ' . $row["immagine_progetto"] . ' " />';
                        echo '</div>';
                        echo '<div class="gotoprojectcontainer">';
                        echo '<a href="" class="btn">Visita progetto</a>';
                        echo '</div>';
                    }
                }
                else {
                    echo '<p class="testoinfoprogettoassente">Non è stato caricato ancora nessun progetto</p>';
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