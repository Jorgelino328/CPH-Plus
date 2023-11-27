import vuetify, { transformAssetUrls } from 'vite-plugin-vuetify'

export default defineNuxtConfig(
{
    devtools: { enabled: true },
    ssr: false,
    build: {
        transpile: [
            'vuetify',
            'toast'
        ],
    },
    modules: [
        (_options, nuxt) => {
            nuxt.hooks.hook('vite:extendConfig', (config) => {
                // @ts-expect-error
                config.plugins.push(vuetify({ autoImport: true }))
            })
        }
    ],
    vite: {
        vue: {
            template: {
                transformAssetUrls,
            },
        },
    },
    plugins: [
        '~/plugins/highlight.client'
    ]
})
