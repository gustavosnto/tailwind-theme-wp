<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4"><?php bloginfo('name'); ?></h3>
                <p class="text-gray-300"><?php bloginfo('description'); ?></p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4"><?php _e('Links Úteis', 'tailwind-theme'); ?></h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'text-gray-300 space-y-2',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4"><?php _e('Contato', 'tailwind-theme'); ?></h3>
                <div class="text-gray-300">
                    <p><?php _e('Entre em contato conosco', 'tailwind-theme'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Todos os direitos reservados.', 'tailwind-theme'); ?></p>
        </div>
    </div>
</footer>

    <?php wp_footer(); ?>
</body>
</html>
