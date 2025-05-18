<footer class="bg-black text-white py-6 lg:px-4 lg:px-12">

        <div class="flex flex-col sm:flex-row justify-center items-center">
          <div class="sm:w-1/3 text-center flex flex-col items-center">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/css/img/tidslerne_logo_white.png'); ?>" alt="Tidslerne Logo" class="mb-4 h-16 w-auto">
            <p class="text-sm leading-relaxed px-4 lg:px-14 mb-8">
              Kræftforeningen Tidslerne er en forening for tidligere og nuværende kræftpatienter samt deres pårørende og i øvrigt enhver, der ønsker at støtte et forum for samspillet mellem den konventionelle og alternative behandling af kræftsyge mennesker. Vi tæller ca 2.200 medlemmer primo 2022. Foreningen er  finansieret ved tilskud fra fonde, puljemidler samt medlemsbidrag i form af kontingenter, frivillige bidrag og arv.
            </p>
          </div>

          <div class="sm:w-1/3 text-center lg:text-left mb-8 lg:mb-0 lg:mr-12 flex flex-col items-center">
            <h3 class="text-3xl font-bold mb-4">Contact Us</h3>
            <ul class="space-y-2 text-sm">
              <li class="flex items-center">
                <span class="iconify mr-2 text-2xl" data-icon="fluent:location-12-regular"></span>
                Ådalsparken 29, 6710 Esbjerg V
              </li>
              <li class="flex items-center">
                <span class="iconify mr-2 text-2xl" data-icon="akar-icons:paper"></span>
                1742 0291
              </li>
              <li class="flex items-center">
                <span class="iconify mr-2 text-2xl" data-icon="mdi:phone"></span>
                7020-0515
              </li>
              <li class="flex items-center">
                <span class="iconify mr-2 text-2xl" data-icon="material-symbols:policy"></span>
                 <a href="<?php echo esc_url(get_permalink(get_page_by_path('policy'))); ?>">Vedtægter,&nbsp;</a>
                 <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">Privatlivspolitik</a>
              </li>
              <li class="flex items-center">
                <span class="iconify mr-2 text-2xl" data-icon="mdi:email"></span>
                <a href="mailto:sekretariat@tidslerne.dk">sekretariat@tidslerne.dk</a>
              </li>
              <li class="flex items-center">
                <span class="iconify mr-2 text-2xl" data-icon="icon-park-outline:transaction"></span>
                <a href="mailto:kasserer@tidslerne.dk">kasserer@tidslerne.dk</a>
              </li>
            </ul>
          </div>

          <div class="flex items-center justify-center lg:mr-32">
            <a href="#" class="cursor-pointer">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/css/img/merch_tidslerne.jpg'); ?>" alt="Merchandise" class="w-auto h-65">
            </a>
          </div>
        </div>
      </footer>
    </div>
    <?php wp_footer(); //need to fix for ipad?>
</body>
</html>