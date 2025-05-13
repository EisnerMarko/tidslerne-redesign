<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.2.1/iconify.min.js"></script>
  <title><?php bloginfo("name"); ?></title>
  <meta name="description" content="<?php bloginfo("description"); ?>">
  <link rel="icon" href="" type="">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> class="w-full h-full">
  <div class="">
    <header class="w-full h-16 flex items-center justify-between bg-white px-2 sm:px-4 lg:px-12 mt-2">

      <button id="menu-toggle" aria-expanded="false" aria-controls="mobile-menu">
        <span id="menu-icon" class="iconify text-black text-4xl" data-icon="mdi:menu"></span>
      </button>

      <nav id="mobile-menu" class="absolute top-0 left-0 w-1/5 h-full bg-white z-50">
          <div class="flex items-center justify-between px-4 py-4">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/css/img/tidslerne_logo.png'); ?>" alt="Tidslerne Logo" class="h-8 w-auto">
            </a>
            <button id="menu-close" class="text-black text-4xl">
              <span class="iconify" data-icon="mdi:close"></span>
            </button>
          </div>
          <ul class="flex flex-col mt-4">
            <li class="px-4 py-2 text-xl font-bold">Tidslerne</li>
            <li class="px-4 py-2 text-xl font-bold">Behandlinger</li>
            <li class="px-4 py-2 text-xl font-bold">Kost & krop</li>
            <li class="relative">
              <button id="dropdown-toggle" class="w-full px-4 py-2 text-xl font-bold bg-[#9B2D5C] text-white flex justify-between items-center">
                Arrangementer
                <span class="iconify text-white text-lg" data-icon="mdi:chevron-down"></span>
              </button>
              <ul id="dropdown-menu" class="hidden flex flex-col bg-[#9B2D5C] text-white">
                <li class="px-4 py-2 text-sm">subcategory1</li>
                <li class="px-4 py-2 text-sm">subcategory2</li>
              </ul>
            </li>
            <li class="px-4 py-2 text-xl font-bold">Info</li>
          </ul>
      </nav>


      <a href="<?php echo esc_url(home_url('/')); ?>" class="sm:pl-40 lg:pl-110">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/css/img/tidslerne_logo.png'); ?>" alt="Tidslerne Logo" class="h-12 w-auto">
      </a>

      <a href="<?php echo esc_url(home_url('/')); ?>">
        <button class="h-8 w-24 sm:w-36 bg-[#9B2D5C] rounded-lg flex items-center justify-center text-white text-sm font-bold">
          Log In
        </button>
      </a>

      <button id="">
        <span id="" class="iconify text-black text-4xl" data-icon="mdi:search"></span>
      </button>

    </header>