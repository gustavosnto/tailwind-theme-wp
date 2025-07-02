<?php
get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php while (have_posts()) : the_post(); ?>
        <article class="max-w-4xl mx-auto">
            <header class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-6"><?php the_title(); ?></h1>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-8">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg shadow-lg')); ?>
                    </div>
                <?php endif; ?>
            </header>
            
            <div class="prose prose-lg max-w-none">
                <?php the_content(); ?>
            </div>
        </article>
        
        <?php
        // Comments
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>
        
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
