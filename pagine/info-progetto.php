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
<body class="h-screen flex flex-col">
    <main class="flex-grow">
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
                        echo '<div class="md:flex md:flex-col md:justify-start md:align-top md:p-5">';
                        echo '<p class="md:text-start text-black uppercase text-center p-3"> ' . $row["titolo_progetto"] . ' </p>';
                        echo '<div class="md:h-fit md:p-5 md:flex md:flex-row md:justify-between md:align-middle h-fit flex flex-col justify-start align-middle gap-5 p-3 mx-auto">';
                        echo '<p> ' . $row["descrizione_progetto"] . ' </p>';
                        echo '<img class="md:w-2/4 md:h-3/5" src=" ' . $row["immagine_progetto"] . ' ">';
                        echo '</div>';
                        // You can display other project information here
                        echo '<div class="md:flex md:flex-row md:justify-center md:align-middle flex flex-row justify-center align-middle p-3">';
                        echo '<a href=" ' . $row["link_progetto"] . ' " class="bg-red-500 p-3 rounded-lg md:w-2/6 text-center text-white uppercase w-full">Apri progetto</a>';
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
