<?php get_header(); ?>

        <section class="relative w-full min-h-[420px] md:min-h-[560px] flex items-center justify-center bg-white overflow-hidden">
          <?php
            $hero_image = get_field('hero_image');
            $hero_headline = get_field('hero_headline');
            $hero_subheadline = get_field('hero_subheadline');
            $hero_button_text = get_field('hero_button_text');
            $hero_button_link = get_field('hero_button_link');
          ?>
          <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>"
                alt="<?php echo esc_attr($hero_image['alt'] ?? 'Hero'); ?>"
                class="absolute inset-0 w-full h-full object-cover object-center z-0" />
            <div class="absolute inset-0 bg-gradient-to-r from-white/80 via-white/60 to-[#9B2D5C]/55 z-10"></div>
          <?php endif; ?>
          <div class="relative z-20 flex flex-col md:flex-row items-center justify-center w-full max-w-7xl mx-auto px-2 py-10 md:py-20">
            <div class="w-full md:w-2/5 flex-shrink-0 mb-8 md:mb-0">
              
            </div>
            <div class="w-full md:w-3/5 flex flex-col items-center justify-center text-center min-h-full h-full">
              <?php if ($hero_headline): ?>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-[#9B2D5C] mb-4 leading-tight">
                  <?php echo esc_html($hero_headline); ?>
                </h1>
              <?php endif; ?>
              <?php if ($hero_subheadline): ?>
                <p class="text-black text-base md:text-lg mb-4 font-bold">
                  <?php echo esc_html($hero_subheadline); ?>
                </p>
              <?php endif; ?>
              <?php if ($hero_button_text && $hero_button_link): ?>
                <a href="<?php echo esc_url($hero_button_link); ?>"
                  class="inline-block bg-green-600 hover:bg-green-800 text-white px-6 py-2 rounded-lg font-semibold transition text-base shadow-md">
                  <?php echo esc_html($hero_button_text); ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </section>

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
                    <div class="text-[#9B2D5C] text-sm uppercase px-4 py-2 border-b-2 border-[#9B2D5C] mb-2 sm:mb-4">
                        <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                foreach ($categories as $index => $cat) {
                                    echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="cursor-pointer hover:text-green-600 transition-colors">' . esc_html($cat->name) . '</a>';
                                    if ($index < count($categories) - 1) {
                                        echo '<span class="text-[#9B2D5C]">, </span>';
                                    }
                                }
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
                        <img src="<?php echo esc_url($matches[1]); ?>" class="w-full h-54 object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" alt="">
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
                      <time class="mr-4" datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date(); ?>
                      </time>
                      <span class="iconify mr-1" data-icon="uil:comment"></span>
                        <?php
                          $comments_count = get_comments_number();
                          echo $comments_count;
                        ?>
                    </div>

                    <p class="text-sm text-black">
                      <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                    </p>
                  </div>
                </div>
              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
            <?php endif; ?>
          </div>
        </section>

        <section class="container mx-auto px-4 py-8">
          <h2 class="text-2xl sm:text-3xl font-bold text-[#9B2D5C] mb-2">Aktuelle arrangementer</h2>
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
                      <img src="<?php echo esc_url($event_image['url']); ?>" alt="<?php echo esc_attr($event_image['alt'] ?? 'Event image'); ?>" class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" />
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
        
        <section class="bg-[#9B2D5C] py-16 px-8">
          <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-24">
            <div class="flex-1 mb-2 md:mb-0 px-4 md:px-0">
              <h2 class="text-3xl font-bold text-white mb-6">JOIN US!</h2>
              <p class="text-lg text-white mb-6">
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