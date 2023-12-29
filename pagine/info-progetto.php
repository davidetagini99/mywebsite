<?php
    session_start();

    include_once("../funzioni/conndb.php");

    function sanitizeOutput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <title>Davide Tagini | info progetto</title>
</head>
<body>
    <main>
        <?php
            $indiceProgetto = isset($_GET["progetto_id"]) ? sanitizeInput($conn, $_GET["progetto_id"]) : null;

            if($indiceProgetto !== null) {
                $queryPrendiTestoInfoProgetto = "SELECT * FROM portfolio WHERE id=?";
                $stmt = $conn->prepare($queryPrendiTestoInfoProgetto);
                $stmt->bind_param("i", $indiceProgetto);  // Bind the parameter
                $stmt->execute();

                $resultQueryPrendiTestoInfoProgetto = $stmt->get_result();

                if($resultQueryPrendiTestoInfoProgetto->num_rows > 0) {
                    while($row = $resultQueryPrendiTestoInfoProgetto->fetch_assoc()) {
                        echo '<div class="md:flex md:flex-col md:justify-start md:align-middle md:p-5 md:h-screen p-3">';
                        echo '<div class="md:flex md:flex-row md:justify-start md:align-middle">';
                        echo '<p class="md:text-start text-black uppercase text-center p-3"> ' . $row["titolo_progetto"] . ' </p>';
                        echo '</div>';
                        echo '<div class="md:flex md:flex-row md:justify-between md:align-middle md:h-4/5 md:gap-0 md:py-6 flex flex-col justify-between align-middle gap-4">';
                        echo '<p class="text-justify md:w-2/5"> ' . $row["descrizione_progetto"] . ' </p>';
                        echo '<img class="md:w-2/4 md:h-5/6 border-4 border-sky-400 h-fit object-cover" src=" ' . $row["immagine_progetto"] . ' ">';
                        echo '</div>';
                        // You can display other project information here
                        echo '<div class="md:p-0 md:flex md:flex-row md:justify-center md:align-middle md:py-0 p-2 flex flex-row justify-center align-middle py-4">';
                        echo '<a href=" ' . $row["link_progetto"] . ' " class="bg-sky-400 p-3 rounded-lg md:w-1/4 text-center text-white uppercase w-2/4">Apri progetto</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No information found for the specified project ID</p>';
                }
            }
            else {
                echo '<p>Errore</p>';
            }
        ?>
    </main>
    <?php
        require("../componenti/footer.php");
    ?>
</body>
</html>
