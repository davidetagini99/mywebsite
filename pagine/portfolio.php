<?php
    session_start();

    include_once("../funzioni/conndb.php");

    function sanitizeOutput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    $searchQuery = isset($_GET['titoloprogetto']) ? $_GET['titoloprogetto'] : '';
    $queryPrendiProgettiPortfolio = "SELECT * FROM portfolio WHERE titolo_progetto LIKE '%$searchQuery%'";
    $stmt = $conn->prepare($queryPrendiProgettiPortfolio);
    $stmt->execute();
    $resultQueryPrendiProgettiPortfolio = $stmt->get_result();
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
    <title>Davide Tagini | portfolio</title>
</head>
<body class="md:flex md:flex-col md:h-screen flex flex-col h-screen">
<nav class="bg-red-500">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button id="burger-menu-button" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-500" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-end">
        <div class="flex flex-shrink-0 items-center">
          <img class="h-8 w-auto hidden" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <form action="portfolio.php" method="get" autocomplete="off">
              <label for="titoloprogetto" class="hidden">Titolo progetto</label>
              <input type="search" name="titoloprogetto" id="titoloProgetto" placeholder="Cerca un progetto">
            </form>
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <?php
                  $queryPrendiLink = "SELECT * FROM linknav";
                  $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
                  
                  if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
                      while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                          $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                          $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
                  
                          // Modify the link to include the section ID
                          echo '<a class="text-red-500 hover:bg-red-500 hover:text-white focus:bg-red-500 focus:text-white focus:border-2 focus:border-red-500 rounded-md px-3 py-2 text-sm font-medium uppercase hidden" href="' . $destLink . '">' . $voceLink . '</a>';
                      }
                  } 
                  else {
                      echo '<p class="text-white text-uppercase">Carica i link</p>';
                  }
                ?>
                <div class="relative inline-block text-left">
  <div>
    <button type="button" class="hidden w-full justify-center gap-x-1.5 rounded-md bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-transparent hover:bg-red-500 uppercase" id="drop-menu-button" aria-expanded="true" aria-haspopup="true">
      Qualcosa in più
      <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>

  <!--
    Dropdown menu, show/hide based on menu state.

    Entering: "transition ease-out duration-100"
      From: "transform opacity-0 scale-95"
      To: "transform opacity-100 scale-100"
    Leaving: "transition ease-in duration-75"
      From: "transform opacity-100 scale-100"
      To: "transform opacity-0 scale-95"
  -->
  <div id="drop-down-menu" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none list-none p-3" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
    <div class="py-1" role="none">
      <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
      <?php
        $queryPrendiLinkDropdown = "SELECT * FROM dropdownmenu";
        $resultQueryPrendiLinkDropdown = mysqli_query($conn, $queryPrendiLinkDropdown);

        if($resultQueryPrendiLinkDropdown->num_rows > 0) {
          while($row = $resultQueryPrendiLinkDropdown->fetch_assoc()) {
              $destLinkDropdown = htmlspecialchars($row["dest_link_dropdown"], ENT_QUOTES, 'UTF-8');
              $voceLinkDropdown = htmlspecialchars($row["voce_link_dropdown"], ENT_QUOTES, 'UTF-8');

              echo '<li>';
              echo '<a href=" ' . $destLinkDropdown . '"> ' . $voceLinkDropdown . ' </a>';
              echo '</li>';
          }
        }
      ?>
    </div>
  </div>
