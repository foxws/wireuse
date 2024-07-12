import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import theme from './resources/css/presets/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
  presets: [theme],
  relative: true,
  content: ['./resources/**/*.blade.php', './src/**/*.php'],
  plugins: [forms, typography],
};
