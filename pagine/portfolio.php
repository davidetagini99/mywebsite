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
    <title>Davide Tagini | Portfolio</title>
</head>
<body class="md:flex md:flex-col md:h-screen flex flex-col h-screen">
<nav class="bg-sky-400 md:p-2">
    <div class="flex flex-row justify-end align-middle">
      <form action="" method="get" class="w-screen flex flex-row justify-end align-middle gap-3 p-2" autocomplete="off">
        <label for="cercaprogetto" class="hidden">Nome del progetto</label>
        <input type="text" name="cercaprogetto" id="" placeholder="Cerca un progetto" class="rounded-lg w-64">
        <button type="submit" class="bg-white text-black font-bold border-2 border-black rounded-lg text-center uppercase p-3 w-36">Cerca</button>
      </form>
    </div>
  </nav>

    <main class="md:flex-grow flex-grow p-3">
        <?php
            $searchTerm = isset($_GET["cercaprogetto"]) ? sanitizeInput($conn, $_GET["cercaprogetto"]) : null;

            if ($searchTerm !== null) {
                $querySearchProjects = "SELECT id, titolo_progetto, descrizione_progetto, immagine_progetto FROM portfolio WHERE titolo_progetto LIKE ?";
                $stmt = $conn->prepare($querySearchProjects);
                $searchTerm = "%$searchTerm%";
                $stmt->bind_param("s", $searchTerm);
            } else {
                // Display all projects if no search term is provided
                $queryGetAllProjects = "SELECT id, titolo_progetto, descrizione_progetto, immagine_progetto FROM portfolio";
                $stmt = $conn->prepare($queryGetAllProjects);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Display the search results or all projects
                while ($row = $result->fetch_assoc()) {
                  echo '<div class="max-w-2xl p-4">';
                  echo '<div class="rounded overflow-hidden shadow-lg bg-white">';
                  // Display the title above the image
                  echo '<p class="text-xl text-start mb-2 p-3">' . sanitizeOutput($row["titolo_progetto"]) . '</p>';
                  echo '<img class="w-full" src="' . sanitizeOutput($row["immagine_progetto"]) . '" alt="Immagine del progetto">';
                  echo '<div class="px-6 py-4">';
                  // Optionally, you can display the title below the image as well
                  // echo '<p class="text-xl text-center font-bold mb-2">' . sanitizeOutput($row["titolo_progetto"]) . '</p>';
                  echo '<div class="flex justify-end md:p-2">';
                  echo '<a href="info-progetto.php?progetto_id=' . sanitizeOutput($row["id"]) . '" target="_blank" class="bg-sky-400 p-3 text-white uppercase rounded-lg w-full text-center md:w-fit">Scheda progetto</a>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                }
            } else {
                echo '<p>Non esiste ancora nessun progetto</p>';
            }
        ?>
    </main>
    <?php
        require("../componenti/footer.php");
    ?>
</body>
</html>