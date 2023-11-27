module.exports = {
    root: true,
    env: {
        browser: true,
        node: true
    },
    parser: 'vue-eslint-parser',
    parserOptions: {
        parser: '@typescript-eslint/parser'
    },
    plugins: [
        '@typescript-eslint',
        'vue'
    ],
    extends: [
        'plugin:@typescript-eslint/recommended',
        '@nuxtjs/eslint-config-typescript',
        'plugin:vue/vue3-strongly-recommended',
        'standard'
    ],
    ignorePatterns: ["*.config*"],

    rules: {
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',

        /*
        |--------------------------
        | Disabled rules
        |--------------------------
        */
        'quote-props': 'off',
        "quotes": "off",
        'semi': 'off',
        'brace-style': 'off',
        'vue/multi-word-component-names': 'off',
        'space-before-function-paren': 'off',
        'eqeqeq': 'off',
        'no-useless-escape': 'off',
        'no-useless-constructor': 'off',
        '@typescript-eslint/no-non-null-assertion': 'off',
        "no-undef": 'off',

        /*
        |--------------------------
        | Clean Code / Code style
        |--------------------------
        */
        'camelcase': 'error',
        'space-before-blocks': 'error',
        'vue/html-indent': ['error', 4],
        'arrow-parens': ['error', 'as-needed'],
        'multiline-ternary': ['error', 'always-multiline'],

        'vue/component-api-style': ['error',
            ['script-setup']
        ],

        '@typescript-eslint/explicit-function-return-type': ['error', {
            allowTypedFunctionExpressions: true
        }],

        'vue/html-closing-bracket-spacing': ['error', {
            selfClosingTag: 'never'
        }],

        indent: ['error', 4, {
            ignoredNodes: ['MemberExpression'],
            SwitchCase: 1
        }],

        'no-trailing-spaces': ['error', {
            skipBlankLines: true
        }],

        'vue/max-attributes-per-line': ['warn', {
            singleline: {
                max: 3
            },
            multiline: {
                max: 1
            }
        }],

        "vue/component-name-in-template-casing": ["error", "PascalCase"],

        "@typescript-eslint/naming-convention": ["error",
            {
                "selector": "typeLike",
                "format": ["PascalCase"]
            },
            {
                "selector": "variableLike",
                "format": ["camelCase", "UPPER_CASE"],
                "leadingUnderscore": "allow"
            }
        ],

        /*
        |--------------------------
        | Error prevention
        |--------------------------
        */
        'import/namespace': 'error',
        'import/default': 'error',
        'import/export': 'error',
        'vue/this-in-template': 'error',
        'no-console': 'warn',

        'vue/block-lang': ['error', {
            script: {
                lang: 'ts'
            }
        }],
        
        '@typescript-eslint/no-unused-vars': ['warn', {
            varsIgnorePattern: '^_',
            argsIgnorePattern: '^_'
        }],
        'no-unused-vars': ['warn', {
            varsIgnorePattern: '^_',
            argsIgnorePattern: '^_'
        }],
        'vue/no-unused-vars': 'warn'
    }
}
