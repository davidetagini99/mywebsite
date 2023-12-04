<?php
    session_start();

    include_once('../funzioni/conndb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stili/footers/reusablefooterhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../stili/areariservata.css">
    <title>Davide Tagini | area riservata</title>
</head>
<body class="areariservatapagebody">
    <?php
            if(isset($_POST["btnaccedi"])) {
                $nomeadmin = mysqli_real_escape_string($conn, $_POST["nomeadmin"]);
                $pswdadmin = mysqli_real_escape_string($conn, $_POST["passwordadmin"]);

                if(empty($nomeadmin) || empty($pswdadmin)) {
                    echo '<div class="alert alert-warning" role="alert">Compila tutti i campi per accedere</div>';
                }
                else {
                    $queryPrendiDatiAdmin = "SELECT * FROM admincredentials";
                    $resultQueryPrendiDatiAdmin = mysqli_query($conn, $queryPrendiDatiAdmin);

                    if($resultQueryPrendiDatiAdmin->num_rows > 0) {
                        while($row = $resultQueryPrendiDatiAdmin->fetch_assoc()) {
                            $_SESSION["nome_admin"] = $nomeadmin;
                            $_SESSION["password_admin"] = $pswdadmin;

                            echo '<script>alert("Benvenuto ' . $nomeadmin . ' "); window.location.href = "home_area_riservata.php"; </script>';
                        }
                    }
                }
            }
        ?>
    <main>
        <form action="area_riservata.php" method="POST" autocomplete="off">
            <div>
                <label for="nomeadmin">Nome admin</label>
                <input type="text" name="nomeadmin" id="controlloNomeAdmin" class="form-control">
            </div>
            <div>
                <label for="passwordadmin">Password admin</label>
                <input type="password" name="passwordadmin" id="controlloPasswordAdmin" class="form-control">
            </div>
            <div class="buttonsdiv">
                <button type="submit" name="btnaccedi" id="controlloPulsanteAccedi">Accedi</button>
            </div>
        </form>
    </main>
    <?php
        require("../componenti/footer.php");
    ?> <!-- non capisco -->
</body>
</html>