<?php
    session_start();

    include_once('funzioni/conndb.php');
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
        <!-- rendere l'header riusabile con gli id dei testi -->
        <?php
            require("componenti/hero.php"); // da fixare
        ?>
        <?php
            $sectionId = 5;
            $queryPrendiDatiSecton = "SELECT * FROM sections WHERE id = $sectionId";
            $resultQueryPrendiDatiSection = mysqli_query($conn, $queryPrendiDatiSecton);
    
            if($resultQueryPrendiDatiSection) {
                $sectionData = mysqli_fetch_assoc($resultQueryPrendiDatiSection);
                
                $imagePath = $sectionData['immagini_section'];
                $sectionText = $sectionData['testi_section'];
                $skillBars = $sectionData['skill_bars_section'];
    
                require("componenti/section.php");
            }
        ?>
    </main>
    <?php
        include("componenti/footer.php");
    ?>
    <script src="script_js/sfondo-animato.js"></script>
    <script src="script_js/pulsante_modscura.js"></script>
    <script src="script_js/gestione_barra_navigazione.js"></script>
</body>
</html>

<!--
<?php
            $sectionId = 3;
            $queryPrendiDatiSecton = "SELECT * FROM sections WHERE id = $sectionId";
            $resultQueryPrendiDatiSection = mysqli_query($conn, $queryPrendiDatiSecton);
    
            if($resultQueryPrendiDatiSection) {
                $sectionData = mysqli_fetch_assoc($resultQueryPrendiDatiSection);
                
                $imagePath = $sectionData['immagini_section'];
                $sectionText = $sectionData['testi_section'];
                $skillBars = $sectionData['skill_bars_section'];
    
                require("componenti/section.php");
            }
        ?>
        <?php
            $sectionId = 4;
            $queryPrendiDatiSecton = "SELECT * FROM sections WHERE id = $sectionId";
            $resultQueryPrendiDatiSection = mysqli_query($conn, $queryPrendiDatiSecton);
    
            if($resultQueryPrendiDatiSection) {
                $sectionData = mysqli_fetch_assoc($resultQueryPrendiDatiSection);
                
                $imagePath = $sectionData['immagini_section'];
                $sectionText = $sectionData['testi_section'];
                $skillBars = $sectionData['skill_bars_section'];
    
                require("componenti/section.php");
            }
        ?>
-->