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
        primary: colors.pink,
        secondary: colors.gray,
        info: colors.blue,
        success: colors.gray,
        error: colors.red,
        warning: colors.yellow,
      },
      container: {
        center: true,
        padding: '1rem',
      },
      safelist: [
        'text-error-500',
      ],
    }
  }
};
