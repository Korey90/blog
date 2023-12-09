import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
/*
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import { resolve } from 'path'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
    vue()
  ],
  css: {
    preprocessorOptions: {
      scss: {
        additionalData: `@import "${resolve(__dirname, 'resources/css/app.scss')}";`
      },
    },
  },
});

/*
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { resolve } from 'path'

export default defineConfig({
  plugins: [vue()],
  css: {
    preprocessorOptions: {
      scss: {
        additionalData: `@import "${resolve(__dirname, 'resources/css/app.scss')}";`
      },
    },
  },
  // ... reszta twojej konfiguracji
});


/*

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
*/