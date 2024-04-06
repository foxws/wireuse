module.exports = {
  env: {
    browser: true,
    es2021: true,
    node: true,
  },
  extends: [],
  overrides: [
    {
      files: ['.eslintrc.{js,cjs}'],
      parserOptions: {
        sourceType: 'script',
      },
    },
    {
      files: ['*.ts', '*.tsx', '*.js'],
      parser: '@typescript-eslint/parser',
      extends: ['airbnb-base', 'plugin:tailwindcss/recommended'],
      rules: {
        'import/no-extraneous-dependencies': 'off',
        'import/no-unresolved': 'off',
        'tailwindcss/no-custom-classname': 'off',
      },
    },
    {
      files: ['*.html', '*.blade.php'],
      parser: '@angular-eslint/template-parser',
      extends: ['plugin:tailwindcss/recommended'],
      rules: {
        'tailwindcss/no-custom-classname': 'off',
      },
    },
  ],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
};
