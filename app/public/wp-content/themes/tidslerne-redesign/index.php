<?php get_header(); ?>

        <div class="container mx-auto px-4 py-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $args = array(
              'posts_per_page' => 3,
              'category_name' => '', // replace
              'orderby' => 'date',
              'order' => 'desc'
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
                      <?php the_post_thumbnail('medium', ['class' => 'w-full h-54 object-cover']); ?>
                    <?php else : ?>
                      <?php
                        $content = get_the_content();
                        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
                        if (!empty($matches[1])) :
                      ?>
                        <img src="<?php echo esc_url($matches[1]); ?>" class="w-full h-54 object-cover" alt="">
                      <?php else : ?>
                        <div class="w-full h-54 bg-gray-300"></div>
                      <?php endif; ?>
                    <?php endif; ?>
                  </a>

                  <div class="py-4">
                    <h3 class="text-lg font-bold mb-2">
                      <a href="<?php the_permalink(); ?>" class="text-black hover:text-[#9B2D5C]">
                        <?php echo wp_trim_words(get_the_title(), 10, '...'); ?>
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

        <div class="container mx-auto px-4 py-8">
          <h2 class="text-2xl sm:text-3xl font-bold text-[#9B2D5C] mb-2">Current Events</h2>
          <div class="border-b-2 border-[#9B2D5C] mb-8"></div>
          <div class="flex flex-col gap-8">
            <?php
            $event_args = array(
              'posts_per_page' => 3,
              'category_name' => 'events', // Change to your events category slug
              'orderby' => 'date',
              'order' => 'desc'
            );
            $event_query = new WP_Query($event_args);
            ?>
            <?php if ($event_query->have_posts()) : ?>
              <?php while ($event_query->have_posts()) : $event_query->the_post(); ?>
                <div class="bg-white flex flex-col sm:flex-row items-stretch rounded shadow-sm overflow-hidden">
                  <!-- Image -->
                  <div class="sm:w-1/3 flex-shrink-0 flex items-center justify-center bg-gray-200 min-h-[150px]">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                    <?php else : ?>
                      <div class="w-full h-36 bg-gray-300"></div>
                    <?php endif; ?>
                  </div>
                  <!-- Content -->
                  <div class="sm:w-2/3 flex flex-col sm:flex-row flex-1">
                    <div class="flex-1 px-6 py-4">
                      <h3 class="text-xl font-bold mb-2">"<?php the_title(); ?>"</h3>
                      <div class="flex flex-wrap items-center text-green-600 text-sm mb-2 gap-x-6 gap-y-1">
                        <div class="flex items-center">
                          <span class="iconify mr-1" data-icon="mdi:calendar"></span>
                          <?php echo get_the_date('F j, Y'); ?>
                        </div>
                        <div class="flex items-center">
                          <span class="iconify mr-1" data-icon="mdi:clock-outline"></span>
                          2PM - 4PM
                        </div>
                        <div class="flex items-center">
                          <span class="iconify mr-1" data-icon="mdi:map-marker"></span>
                          Den Lille Keramikskole, Copenhagen
                        </div>
                      </div>
                      <p class="text-sm text-gray-700">
                        <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                      </p>
                    </div>
                    <!-- Price & Reserve -->
                    <div class="flex flex-col items-center justify-center px-6 py-4 min-w-[120px]">
                      <div class="text-[#9B2D5C] text-lg font-bold mb-4">100DKK</div>
                      <a href="#" class="bg-[#9B2D5C] text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-[#7a2348] transition">Reserve</a>
                    </div>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>
            <?php else: ?>
              <p class="text-gray-500">No events found.</p>
            <?php endif; ?>
          </div>
        </div>

<?php get_footer(); ?>