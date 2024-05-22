import { sveltekit } from '@sveltejs/kit/vite';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [sveltekit()],
    // Add this
    css: {
        preprocessorOptions: {
            // if using SCSS
            scss: {                                 
                additionalData: `
                @use '$lib/scss/variables' as *;    
                @use '$lib/scss/mixins' as *;
            `,
            },
        },
    }
});