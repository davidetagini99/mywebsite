<footer class="bg-sky-400 shadow dark:bg-gray-900">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between flex flex-row justify-center align-middle">
            <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 hidden" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white hidden">Flowbite</span>
            </a>
            <ul class="flex flex-row justify-center align-middle md:flex md:flex-row md:justify-center md:align-middle">
                <li>
                <?php
                  $queryPrendiLink = "SELECT * FROM linknav";
                  $resultQueryPrendiLink = mysqli_query($conn, $queryPrendiLink);
                  
                  if ($resultQueryPrendiLink && $resultQueryPrendiLink->num_rows > 0) {
                      while ($row = mysqli_fetch_assoc($resultQueryPrendiLink)) {
                          $destLink = htmlspecialchars($row["dest_link"], ENT_QUOTES, 'UTF-8');
                          $voceLink = htmlspecialchars($row["voce_link"], ENT_QUOTES, 'UTF-8');
                  
                          // Modify the link to include the section ID
                          echo '<a class="hover:underline me-4 md:me-6 text-white text-sm" href="' . $destLink . '">' . $voceLink . '</a>';
                      }
                  } 
                  else {
                      echo '<p class="text-white text-uppercase">Carica i link</p>';
                  }
                ?>
                </li>
                <!--
                    <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
                -->
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400 text-center">
            <?php
                $annoCorrente = date('Y');

                echo '<p class="text-white">@Davide Tagini ' . $annoCorrente . ' </p>';
            ?>
        </span>
    </div>
</footer>

