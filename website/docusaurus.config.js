// @ts-check
const { themes: prismThemes } = require('prism-react-renderer');

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: 'WireUse',
  tagline: 'Collection of Livewire traits and utilities',

  url: 'https://foxws.github.io',
  baseUrl: '/wireuse/',

  organizationName: 'foxws',
  projectName: 'wireuse',
  deploymentBranch: 'gh-pages',
  trailingSlash: false,

  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',

  i18n: {
    defaultLocale: 'en',
    locales: ['en'],
  },

  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          path: '../docs',
          routeBasePath: '/',
          sidebarPath: require.resolve('./sidebars.js'),
          editUrl: 'https://github.com/foxws/wireuse/edit/main/docs/',
        },
        blog: false,
        theme: {
          customCss: require.resolve('./src/css/custom.css'),
        },
      }),
    ],
  ],

  themes: [
    [
      '@easyops-cn/docusaurus-search-local',
      /** @type {import('@easyops-cn/docusaurus-search-local').PluginOptions} */
      ({
        hashed: true,
        indexBlog: false,
        docsRouteBasePath: '/',
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      navbar: {
        title: 'WireUse',
        items: [
          {
            href: 'https://github.com/foxws/wireuse',
            label: 'GitHub',
            position: 'right',
          },
          {
            href: 'https://packagist.org/packages/foxws/wireuse',
            label: 'Packagist',
            position: 'right',
          },
        ],
      },
      footer: {
        style: 'dark',
        links: [
          {
            title: 'Docs',
            items: [
              { label: 'Introduction', to: '/' },
              { label: 'Installing WireUse', to: '/installing-wireuse' },
              { label: 'Property Synthesizers', to: '/property-synthesizers' },
            ],
          },
          {
            title: 'More',
            items: [
              { label: 'GitHub', href: 'https://github.com/foxws/wireuse' },
              { label: 'Packagist', href: 'https://packagist.org/packages/foxws/wireuse' },
            ],
          },
        ],
        copyright: `Copyright © ${new Date().getFullYear()} foxws. Built with Docusaurus.`,
      },
      prism: {
        theme: prismThemes.github,
        darkTheme: prismThemes.dracula,
      },
    }),
};

module.exports = config;
