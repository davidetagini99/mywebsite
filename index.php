<?php
session_start();

include_once('funzioni/conndb.php');

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
    <link rel="stylesheet" href="stili/navbars/reusablenavbarhome.css">
    <link rel="stylesheet" href="stili/heros/reusableherohome.css">
    <link rel="stylesheet" href="stili/sections/reusablesectionhome.css">
    <link rel="stylesheet" href="stili/footers/reusablefooterhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="../stili/index.css">
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
    <script src="script_js/sfondo-animato.js"></script>
    <script src="script_js/pulsante_modscura.js"></script>
    <script src="script_js/gestione_barra_navigazione.js"></script>
    <script src="script_js/gestione_pulsanti.js"></script>
</body>

</html>