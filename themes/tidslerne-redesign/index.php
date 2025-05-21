<?php get_header(); ?>

        <section class="container mx-auto px-4 py-8">
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

                    <p class="text-sm text-black">
                      <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                    </p>
                  </div>
                </div>
              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
            <?php endif; ?>
          </div>
        </section>

        <section class="container mx-auto px-4 py-8">
          <h2 class="text-2xl sm:text-3xl font-bold text-[#9B2D5C] mb-2">Current Events</h2>
          <div class="border-b-2 border-[#9B2D5C] mb-8"></div>
          <div class="flex flex-col gap-8">
            <?php
            $event_args = array(
              'post_type'      => 'event',
              'posts_per_page' => 3,
              'orderby'        => 'meta_value',
              'meta_key'       => 'event_start',
              'order'          => 'asc'
            );
            $event_query = new WP_Query($event_args);
            ?>
            <?php if ($event_query->have_posts()) : ?>
              <?php while ($event_query->have_posts()) : $event_query->the_post(); ?>
                <?php
                  $event_headline = get_field('event_headline');
                  $event_image = get_field('event_image');
                  $event_start = get_field('event_start');
                  $event_end = get_field('event_end');
                  $event_start_time = get_field('event_start_time');
                  $event_end_time = get_field('event_end_time');
                  $event_adress = get_field('event_adress');
                  $event_description = get_field('event_description');
                  $event_price = get_field('event_price');
                  $event_link = get_field('event_link');
                ?>
                <div class="bg-white flex flex-col md:flex-row items-stretch">
                  <div class="md:w-1/3 flex-shrink-0 flex items-center justify-center bg-gray-200 min-h-[150px]">
                      <img src="<?php echo esc_url($event_image['url']); ?>" alt="<?php echo esc_attr($event_image['alt'] ?? 'Event image'); ?>" class="w-full h-full object-cover" />
                  </div>
                  <div class="md:w-2/3 flex flex-col md:flex-row flex-1">
                    <div class="flex-1 px-6 py-4">
                      <h3 class="text-xl font-bold mb-2">
                        "<?php echo esc_html($event_headline); ?>"
                      </h3>
                      <div class="flex flex-wrap items-center text-green-600 text-sm gap-x-6 gap-y-1">
                        <div class="flex items-center mb-2">
                          <span class="iconify mr-1" data-icon="mdi:calendar"></span>
                          <?php
                            echo date_i18n('F j, Y', strtotime($event_start));
                            if ($event_end) {
                              echo ' - ' . date_i18n('F j, Y', strtotime($event_end));
                            }
                          ?>
                        </div>
                        <div class="flex items-center mb-2">
                          <span class="iconify mr-1" data-icon="mdi:clock-outline"></span>
                          <?php echo esc_html($event_start_time); ?>
                          <?php
                            if ($event_end_time) {
                              echo ' - ' . esc_html($event_end_time);
                            }
                          ?>
                        </div>
                        <div class="flex items-center mb-2">
                          <span class="iconify mr-1" data-icon="mdi:map-marker"></span>
                          <?php echo esc_html($event_adress); ?>
                        </div>
                      </div>
                      <p class="text-sm text-black">
                        <?php echo wp_trim_words($event_description, 50, '...'); ?>
                      </p>
                    </div>
                    <div class="flex flex-col items-center justify-center px-6 py-4 min-w-[120px]">
                      <div class="text-[#9B2D5C] text-lg font-bold mb-4">
                        <?php echo esc_html($event_price); ?> DKK
                      </div>
                        <a href="<?php echo esc_url($event_link); ?>" target="_blank" class="bg-[#9B2D5C] text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-[#7a2348] transition">Reserve</a>
                    </div>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>
            <?php else: ?>
              <p class="text-black">No events found.</p>
            <?php endif; ?>
          </div>
        </section>
        
        <section class="bg-[#9B2D5C] py-16 px-8">
          <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-24">
            <div class="flex-1 mb-2 md:mb-0 px-4 md:px-0">
              <h2 class="text-3xl font-bold text-black mb-6">JOIN US!</h2>
              <p class="text-lg text-black mb-6">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sunt voluptate alias consectetur voluptatem praesentium quae perspiciatis, sequi quidem, cumque amet porro eligendi quos dolorem fugiat quod ducimus quas incidunt!<br>
                <span class="font-bold">SIGN UP TO RECEIVE UPDATES ON OUR CAMPAIGNS.</span>
              </p>
            </div>
            <div class="flex-1">
              <?php echo do_shortcode('[mc4wp_form id="55"]'); ?>
            </div>
          </div>
        </section>

<?php get_footer(); ?>