</div>

          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <button id="notification-button" type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
          </svg>
        </button>

        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
            <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </button>
          </div>

          <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
          <div id="user-menu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2 bg-red-500 flex flex-col justify-start align-middle text-center uppercase min-h-screen">
        <form action="" method="get">
          <label for="" class="hidden">Titolo progetto</label>
          <input type="search" name="" id="" placeholder="Cerca un progetto" class="w-full">
        </form>
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <?php
                  $queryPrendiLink = "SELECT * FROM linknav";
                  $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
                  
                  if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
                      while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                          $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                          $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
                  
                          // Modify the link to include the section ID
                          echo '<a class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-base font-medium hidden" href="' . $destLink . '">' . $voceLink . '</a>';
                      }
                  } 
                  else {
                      echo '<p class="text-white text-uppercase">Carica i link</p>';
                  }
                ?>
                <div class="relative inline-block text-left">
  <div>
    <button type="button" class="hidden w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 uppercase" id="menu-button" aria-expanded="true" aria-haspopup="true">
      Qualcosa in più
      <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>

  <!--
    Dropdown menu, show/hide based on menu state.

    Entering: "transition ease-out duration-100"
      From: "transform opacity-0 scale-95"
      To: "transform opacity-100 scale-100"
    Leaving: "transition ease-in duration-75"
      From: "transform opacity-100 scale-100"
      To: "transform opacity-0 scale-95"
  -->
  <div class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
    <div class="py-1" role="none">
      <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
      <?php // dropdown
            $queryPrendiLinkDropdown = "SELECT * FROM dropdownmenu";
            $resultQueryPrendiLinkDropdown = mysqli_query($conn, $queryPrendiLinkDropdown);

            if ($resultQueryPrendiLinkDropdown && $resultQueryPrendiLinkDropdown->num_rows > 0) {
              echo '<ul>';
              while ($row = mysqli_fetch_assoc($resultQueryPrendiLinkDropdown)) {
                $destLinkDropdown = htmlspecialchars($row["dest_link_dropdown"], ENT_QUOTES, 'UTF-8');
                $voceLinkDropdown = htmlspecialchars($row["voce_link_dropdown"], ENT_QUOTES, 'UTF-8');
                
                echo '<li>';
                echo '<a class="text-black text-start hidden" href="' . $destLinkDropdown . '">' . $voceLinkDropdown . '</a>';
                echo '</li>';
                
              }
              echo '</ul>';
            } 
            else {
              echo '<p class="text-white text-uppercase">Carica il dropdown</p>';
            }
            ?>
    </div>
  </div>
</div>
    </div>
  </div>
</nav>
<main class="md:p-5 flex-grow p-5">
  <div class="md:container md:mx-auto md:flex md:flex-wrap md:justify-start md:align-middle">
    <?php
    $queryPrendiProgettiPortfolio = "SELECT * FROM portfolio";
    $stmt = $conn->prepare($queryPrendiProgettiPortfolio);
    $stmt->execute();
    $resultQueryPrendiProgettiPortfolio = $stmt->get_result();

    if ($resultQueryPrendiProgettiPortfolio->num_rows > 0) {
      while ($row = $resultQueryPrendiProgettiPortfolio->fetch_assoc()) {
        echo '<div class="max-w-2xl p-4">';
        echo '<div class="rounded overflow-hidden shadow-lg bg-white">';
        // Display the title above the image
        echo '<p class="text-xl text-start mb-2 p-3">' . sanitizeOutput($row["titolo_progetto"]) . '</p>';
        echo '<img class="w-full" src="' . sanitizeOutput($row["immagine_progetto"]) . '" alt="Immagine del progetto">';
        echo '<div class="px-6 py-4">';
        // Optionally, you can display the title below the image as well
        // echo '<p class="text-xl text-center font-bold mb-2">' . sanitizeOutput($row["titolo_progetto"]) . '</p>';
        echo '<div class="flex justify-end md:p-2">';
        echo '<a href="info-progetto.php?progetto_id=' . sanitizeOutput($row["id"]) . '" target="_blank" class="bg-red-500 p-3 text-white uppercase rounded-lg">Scheda progetto</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<p class="text-red-500 text-2xl text-start font-semibold">Coming soon</p>';
    }
    ?>
  </div>
</main>
<?php
  require("../componenti/footer.php")
?>
<script src="../interazioni/gestionebarraportfolio.js"></script>
</body>
</html>