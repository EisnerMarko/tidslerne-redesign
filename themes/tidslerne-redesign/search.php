<?php get_header(); ?>

<section class="container mx-auto px-4 py-8 max-w-5xl">
  <h1 class="text-3xl font-extrabold mb-8 text-[#9B2D5C]">Søgeresultater for: <span class="font-normal"><?php echo get_search_query(); ?></span></h1>

  <?php if (have_posts()) : ?>
    <ul class="space-y-8">
      <?php while (have_posts()) : the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>" class="block bg-white shadow p-6 hover:bg-gray-300 transition no-underline">
            <h2 class="text-2xl font-bold text-[#9B2D5C] mb-2 no-underline"><?php the_title(); ?></h2>
            <div class="text-sm text-gray-500 mb-2">
              <?php the_time('j. F Y'); ?>
              <?php
                $categories = get_the_category();
                if (!empty($categories)) {
                  echo ' | ';
                  foreach ($categories as $index => $cat) {
                    echo '<span class="text-[#9B2D5C] hover:text-green-600 transition-colors">' . esc_html($cat->name) . '</span>';
                    if ($index < count($categories) - 1) {
                      echo ', ';
                    }
                  }
                }
              ?>
            </div>
            <div class="text-base text-black mb-2">
              <?php the_excerpt(); ?>
            </div>
            <?php
              $event_headline = get_field('event_headline');
              if ($event_headline) {
                echo '<div class="text-sm text-[#9B2D5C] font-semibold mb-1">Event: ' . esc_html($event_headline) . '</div>';
              }
              $event_start = get_field('event_start');
              if ($event_start) {
                echo '<div class="text-xs text-gray-500 mb-1">Start: ' . esc_html($event_start) . '</div>';
              }
              $event_adress = get_field('event_adress');
              if ($event_adress) {
                echo '<div class="text-xs text-gray-500 mb-1">Adresse: ' . esc_html($event_adress) . '</div>';
              }
            ?>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>

    <div class="mt-10">
      <?php the_posts_pagination([
        'mid_size'  => 2,
        'prev_text' => __('« Forrige', 'textdomain'),
        'next_text' => __('Næste »', 'textdomain'),
      ]); ?>
    </div>
  <?php else : ?>
    <div class="bg-white shadow p-6 text-center">
      <h2 class="text-xl font-bold mb-2 text-[#9B2D5C]">Ingen resultater</h2>
      <p class="text-gray-700 mb-4">Prøv et andet søgeord.</p>
      <form role="search" method="get" class="flex gap-2 justify-center" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" class="border border-gray-300 px-3 py-2 focus:outline-none" placeholder="Søg…" value="<?php echo get_search_query(); ?>" name="s" autofocus />
        <button type="submit" class="bg-[#9B2D5C] text-white rounded-lg px-4 py-2 font-bold hover:bg-[#7a2348] transition cursor-pointer">Søg</button>
      </form>
    </div>
  <?php endif; ?>
</section>

<?php get_footer(); ?>