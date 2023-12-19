<?php
    session_start();

    include_once("../funzioni/conndb.php");

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
    <title>Davide Tagini | profilo github</title>
</head>
<body>
    <main>
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
            
                    require("../componenti/section.php");
                }
                else {
                    echo '<p>Non persiste ancora alcun contenuto da visualizzare</p>';
                }
            }  
        ?>
        <?php
            displaySection(18, $conn);
        ?>
    </main>
    <?php
        require("../componenti/footer.php");
    ?>
</body>
</html>