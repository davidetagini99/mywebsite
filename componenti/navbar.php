<!--
<nav>
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button type="button" id="mobileMenuBtn" class="relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        <button type="button" class="btn flex justify-end" id="mobileMenuBtnHome" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="fas fa-bars text-white"></i>
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen sm-down">
            <div class="modal-content" style="background-color: #0892d0;">
              <div class="modal-header" style="border-bottom: none;">
                <h1 class="modal-title fs-5 d-none" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn text-white" data-bs-dismiss="modal"><i class="fas fa-close"></i></button>  allineare l'icona di chiusura del modale a destra
                </div>
              <div class="modal-body" style="display: flex; flex-direction: column; justify-content: start; align-items: start; padding: 20px; text-transform: uppercase; text-align: center; gap: 20px;">
                <?php
                  $queryPrendiLink = "SELECT * FROM linknav";
                  $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
                  
                  if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
                      while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                          $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                          $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
                  
                          // Modify the link to include the section ID
                          echo '<a class="btn" href="' . $destLink . '">' . $voceLink . '</a>';
                      }
                  } 
                  else {
                      echo '<p class="text-white text-uppercase">Carica i link</p>';
                  }
                ?>
                <?php // dropdown
            $queryPrendiLinkDropdown = "SELECT * FROM dropdownmenu";
            $resultQueryPrendiLinkDropdown = mysqli_query($conn, $queryPrendiLinkDropdown);

            if ($resultQueryPrendiLinkDropdown && $resultQueryPrendiLinkDropdown->num_rows > 0) {
              echo '<div class="dropdown">';
              echo '<button class="btn bg-white dropdown-toggle text-uppercase" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 8vw;">qualcosa in più</button>';
              echo '<ul class="dropdown-menu">';
              while ($row = mysqli_fetch_assoc($resultQueryPrendiLinkDropdown)) {
                $destLinkDropdown = htmlspecialchars($row["dest_link_dropdown"], ENT_QUOTES, 'UTF-8');
                $voceLinkDropdown = htmlspecialchars($row["voce_link_dropdown"], ENT_QUOTES, 'UTF-8');

                
                echo '<li>';
                echo '<a class="dropdown-item text-black text-start" href="' . $destLinkDropdown . '">' . $voceLinkDropdown . '</a>';
                echo '</li>';
                
              }
              echo '</ul>';
              echo '</div>';
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

      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-end">
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <?php
              $queryPrendiLink = "SELECT * FROM linknav";
              $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
              
              if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
                  while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                      $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                      $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
              
                      // Modify the link to include the section ID
                      echo '<a class="btn" href="' . $destLink . ' ">' . $voceLink . '</a>';
                  }
              } 
              else {
                  echo '<p class="text-white text-uppercase">Carica i link</p>';
              }
            ?>
            <?php // dropdown
            $queryPrendiLinkDropdown = "SELECT * FROM dropdownmenu";
            $resultQueryPrendiLinkDropdown = mysqli_query($conn, $queryPrendiLinkDropdown);

            if ($resultQueryPrendiLinkDropdown && $resultQueryPrendiLinkDropdown->num_rows > 0) {
              echo '<div class="dropdown">';
              echo '<button class="btn bg-white dropdown-toggle text-uppercase" type="button" data-bs-toggle="dropdown" aria-expanded="false">qualcosa in più</button>';
              echo '<ul class="dropdown-menu">';
              while ($row = mysqli_fetch_assoc($resultQueryPrendiLinkDropdown)) {
                $destLinkDropdown = htmlspecialchars($row["dest_link_dropdown"], ENT_QUOTES, 'UTF-8');
                $voceLinkDropdown = htmlspecialchars($row["voce_link_dropdown"], ENT_QUOTES, 'UTF-8');

                
                echo '<li>';
                echo '<a class="dropdown-item text-black text-start" href="' . $destLinkDropdown . '">' . $voceLinkDropdown . '</a>';
                echo '</li>';
                
              }
              echo '</ul>';
              echo '</div>';
            } 
            else {
              echo '<p class="text-white text-uppercase">Carica il dropdown</p>';
            }
            ?>
            <form action="" method="GET" class="formprogettoportfolio">
              <label for="search">Nome progetto</label>
              <input type="search" class="form-control" name="search" id="" placeholder="Cerca un progetto">
            </form>
            <?php
              if(isset($_GET["search"])) {
                $searchQuery = $_GET["search"];

                $searchSql = "SELECT * FROM portfolio WHERE titolo_progetto LIKE '%$searchQuery";
                $searchResult = mysqli_query($conn, $searchSql);

                if($searchResult && $searchResult->num_rows > 0) {
                  while($row = mysqli_fetch_assoc($searchResult)) {
                    echo '<p> ' . $row["titolo_progetto"] . ' </p>';
                  }
                }
              }
            ?>
            <form action="" method="GET" class="formarticoloblog">
              <label for="">Nome progetto</label>
              <input type="search" class="form-control" name="" id="" placeholder="Cerca un articolo">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <?php
        $queryPrendiLink = "SELECT * FROM linknav";
        $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
        
        if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
        
                // Modify the link to include the section ID
                echo '<a class="btn" href="' . $destLink . ' ">' . $voceLink . '</a>';
            }
        } 
        else {
            echo '<p class="text-white text-uppercase">Carica i link</p>';
        }
      ?>
      <form action="" method="GET" class="formprogettoportfolio">
        <label for="">Nome progetto</label>
        <input type="search" class="form-control" name="" id="" placeholder="Cerca un progetto">
      </form>
      <form action="" method="GET" class="formarticoloblog">
        <label for="">Nome progetto</label>
        <input type="search" class="form-control" name="" id="" placeholder="Cerca un articolo">
      </form>
    </div>
  </div>
  <div class="logoutbutton">
    <form action="" method="POST">
      <button type="submit" name="btnlogout" id="controlloPulsanteLogout">Logout</button>
    </form>
  </div>
</nav>
-->