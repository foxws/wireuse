import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./resources/**/*.blade.php', './vendor/foxws/wireui/**/*.blade.php'],
  plugins: [forms, typography],
};
