<?php get_header(); ?>

        <?php
        $all_categories = get_categories();
        $current_category = get_queried_object();

        $order = 'desc';
        if (isset($_GET['order'])) {
          $order = $_GET['order'] === 'asc' ? 'asc' : 'desc';
          // Redirect to clean URL after applying order
          $redirect_url = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
          header("Location: $redirect_url");
          exit;
        } elseif (isset($_COOKIE['order'])) {
          $order = $_COOKIE['order'] === 'asc' ? 'asc' : 'desc';
        }
        ?>
        <script>
          // Always sync localStorage to cookie for PHP fallback
          document.cookie = "order=" + (localStorage.getItem('order') || 'desc') + "; path=/";
        </script>

        <?php
        $selected_cat_slug = isset($_GET['cat']) && $_GET['cat'] ? sanitize_text_field($_GET['cat']) : ($current_category && property_exists($current_category, 'slug') ? $current_category->slug : '');

        $args = array(
          'posts_per_page' => 12,
          'orderby' => 'date',
          'order' => $order,
        );

        if ($selected_cat_slug) {
          $args['category_name'] = $selected_cat_slug;
        }

        $query = new WP_Query($args);
        ?>
        <div class="flex flex-col sm:flex-row gap-6 container mx-auto px-4 pt-8 mb-8">
          <!-- Categories Dropdown -->
          <div class="flex items-center">
            <label class="sr-only" for="cat-select">Categories</label>
            <div class="relative">
              <select id="cat-select"
                class="appearance-none border border-gray-300 px-6 py-3 bg-transparent text-black text-base pr-10 focus:outline-none focus:ring-2 focus:ring-[#9B2D5C] min-w-56 cursor-pointer"
                onchange="if(this.value) window.location.href=this.value;">
                <option value="<?php echo site_url('/category/'); ?>" <?php if (!$selected_cat_slug) echo 'selected'; ?>>
                  All
                </option>
                <?php foreach ($all_categories as $cat): ?>
                  <option value="<?php echo esc_url(get_category_link($cat->term_id)); ?>" <?php if ($current_category && $current_category->term_id === $cat->term_id) echo 'selected'; ?>>
                    <?php echo esc_html($cat->name); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <span class="pointer-events-none absolute right-4 top-1/2 transform -translate-y-1/2 text-black">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M19 9l-7 7-7-7"/>
                </svg>
              </span>
            </div>
          </div>

          <button id="order-toggle"
            class="border border-gray-300 px-6 py-3 rounded-none bg-white font-bold text-black text-base flex items-center gap-2 w-56 justify-between focus:outline-none focus:ring-2 focus:ring-[#9B2D5C]">
            By Date
            <span id="order-arrow" class="inline-block transition-transform duration-200">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7"/>
              </svg>
            </span>
          </button>
        <script>
          document.cookie = "order=" + (localStorage.getItem('order') || 'desc') + "; path=/";
          let order = localStorage.getItem('order') || 'desc';
          const btn = document.getElementById('order-toggle');
          const arrow = document.getElementById('order-arrow');
          if(order === 'asc') arrow.classList.add('rotate-180');
          btn.onclick = function() {
            order = (order === 'desc') ? 'asc' : 'desc';
            localStorage.setItem('order', order);
            location.reload();
          }
        </script>
        </div>


        <div class="container mx-auto px-4 py-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
        </div>


<?php get_footer(); ?>