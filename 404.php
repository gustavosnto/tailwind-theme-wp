<?php
get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <div class="text-center py-12">
        <div class="max-w-md mx-auto">
            <div class="text-9xl font-bold text-gray-300 mb-4">404</div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                <?php _e('Página não encontrada', 'tailwind-theme'); ?>
            </h1>
            <p class="text-gray-600 mb-8">
                <?php _e('Desculpe, mas a página que você está procurando não existe.', 'tailwind-theme'); ?>
            </p>
            
            <div class="space-y-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                    <?php _e('Voltar para o início', 'tailwind-theme'); ?>
                </a>
                
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        <?php _e('Ou tente uma busca:', 'tailwind-theme'); ?>
                    </h2>
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
