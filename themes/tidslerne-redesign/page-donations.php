<?php get_header(); ?>

<div class="container mx-auto px-4 py-8 max-w-5xl">
    
        <h1 class="text-3xl font-extrabold mb-2"><?php the_title(); ?></h1>
        
        <div class="border-b border-black mb-6"></div>

        <div class="prose max-w-none text-base mb-8">
            <?php the_content(); ?>
        </div>

</div>

<?php get_footer(); ?>