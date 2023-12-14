<?php
    session_start();

    include_once('../funzioni/conndb.php');

    function sanitizeOutput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    // Function to sanitize input data to prevent SQL injection
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
            $nomeadmin = isset($_POST["nomeadmin"]) ? sanitizeInput($conn, $_POST["nomeadmin"]) : null;
            $pswdadmin = isset($_POST["passwordadmin"]) ? sanitizeInput($conn, $_POST["passwordadmin"]) : null;

            if(empty($nomeadmin) || empty($pswdadmin)) {
                echo '<div class="alert alert-warning" role="alert">' . sanitizeOutput('Compila tutti i campi per accedere') . '</div>';
            }
            else {
                $queryPrendiDatiAdmin = "SELECT * FROM admincredentials";
                $stmt = mysqli_prepare($conn, $queryPrendiDatiAdmin);

                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $resultQueryPrendiDatiAdmin = mysqli_stmt_get_result($stmt);

                    if($resultQueryPrendiDatiAdmin->num_rows > 0) {
                        $credentialsMatch = false;
                        while($row = $resultQueryPrendiDatiAdmin->fetch_assoc()) {
                            if ($row['nome_admin'] == $nomeadmin && $row['password_admin'] == $pswdadmin) {
                                $credentialsMatch = true;
                                $_SESSION["nome_admin"] = $nomeadmin;
                                $_SESSION["password_admin"] = $pswdadmin;
                                echo '<script>alert("Benvenuto ' . sanitizeOutput($nomeadmin) . ' "); window.location.href = "home_area_riservata.php"; </script>';
                            }
                        }

                        if (!$credentialsMatch) {
                            echo '<div class="alert alert-danger" role="alert">' . sanitizeOutput('Non sei un amministratore di sistema, le credenziali che hai inserito non sono valide.') . '</div>';
                        }
                    }
                    else {
                        echo '<div class="alert alert-danger" role="alert">' . sanitizeOutput('Non sei un amministratore di sistema, le credenziali che hai inserito non sono valide.') . '</div>';
                    }

                    mysqli_stmt_close($stmt);
                }
                else {
                    echo '<div class="alert alert-danger" role="alert">' . sanitizeOutput('Errore nella query SQL') . '</div>';
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
                <button type="submit" name="btnaccedi" id="controlloPulsanteAccedi" class="py-2 px-4 border border-gray-400 rounded shadow">Accedi</button>
            </div>
        </form>
    </main>

    <?php
        require("../componenti/footer.php");
    ?>
</body>
</html>
