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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Davide Tagini | area riservata</title>
</head>
<body class="flex flex-col justify-center align-middle h-screen">
    <main>
    <?php
        if(isset($_POST["btnaccedi"])) {
            $nomeadmin = isset($_POST["nomeadmin"]) ? sanitizeInput($conn, $_POST["nomeadmin"]) : null;
            $pswdadmin = isset($_POST["passwordadmin"]) ? sanitizeInput($conn, $_POST["passwordadmin"]) : null;

            if(empty($nomeadmin) || empty($pswdadmin)) {
                echo '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">' . sanitizeOutput('Compila tutti i campi per accedere') . '</div>';
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
                                echo '<script>alert("Benvenuto ' . sanitizeOutput($nomeadmin) . ' "); window.location.href = "home-area-riservata.php"; </script>';
                            }
                        }

                        if (!$credentialsMatch) {
                            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">' . sanitizeOutput('Non sei un amministratore di sistema, le credenziali che hai inserito non sono valide.') . '</div>';
                        }
                    }
                    else {
                        echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">' . sanitizeOutput('Non sei un amministratore di sistema, le credenziali che hai inserito non sono valide.') . '</div>';
                    }

                    mysqli_stmt_close($stmt);
                }
                else {
                    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">' . sanitizeOutput('Errore nella query SQL') . '</div>';
                }
            }
        }
    ?>


<form class="md:max-w-sm md:mx-auto md:flex md:flex-col md:justify-center md:align-middle md:h-fit md:border-4 md:border-red-500 md:p-5 border-4 border-red-500 w-10/12 mx-auto p-3" action="area-riservata.php" method="POST" autocomplete="off">
  <div class="mb-5">
    <label for="nomeadmin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome admin</label>
    <input type="text" name="nomeadmin" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  </div>
  <div class="mb-5">
    <label for="passwordadmin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
    <input type="password" name="passwordadmin" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  </div>
  <div class="items-start mb-5 hidden">
    <div class="flex items-center h-5">
      <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
    </div>
    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
  </div>
  <button type="submit" name="btnaccedi" class="text-white bg-red-500 rounded-lg p-3 uppercase">Accedi</button>
</form>

    </main>

</body>
</html>
