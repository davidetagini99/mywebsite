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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="../stili/modificaprogetto.css">
    <title>Davide Tagini | modifica progetto</title>
</head>
<body class="modificaprogettobody">
    <main>
        <div class="modificaprogettocontainer">
        <?php
            $nomeadmin = $_SESSION["nome_admin"];

            if(!isset($nomeadmin)) {
                header("Location: area_riservata.php");        
            }
        ?>
        <?php
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

                            echo '<script>alert("Progetto modificato"); window.location.href="home_area_riservata.php"; </script>';
                            exit(); // Make sure to exit after redirect
                        }
                    }
                }
            }
        ?>
        <?php
            $indiceProgetto = isset($_GET["progetto_id"]) ? $_GET["progetto_id"] : null;

            if(isset($indiceProgetto)) {
                $queryPrendiInfoProgetto = "SELECT * FROM portfolio WHERE id=?";
                $stmt = mysqli_prepare($conn, $queryPrendiInfoProgetto);
                mysqli_stmt_bind_param($stmt, "i", $indiceProgetto);
                mysqli_stmt_execute($stmt);

                $resultQueryPrendiInfoProgetto = mysqli_stmt_get_result($stmt);

                if($resultQueryPrendiInfoProgetto->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($resultQueryPrendiInfoProgetto)) {
                        echo '<form method="post" enctype="multipart/form-data">';
                        echo '<label for="titoloprogetto">Titolo progetto</label>';
                        echo '<input type="text" value=" ' . htmlspecialchars($row["titolo_progetto"]) . ' " name="titoloprogetto" class="form-control">';
                        echo '<label for="descrizioneprogetto">Descrizione progetto</label>';
                        echo '<textarea class="form-control" cols="30" rows="10" name="descrizioneprogetto"> ' . htmlspecialchars($row["descrizione_progetto"]) . ' </textarea>';
                        echo '<label for="linkprogetto">Link del progetto</label>';
                        echo '<input type="text" value=" ' . htmlspecialchars($row["link_progetto"]) . ' " name="linkprogetto" class="form-control">';
                        echo '<img src=" ' . htmlspecialchars($row["immagine_progetto"]) . ' " alt="Immagine del progetto" />';
                        echo '<input type="file" class="form-control" name="immagineprogetto">';
                        echo '<div class="actionsbuttoncontainer">';
                        echo '<button class="btn bg-green-500 hover:bg-green-500 focus:bg-green-500 text-white" type="submit" name="btnmodificaprogetto">Modifica</button>';
                        echo '</div>';
                        echo '</form>';
                    }
                }
            }
            else {
                echo '<p>Errore</p>';
            }
        ?>
        </div>
    </main>
</body>
</html>
