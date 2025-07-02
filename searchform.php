<form role="search" method="get" class="search-form flex" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="flex w-full max-w-md">
        <input 
            type="search" 
            class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
            placeholder="<?php echo esc_attr_x('Buscar...', 'placeholder', 'tailwind-theme'); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
        />
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="sr-only"><?php echo _x('Buscar', 'submit button', 'tailwind-theme'); ?></span>
        </button>
    </div>
</form>
