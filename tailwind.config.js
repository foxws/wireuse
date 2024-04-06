import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import theme from './resources/css/presets/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
  presets: [theme],
  content: ['./resources/**/*.blade.php'],
  plugins: [forms, typography],
};
