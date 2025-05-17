<?php get_header(); ?>

        <?php
        $all_categories = get_categories();
        $current_category = get_queried_object();
        $current_order = isset($_GET['order']) && $_GET['order'] === 'asc' ? 'asc' : 'desc';

        // Use selected category from dropdown if set, otherwise use current category
        $selected_cat_slug = isset($_GET['cat']) && $_GET['cat'] ? sanitize_text_field($_GET['cat']) : ($current_category && property_exists($current_category, 'slug') ? $current_category->slug : '');

        $args = array(
          'posts_per_page' => 12,
          'orderby' => 'date',
          'order' => $current_order,
        );

        if ($selected_cat_slug) {
          $args['category_name'] = $selected_cat_slug;
        }

        $query = new WP_Query($args);
        ?>
        <div class="flex flex-col sm:flex-row gap-6 container mx-auto px-4 pt-8 mb-8">
          <!-- Categories Dropdown -->
          <form method="get" class="flex items-center">
            <label class="sr-only" for="cat-select">Categories</label>
            <div class="relative">
              <select id="cat-select" name="cat" onchange="this.form.submit()"
                class="appearance-none border border-gray-300 px-6 py-3 bg-transparent text-black text-base pr-10 focus:outline-none focus:ring-2 focus:ring-[#9B2D5C] min-w-56 cursor-pointer">
                <?php foreach ($all_categories as $cat): ?>
                  <option value="<?php echo esc_attr($cat->slug); ?>" <?php if ($current_category && $current_category->slug === $cat->slug) echo 'selected'; ?>>
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
            <?php if ($current_order): ?>
              <input type="hidden" name="order" value="<?php echo esc_attr($current_order); ?>">
            <?php endif; ?>
          </form>

          <!-- Order By Date Button -->
          <form method="get" class="flex items-center">
            <?php if ($current_category): ?>
              <input type="hidden" name="cat" value="<?php echo esc_attr($current_category->slug); ?>">
            <?php endif; ?>
            <button type="submit" name="order" value="<?php echo $current_order === 'desc' ? 'asc' : 'desc'; ?>"
              class="border border-gray-300 px-6 py-3 bg-transparent text-black text-base flex items-center gap-2 w-56 justify-between focus:outline-none focus:ring-2 focus:ring-[#9B2D5C]">
              By Date
              <span class="inline-block transition-transform duration-200 <?php echo $current_order === 'asc' ? 'rotate-180' : ''; ?>">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M19 9l-7 7-7-7"/>
                </svg>
              </span>
            </button>
          </form>
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