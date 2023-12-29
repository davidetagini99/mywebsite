<nav class="bg-sky-400 md:p-5 md:flex md:flex-row md:justify-end md:align-middle p-2">


<!-- drawer init and toggle -->
<div class="text-center md:hidden flex flex-row justify-end align-middle">
   <button class="p-3 rounded-lg text-white text-center" type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
      <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
   </button>
</div>

<!-- drawer component -->
<div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-sky-400 w-full dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
   <h5 id="drawer-label" class="hidden items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>Info</h5>
   <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-white bg-transparent rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">Close menu</span>
   </button>
      
   <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 hidden">Supercharge your hiring by taking advantage of our <a href="#" class="text-blue-600 underline dark:text-blue-500 hover:no-underline">limited-time sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked candidates and the #1 design job board.</p>
   <div class=" gap-4 h-full">
      <div class="h-full flex flex-col p-2 gap-2 bg-sky-400 justify-center align-middle w-full">
      <?php
                  $queryPrendiLink = "SELECT * FROM linknav";
                  $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
                  
                  if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
                      while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                          $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                          $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
                  
                          // Modify the link to include the section ID
                          echo '<a class="text-center border-b-2 border-white text-white p-2 uppercase" href="' . $destLink . '">' . $voceLink . '</a>';
                      }
                  } 
                  else {
                      echo '<p class="text-white text-uppercase">Carica i link</p>';
                  }
                ?>
      </div>
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
  </svg></a>
   </div>
</div>

  <ul class="hidden md:flex">
    <li>
    <?php
                  $queryPrendiLink = "SELECT * FROM linknav";
                  $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
                  
                  if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
                      while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                          $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                          $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
                  
                          // Modify the link to include the section ID
                          echo '<a class="text-white hover:bg-white hover:text-sky-500 focus:bg-white focus:text-sky-500 focus:border-2 focus:border-white rounded-md px-3 py-2 text-sm font-medium uppercase" href="' . $destLink . '">' . $voceLink . '</a>';
                      }
                  } 
                  else {
                      echo '<p class="text-white text-uppercase">Carica i link</p>';
                  }
                ?>
    </li>
  </ul>
</nav>