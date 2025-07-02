<?php
get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php while (have_posts()) : the_post(); ?>
        <article class="max-w-4xl mx-auto">
            <header class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php the_title(); ?></h1>
                
                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <time datetime="<?php echo get_the_date('c'); ?>" class="mr-4">
                        <?php echo get_the_date(); ?>
                    </time>
                    <span class="mr-4">Por <?php the_author(); ?></span>
                    <?php if (has_category()) : ?>
                        <span>Em <?php the_category(', '); ?></span>
                    <?php endif; ?>
                </div>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-8">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg shadow-lg')); ?>
                    </div>
                <?php endif; ?>
            </header>
            
            <div class="prose prose-lg max-w-none">
                <?php the_content(); ?>
            </div>
            
            <?php if (has_tag()) : ?>
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm text-gray-500 mr-2"><?php _e('Tags:', 'tailwind-theme'); ?></span>
                        <?php the_tags('<span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">', '</span><span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded ml-1">', '</span>'); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Post Navigation -->
            <nav class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex justify-between">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo get_permalink($prev_post); ?>" class="flex items-center text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span><?php echo get_the_title($prev_post); ?></span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <a href="<?php echo get_permalink($next_post); ?>" class="flex items-center text-blue-600 hover:text-blue-800 ml-auto">
                            <span><?php echo get_the_title($next_post); ?></span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
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
