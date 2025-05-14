<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php
    $args = array(
      'posts_per_page' => 3,
    );
    $query = new WP_Query($args);
    ?>
    <?php if ($query->have_posts()) : ?>
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <div class="bg-white overflow-hidden">
            <div class="text-[#9B2D5C] text-sm font-bold uppercase px-4 py-2 border-b-2 border-[#9B2D5C] mb-2 sm:mb-4">
                <?php
                    $category = get_the_category();
                    if (!empty($category)) {
                    echo esc_html($category[0]->name);
                    }
                ?>
            </div>

          <a href="<?php the_permalink(); ?>" class="block">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
            <?php else : ?>
              <div class="w-full h-48 bg-gray-300"></div>
            <?php endif; ?>
          </a>

          <div class="p-4">
            <h3 class="text-lg font-bold mb-2">
              <a href="<?php the_permalink(); ?>" class="text-black hover:text-[#9B2D5C]">
                <?php the_title(); ?>
              </a>
            </h3>

            <div class="flex items-center text-sm text-green-600 mb-2">
              <span class="iconify mr-1" data-icon="mdi:calendar"></span>
              <time datetime="<?php echo get_the_date('c'); ?>">
                <?php echo get_the_date(); ?>
              </time>
            </div>

            <p class="text-sm text-gray-700">
              <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </p>
          </div>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>