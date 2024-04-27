import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./resources/**/*.blade.php', './src/**/*.php', './vendor/foxws/wireuse/**/*.blade.php'],
  plugins: [forms, typography],
};
