<?php get_header(); ?>

<div class="container mx-auto px-4 py-8 max-w-5xl">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="mb-2">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                foreach ($categories as $index => $cat) {
                    echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="text-[#9B2D5C] font-bold text-sm uppercase cursor-pointer hover:text-green-600 transition-colors">' . esc_html($cat->name) . '</a>';
                    if ($index < count($categories) - 1) {
                        echo '<span class="text-[#9B2D5C]">, </span>';
                    }
                }
            }
            ?>
        </div>

        <h1 class="text-3xl font-extrabold mb-2"><?php the_title(); ?></h1>
        
        <div class="border-b border-black mb-6"></div>

        <div class="prose max-w-none text-base mb-8">
            <?php the_content(); ?>
        </div>

        <?php comments_template(); ?>

        <?php
        $current_post_id = get_the_ID();
        $categories = get_the_category();
        $cat_ids = [];
        if (!empty($categories)) {
            foreach ($categories as $cat) {
                $cat_ids[] = $cat->term_id;
            }
        }

        $args = array(
            'posts_per_page' => 3,
            'category__in'   => $cat_ids,
            'post__not_in'   => array($current_post_id),
            'orderby'        => 'rand'
        );
        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()) : ?>
            <h2 class="text-3xl font-extrabold mb-2 mt-12">Andre relevante indlæg</h2>
            <div class="border-b border-black mb-2"></div>
            <section class="container mx-auto py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
            </div>
            </section>
        <?php endif; ?>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>