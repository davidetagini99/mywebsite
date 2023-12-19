<?php
    session_start();

    include_once('../funzioni/conndb.php');

    function sanitizeInput($conn, $data) {
        return mysqli_real_escape_string($conn, $data);
    }

    function sanitizeOutput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
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
    <title>Davide Tagini | aggiungi progetto</title>
</head>
<body class="h-screen flex flex-col justify-center align-middle">
<?php
        $nomeadmin = $_SESSION["nome_admin"];

        if(!isset($nomeadmin)) {
            header("Location: area-riservata.php");
        }

        if (isset($_POST["btnpubblicaprogetto"])) {
            $titoloprogetto = sanitizeInput($conn, $_POST["titoloprogetto"]);
            $descrizioneprogetto = sanitizeInput($conn, $_POST["descrizioneprogetto"]);
            $linkprogetto = sanitizeInput($conn, $_POST["linkprogetto"]);
            $tecnologieprogetto = sanitizeInput($conn, $_POST["tecnologieprogetto"]);
    
            if (empty($titoloprogetto) || empty($descrizioneprogetto) || empty($linkprogetto) || empty($_FILES["immagineprogetto"])) {
                echo '<div class="alert alert-warning" role="alert">' . sanitizeOutput('Compila tutti i campi per caricare il progetto') . '</div>';
            } else {
                if (isset($_FILES["immagineprogetto"]) && $_FILES["immagineprogetto"]["error"] == 0) {
                    $targetDir = "../immagini";
                    $targetFile = $targetDir . basename($_FILES["immagineprogetto"]["name"]);
    
                    if (move_uploaded_file($_FILES["immagineprogetto"]["tmp_name"], $targetFile)) {
                        $queryInserisciProgetto = "INSERT INTO portfolio (titolo_progetto, descrizione_progetto, link_progetto, tecnologie_progetto, immagine_progetto) VALUES ('$titoloprogetto', '$descrizioneprogetto', '$linkprogetto', '$tecnologieprogetto', '$targetFile')";
    
                        $resultQueryInserisciProgetto = mysqli_query($conn, $queryInserisciProgetto);
    
                        if ($resultQueryInserisciProgetto === true) {
                            echo '<script>alert("Progetto caricato con successo"); window.location.href = "home-area-riservata.php"; </script>';
                            exit();
                        } else {
                            echo '<div class="alert alert-danger" role="alert">' . sanitizeOutput('Non è possibile caricare il progetto.') . '</div>';
                            die();
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">' . sanitizeOutput('Errore durante il caricamento dell\'immagine.') . '</div>';
                    }
                } else {
                    echo '<div class="alert alert-warning" role="alert">' . sanitizeOutput('Compila tutti i campi per caricare un nuovo progetto.') . '</div>';
                }
            }
        }
    ?>
    <main class="md:h-screen md:flex md:flex-col md:justify-center md:align-middle flex flex-col justify-center align-middle">


<form class="max-w-sm mx-auto md:flex md:flex-col md:justify-center md:align-middle md:p-5 md:w-8/12 flex flex-col justify-center align-middle border-4 border-red-500 p-5" action="aggiungi-progetto.php" method="post" autocomplete="off" enctype="multipart/form-data">
  <div class="mb-5">
    <label for="titoloprogetto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titolo del progetto</label>
    <input type="text" name="titoloprogetto" id="titoloProgetto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  </div>
  <div class="mb-5">
    <label for="descrizioneprogetto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrizione del progetto</label>
    <textarea name="descrizioneprogetto" id="descrizioneProgetto" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
  </div>
  <div class="mb-5">
    <label for="tecnologieprogetto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tecnologie del progetto</label>
    <textarea name="tecnologieprogetto" id="tecnologieProgetto" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
  </div>
  <div class="mb-5">
    <label for="linkprogetto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link del progetto</label>
    <input type="text" name="linkprogetto" id="linkprogetto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  </div>
  <div class="mb-5">
    <label for="immagineprogetto">Immagine del progetto</label>
    <input name="immagineprogetto" id="immagineProgetto" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
  </div>
  <button type="submit" name="btnpubblicaprogetto" class="bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 text-white uppercase">Carica progetto</button>
</form>
    </main>
</body>
</html>