export default {
  head: {
    title: process.env.TITLE,
    htmlAttrs: {
      lang: 'es',
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { name: 'description', content: process.env.DESCRIPTION },
      // google
      { content: process.env.DOMAIN, property: 'og:url' },
      { content: 'website', property: 'og:type' },
      { content: process.env.TITLE, property: 'og:title' },
      { content: process.env.TITLE, property: 'og:site_name' },
      { content: process.env.DESCRIPTION, property: 'og:description' },
      {
        content: process.env.DOMAIN + '/favicon.ico',
        property: 'og:image',
      },
      { content: process.env.TITLE, property: 'og:image:alt' },
      // twitter
      {
        content: process.env.DOMAIN,
        property: 'twitter:url',
      },
      { content: '@RedDeVenta', property: 'twitter:creator' },
      { content: 'summary', property: 'twitter:card' },
      { content: process.env.TITLE, property: 'twitter:title' },
      { content: process.env.DESCRIPTION, property: 'twitter:description' },
      {
        content: process.env.DOMAIN + '/favicon.ico',
        property: 'twitter:image',
      },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
  },
  css: ['@/assets/css/global.scss'],
  plugins: ['~/mixins/global.js'],
  components: false,
  buildModules: [
    '@nuxt/typescript-build',
    '@nuxtjs/stylelint-module',
    '@nuxtjs/apollo',
  ],
  apollo: {
    clientConfigs: {
      default: {
        httpEndpoint: process.env.BACK_DOMAIN + '/graphql',
      },
    },
  },
  modules: [
    'bootstrap-vue/nuxt',
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    '@nuxtjs/auth-next',
    '@nuxtjs/fontawesome',
  ],
  fontawesome: {
    imports: [
      {
        set: '@fortawesome/free-solid-svg-icons',
        icons: ['fas'],
      },
      {
        set: '@fortawesome/free-brands-svg-icons',
        icons: ['fab'],
      },
    ],
  },
  auth: {
    redirect: {
      home: '/',
    },
    strategies: {
      laravelPassport: {
        provider: 'laravel/passport',
        url: process.env.BACK_DOMAIN,
        clientId: process.env.PASSPORT_CLIENT_ID,
        clientSecret: process.env.PASSPORT_CLIENT_SECRET,
        grantType: 'password',
        endpoints: {
          logout: '/api/auth/logout',
          user: {
            url: '/api/auth/me',
          },
        },
      },
    },
  },
  axios: {
    baseURL: process.env.BACK_DOMAIN + '/api',
    retry: true,
    credentials: true,
  },
  pwa: {
    manifest: {
      name: process.env.title,
      lang: 'es',
    },
  },
  build: {
    extractCSS: true,
  },
}
