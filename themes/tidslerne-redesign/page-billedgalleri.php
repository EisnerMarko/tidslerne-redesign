<?php get_header(); ?>


    <div class="container mx-auto px-4 py-8 max-w-7xl">

        <h1 class="text-3xl font-extrabold mb-2"><?php the_title(); ?></h1>

        <div class="border-b border-black mb-6"></div>

        <div class="prose max-w-none text-base mb-8">
            <?php
            $images = [];
            $post_query = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 25,
                'orderby'        => 'rand',
                'post_status'    => 'publish',
            ]);
            if ($post_query->have_posts()) {
                while ($post_query->have_posts()) {
                    $post_query->the_post();
                    if (has_post_thumbnail()) {
                        $images[] = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    } else {
                        $content = get_the_content();
                        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
                        if (!empty($matches[1])) {
                            $images[] = $matches[1];
                        }
                    }
                }
                wp_reset_postdata();
            }

            if (!empty($images)) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach ($images as $img_url): ?>
                        <a href="<?php echo esc_url($img_url); ?>" target="_blank" class="block">
                            <img src="<?php echo esc_url($img_url); ?>"
                                alt=""
                                class="w-full h-48 object-cover rounded-lg shadow hover:scale-103 transition-transform duration-300" />
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>Ingen billeder fundet.</p>
            <?php endif; ?>
        </div>
    </div>


<?php get_footer(); ?>