// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from "@tailwindcss/vite";
import netlify from '@astrojs/netlify/functions';

// https://astro.build/config
export default defineConfig({
  output: 'server', // necesario para usar endpoints
  adapter: netlify(),
  vite: {
    plugins: [tailwindcss()]
  }
});
