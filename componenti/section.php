<div class="flex flex-col justify-start align-top p-5">
    <section>
        <div>
            <p class="p-5 uppercase font-bold text-xl">
            <?php
                    // Assuming $titolText is user input from the database
                    echo htmlspecialchars($titleText, ENT_QUOTES, 'UTF-8');
                ?>
            </p>
        </div>
        <div>
            <p class="w-5/7 p-5 text-justify md:w-2/5">
                <?php
                    // Assuming $sectionText is user input from the database
                    echo htmlspecialchars($sectionText, ENT_QUOTES, 'UTF-8');
                ?>
            </p>
                <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Immagine sezione" class="hidden">
        </div>
    </section>
</div>