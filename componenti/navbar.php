<nav> <!-- bg-rose-700 -->
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <!-- Mobile menu button -->
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
      <button type="button" id="mobileMenuBtn" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
           <!-- Icon when menu is closed -->
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
           <!-- Icon when menu is open --> 
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        <!-- Button trigger modal -->
<button type="button" class="btn flex justify-end" id="mobileMenuBtnHome" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <i class="fas fa-bars text-white"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen sm-down">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
        <h1 class="modal-title fs-5 d-none" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn bg-red-300" data-bs-dismiss="modal">Close</button>
      </div>
      <div class="modal-body" style="display: flex; flex-direction: column; justify-content: start; align-items: start; padding: 20px; text-transform: uppercase; text-align: start; gap: 20px;">
      <?php
              $queryPrendiLink = "SELECT * FROM linknav";
              $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);

              if($resultQueryPrendiLink->num_rows > 0) {
                while($row = $resultQueryPrendiLink->fetch_assoc()) {
                    echo '<a class="btn" href=" ' . $row["dest_link"] . ' " style="border-bottom: 2px solid black; border-radius: 0px; min-width: 100%; display: flex; flex-direction: column; justify-content: start; align-items: start;"> ' . $row["voce_link"] . ' </a>';
                }
              }
            ?>
      </div>
    </div>
  </div>
</div>
        <!--
          <button type="button" id="mobileMenuBtn" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
           Icon when menu is closed
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
           Icon when menu is open 
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        -->
      </div>

      <!-- Navigation links -->
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-end">
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
          <?php
              $queryPrendiLink = "SELECT * FROM linknav";
              $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);

              if($resultQueryPrendiLink->num_rows > 0) {
                while($row = $resultQueryPrendiLink->fetch_assoc()) {
                    echo '<a class="btn" href=" ' . $row["dest_link"] . ' "> ' . $row["voce_link"] . ' </a>';
                }
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
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
    <?php
              $queryPrendiLink = "SELECT * FROM linknav";
              $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);

              if($resultQueryPrendiLink->num_rows > 0) {
                while($row = $resultQueryPrendiLink->fetch_assoc()) {
                    echo '<a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href=" ' . $row["dest_link"] . ' "> ' . $row["voce_link"] . ' </a>';
                }
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