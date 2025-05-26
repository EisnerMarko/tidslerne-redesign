<?php get_header(); ?>


        <section class="container mx-auto px-4 py-8">
          <h2 class="text-2xl sm:text-3xl font-bold text-[#9B2D5C] mb-2">Aktuelle arrangementer</h2>
          <div class="border-b-2 border-[#9B2D5C] mb-8"></div>
          <div class="flex flex-col gap-8">
            <?php
            $today = date('Ymd');
            $event_args = array(
              'post_type'      => 'event',
              'posts_per_page' => 15,
              'orderby'        => 'meta_value',
              'meta_key'       => 'event_start',
              'order'          => 'asc',
              'meta_query'     => array(
                array(
                  'key'     => 'event_start',
                  'value'   => $today,
                  'compare' => '>=',
                  'type'    => 'DATE'
                ),
              ),
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
                        <a href="<?php echo esc_url($event_link); ?>" target="_blank" class="bg-[#9B2D5C] text-white px-6 py-2 rounded-lg font-extrabold text-sm hover:bg-[#7a2348] transition">Reserve</a>
                    </div>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>
            <?php else: ?>
              <p class="text-black">No events found.</p>
            <?php endif; ?>
          </div>
        </section>


<?php get_footer(); ?>