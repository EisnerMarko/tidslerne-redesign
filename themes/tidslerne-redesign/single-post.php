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

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>