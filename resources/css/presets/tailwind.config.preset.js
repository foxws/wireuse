import colors from 'tailwindcss/colors';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./resources/**/*.blade.php', './src/**/*.php'],
  plugins: [forms, typography],
  theme: {
    extend: {
      colors: {
        base: colors.white,
        primary: colors.pink,
        secondary: colors.gray,
        error: colors.red,
      },
      container: {
        center: true,
        padding: '2rem',
      },
      safelist: [
        'text-error-500',
      ],
    }
  }
};
