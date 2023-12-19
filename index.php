<?php
session_start();

include_once('funzioni/conndb.php');

mysqli_set_charset($conn, "utf8mb4");

// SQL Injection Protection
$sectionId = isset($_GET['sectionId']) ? (int)$_GET['sectionId'] : 5;
$queryPrendiDatiSecton = "SELECT * FROM sections WHERE id = ?";
$stmt = mysqli_prepare($conn, $queryPrendiDatiSecton);
mysqli_stmt_bind_param($stmt, "i", $sectionId);
mysqli_stmt_execute($stmt);
$resultQueryPrendiDatiSection = mysqli_stmt_get_result($stmt);

// XSS Protection ho sanificato tutti i campi in cui potrebbero esserci delle falle di sicurezza, testi inclusi
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
    <title>Davide Tagini</title>
</head>

<body class="indexpagebody">
    <?php
        require("componenti/navbar.php");
    ?>
    <main>
        <?php
            require("componenti/hero.php");
        ?>
        <?php
            function displaySection($sectionId, $conn) {
                $queryPrendiDatiSection = "SELECT * FROM sections WHERE id = ?";
            
                $stmt = mysqli_prepare($conn, $queryPrendiDatiSection);
            
                mysqli_stmt_bind_param($stmt, "i", $sectionId);
            
                mysqli_stmt_execute($stmt);
            
                $resultQueryPrendiDatiSection = mysqli_stmt_get_result($stmt);
            
                if($resultQueryPrendiDatiSection->num_rows > 0) {
                    $sectionData = mysqli_fetch_assoc($resultQueryPrendiDatiSection);
                    $titleText = sanitizeOutput($sectionData['titoli_section']);
                    $imagePath = sanitizeOutput($sectionData['immagini_section']);
                    $sectionText = sanitizeOutput($sectionData['testi_section']);
            
                    require("componenti/section.php");
                }
                else {
                    echo '<p>Non persiste ancora alcun contenuto da visualizzare</p>';
                }
            }  
        ?>
        <?php
            displaySection(6, $conn);
            displaySection(10, $conn);
            displaySection(11, $conn);
            displaySection(12, $conn);
            displaySection(13, $conn);
            displaySection(14, $conn);
            displaySection(15, $conn);
        ?>
    </main>
    <?php
        include("componenti/footer.php");
    ?>
    <script src="interazioni/gestionebarrahome.js"></script>
    <script src="interazioni/gestioneheroctas.js"></script>
</body>

</html>