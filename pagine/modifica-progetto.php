<?php
    session_start();

    include_once("../funzioni/conndb.php");

    // sanitize text and input functions 
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
    <title>Davide Tagini | modifica progetto</title>
</head>
<body class="md:flex md:flex-col md:h-screen">
<?php
        $nomeadmin = $_SESSION["nome_admin"];

        if(!isset($nomeadmin)) {
            header("Location: area-riservata.php");
        }

        $indiceProgetto = isset($_GET["progetto_id"]) ? $_GET["progetto_id"] : null;

            if (isset($indiceProgetto)) {
                $queryPrendiInfoProgetto = "SELECT * FROM portfolio WHERE id=?";
                $stmt = mysqli_prepare($conn, $queryPrendiInfoProgetto);
                mysqli_stmt_bind_param($stmt, "i", $indiceProgetto);
                mysqli_stmt_execute($stmt);

                $resultQueryPrendiInfoProgetto = mysqli_stmt_get_result($stmt);

                if ($resultQueryPrendiInfoProgetto->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($resultQueryPrendiInfoProgetto)) {
                        if (isset($_POST["btnmodificaprogetto"])) {
                            // Handle form submission and update the project in the database
                            $newTitle = $_POST["titoloprogetto"];
                            $newDescription = $_POST["descrizioneprogetto"];
                            $newLink = $_POST["linkprogetto"];
                            $newImage = $_FILES["immagineprogetto"];

                            // Check if a new image is uploaded
                            if ($newImage["error"] == 0) {
                                // Move the uploaded file to a directory on your server
                                $uploadDir = "../immagini";
                                $uploadFile = $uploadDir . basename($newImage["name"]);

                                if (move_uploaded_file($newImage["tmp_name"], $uploadFile)) {
                                    // File upload successful, update the database with the new image path
                                    $updateQuery = "UPDATE portfolio SET 
                                                    titolo_progetto=?, 
                                                    descrizione_progetto=?, 
                                                    link_progetto=?,
                                                    immagine_progetto=? 
                                                    WHERE id=?";
                                    $stmt = mysqli_prepare($conn, $updateQuery);
                                    mysqli_stmt_bind_param($stmt, "ssssi", $newTitle, $newDescription, $newLink, $uploadFile, $indiceProgetto);
                                } else {
                                    // File upload failed
                                    echo '<script>alert("File upload failed");</script>';
                                    // Handle this case accordingly
                                }
                            } else {
                                // No new image uploaded, update the database without changing the image
                                $updateQuery = "UPDATE portfolio SET 
                                                titolo_progetto=?, 
                                                descrizione_progetto=?, 
                                                link_progetto=?
                                                WHERE id=?";
                                $stmt = mysqli_prepare($conn, $updateQuery);
                                mysqli_stmt_bind_param($stmt, "sssi", $newTitle, $newDescription, $newLink, $indiceProgetto);
                            }

                            mysqli_stmt_execute($stmt);

                            echo '<script>alert("Progetto modificato"); window.location.href="home-area-riservata.php"; </script>';
                            exit(); // Make sure to exit after redirect
                        }
                    }
                }
            }
    ?>
    <main class="md:flex md:flex-row md:justify-start md:align-middle md:p-5 flex-grow">
        <?php
            $indiceProgetto = isset($_GET["progetto_id"]) ? $_GET["progetto_id"] : null;

            if($indiceProgetto != null) {
                $queryPrendiInfoProgetto = "SELECT * FROM portfolio WHERE id=?";
                $stmt = mysqli_prepare($conn, $queryPrendiInfoProgetto);
                mysqli_stmt_bind_param($stmt, "i", $indiceProgetto);
                mysqli_stmt_execute($stmt);

                $resultQueryPrendiInfoProgetto = mysqli_stmt_get_result($stmt);

                if($resultQueryPrendiInfoProgetto->num_rows > 0) {
                    while($row = $resultQueryPrendiInfoProgetto->fetch_assoc()) {
                        echo '<form action="modifica-progetto.php?progetto_id=' . $indiceProgetto . '" method="post" enctype="multipart/form-data" class="md:flex md:flex-col md:w-2/5 md:p-5 md:gap-3 flex flex-col w-fit p-5 gap-3 mx-auto">';
                        echo '<label for="titoloprogetto">Titolo del progetto</label>';
                        echo '<input type="text" name="titoloprogetto" value=" ' . htmlspecialchars($row["titolo_progetto"]) . ' ">';
                        echo '<label for="descrizioneprogetto">Descrizione del progetto</label>';
                        echo '<textarea name="descrizioneprogetto" rows="4"> ' . htmlspecialchars($row["descrizione_progetto"]) . ' </textarea>';
                        echo '<label for="tecnologieprogetto">Tecnologie del progetto</label>';
                        echo '<textarea name="tecnologieprogetto" rows="4"> ' . htmlspecialchars($row["tecnologie_progetto"]) . ' </textarea>';
                        echo '<label for="linkprogetto">Link del progetto</label>';
                        echo '<input type="text" name="linkprogetto" value=" ' . htmlspecialchars($row["link_progetto"]) . ' ">';
                        echo '<img src=" ' . $row["immagine_progetto"] . ' " alt="Immagine del progetto">';
                        echo '<label for="immagineprogetto">Immagine del progetto</label>';
                        echo '<input name="immagineprogetto" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">';
                        echo '<div class="md:flex md:flex-row md:justify-end md:align-middle flex flex-row justify-center align-middle w-full">';
                        echo '<button type="submit" name="btnmodificaprogetto" class="bg-red-500 p-3 md:w-2/5 text-white uppercase rounded-lg w-full">Modifica</button>';
                        echo '</div>';
                        echo '</form>';
                    }
                }
            }
            else {
                echo '<p>Errore</p>';
            }
        ?>
    </main>
</body>
</html>