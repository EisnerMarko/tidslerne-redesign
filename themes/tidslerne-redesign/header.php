<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.2.1/iconify.min.js"></script>
  <title><?php bloginfo("name"); ?></title>
  <meta name="description" content="<?php bloginfo("description"); ?>">
  <link rel="icon" href="<?php echo get_template_directory_uri() . '/css/img/tidslerne_logo_white_square.png' ?>" type="image/png">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> class="w-full h-full">
  <div class="">
    <header class="w-full h-16 flex items-center justify-between bg-white px-2 sm:px-4 lg:px-12">

      <button id="menu-toggle" aria-expanded="false" aria-controls="side-menu">
        <span class="iconify text-black text-4xl cursor-pointer" data-icon="mdi:menu"></span>
      </button>

      <nav id="side-menu" class="absolute top-0 left-0 w-93 h-full bg-white z-50 hidden transform -translate-x-full transition-transform duration-300">
          <div class="flex items-center justify-between px-4 py-4">

            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/css/img/tidslerne_logo.png'); ?>" alt="Tidslerne Logo" class="h-8 w-auto">
            </a>

            <button id="menu-close" class="text-black text-4xl cursor-pointer">
              <span class="iconify" data-icon="mdi:close"></span>
            </button>

          </div>
          
          <ul class="flex flex-col mt-4">

            <li class="relative">
              <button id="dropdown-toggle" class="w-full px-4 py-2 text-xl font-bold bg-white text-black flex justify-between items-center cursor-pointer">
                Tidslerne
                <span id="dropdown-arrow" class="iconify text-black text-lg" data-icon="mdi:chevron-down"></span>
              </button>
              <ul id="dropdown-menu" class="hidden overflow-hidden transition-all duration-300 ease-in-out flex flex-col bg-[#9B2D5C] text-white">
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('uncategorized')->term_id)); ?>">uncategorized</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(home_url('/arrangementer/subcategory2')); ?>">subcategory2</a>
                </li>
              </ul>
            </li>

            <li class="relative">
              <button id="dropdown-toggle" class="w-full px-4 py-2 text-xl font-bold bg-white text-black flex justify-between items-center cursor-pointer">
                Behandlinger
                <span id="dropdown-arrow" class="iconify text-black text-lg" data-icon="mdi:chevron-down"></span>
              </button>
              <ul id="dropdown-menu" class="hidden overflow-hidden transition-all duration-300 ease-in-out flex flex-col bg-[#9B2D5C] text-white">
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('konventionel')->term_id)); ?>">Konventionel</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('komplementaer-behandling')->term_id)); ?>">Komplementær behandling</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('behandling-i-udlandet')->term_id)); ?>">Behandling i udlandet</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('cannabis')->term_id)); ?>">Cannabis</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('patienthistorier')->term_id)); ?>">Patienthistorier</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('senskader')->term_id)); ?>">Følge og senskader</a>
                </li>
              </ul>
            </li>

            <li class="relative">
              <button id="dropdown-toggle" class="w-full px-4 py-2 text-xl font-bold bg-white text-black flex justify-between items-center cursor-pointer">
                Kost & krop
                <span id="dropdown-arrow" class="iconify text-black text-lg" data-icon="mdi:chevron-down"></span>
              </button>
              <ul id="dropdown-menu" class="hidden overflow-hidden transition-all duration-300 ease-in-out flex flex-col bg-[#9B2D5C] text-white">
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('budwig-kuren')->term_id)); ?>">Budwig kuren</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('kostraad')->term_id)); ?>">Kostråd</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('vitaminer-og-mineraler')->term_id)); ?>">Vitaminer og mineraler</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_category_link(get_category_by_slug('kropsligt')->term_id)); ?>">Kropsligt</a>
                </li>
              </ul>
            </li>

            <li class="relative"> 
              <button id="dropdown-toggle" class="w-full px-4 py-2 text-xl font-bold bg-white text-black flex justify-between items-center cursor-pointer">
                Arrangementer
                <span id="dropdown-arrow" class="iconify text-black text-lg" data-icon="mdi:chevron-down"></span>
              </button>
              <ul id="dropdown-menu" class="hidden overflow-hidden transition-all duration-300 ease-in-out flex flex-col bg-[#9B2D5C] text-white">
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(home_url('/arrangementer/subcategory1')); ?>">subcategory1</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(home_url('/arrangementer/subcategory2')); ?>">subcategory2</a>
                </li>
              </ul>
            </li>

            <li class="relative">
              <button id="dropdown-toggle" class="w-full px-4 py-2 text-xl font-bold bg-white text-black flex justify-between items-center cursor-pointer">
                Info
                <span id="dropdown-arrow" class="iconify text-black text-lg" data-icon="mdi:chevron-down"></span>
              </button>
              <ul id="dropdown-menu" class="hidden overflow-hidden transition-all duration-300 ease-in-out flex flex-col bg-[#9B2D5C] text-white">
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_permalink(get_page_by_path('policy'))); ?>">Vedtægter</a>
                </li>
                <li class="px-6 py-2 text-sm">
                  <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">Privatlivspolitik</a>
                </li>
              </ul>
            </li>

          </ul>
      </nav>


      <a href="<?php echo esc_url(home_url('/')); ?>" class="sm:pl-40 lg:pl-110">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/css/img/tidslerne_logo.png'); ?>" alt="Tidslerne Logo" class="h-12 w-auto">
      </a>

      <a href="<?php echo is_user_logged_in() ? esc_url(home_url('/user')) : esc_url(home_url('/login')); ?>">
        <button class="h-8 w-24 sm:w-36 bg-[#9B2D5C] rounded-lg flex items-center justify-center text-white text-sm font-bold cursor-pointer hover:bg-[#7a2348] transition">
          Log In
        </button>
      </a>

      <button id="">
        <span id="" class="iconify text-black text-4xl cursor-pointer" data-icon="mdi:search"></span>
      </button>

    </header>