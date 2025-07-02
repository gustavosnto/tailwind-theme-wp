<?php
get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="aspect-w-16 aspect-h-9">
                            <?php the_post_thumbnail('custom-medium', array('class' => 'w-full h-48 object-cover')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-blue-600 transition-colors">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <div class="text-sm text-gray-500 mb-3">
                            <?php echo get_the_date(); ?> • <?php the_author(); ?>
                        </div>
                        
                        <div class="text-gray-600 mb-4">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                            <?php _e('Leia mais', 'tailwind-theme'); ?>
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('« Anterior', 'tailwind-theme'),
                'next_text' => __('Próximo »', 'tailwind-theme'),
            ));
            ?>
        </div>
    <?php else : ?>
        <div class="text-center py-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                <?php _e('Nenhum post encontrado', 'tailwind-theme'); ?>
            </h2>
            <p class="text-gray-600">
                <?php _e('Desculpe, mas não há conteúdo disponível no momento.', 'tailwind-theme'); ?>
            </p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer();