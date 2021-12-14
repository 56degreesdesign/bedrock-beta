const mix = require('laravel-mix');

module.exports = {
    mode: (mix.inProduction()) ? 'jit' : '',
    future: {
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
    },
    corePlugins: {
        container: false
    },
    purge: {
        content: [
            './*.php',
            './templates/**/*.php',
            './build/js/**/*.js',
        ],
        options: {
            safelist: [],
            blocklist: [],
            keyframes: true,
            fontFace: true,
        },
    },
    theme: {
        // colors: {
        //     // Base colors
        //     transparent: 'transparent',
        //     black: colors.black,
        //     white: colors.white,
        //     // Custom Colors
        //     light: '#F1F1F1',
        //     gray: '#E9E9E9',
        //     'light-gray': '#838383',
        //     pink: '#FA3069',
        //     blue: '#3D3DA8',
        //     purple: '#5151D6'
        // },
        // fontFamily: {
        //     'book': ['Gotham Book'],
        //     'bold': ['Gotham'],
        // },
        extend: {
            fontSize: {
                xxs: '0.675rem',
            },
            lineHeight: {
                tighter: '1.125',
            },
        }
    },
    variants: {
        textColor: ['responsive', 'hover', 'focus', 'visited'],
    },
    plugins: [
        ({
            addUtilities
        }) => {
            const utils = {
                '.translate-x-half': {
                    transform: 'translateX(50%)',
                },
            };
            addUtilities(utils, ['responsive'])
        },
        function ({
            addComponents
        }) {
            addComponents({
                '.container': {
                    width: '100%',
                    maxWidth: '1821px',
                    marginLeft: 'auto',
                    marginRight: 'auto',
                    paddingLeft: '2rem',
                    paddingRight: '2rem',
                    // '@screen sm': {
                    //   maxWidth: '640px',
                    // },
                    // '@screen md': {
                    //   maxWidth: '768px',
                    // },
                    // '@screen lg': {
                    //   maxWidth: '1024px',
                    // },
                    // '@screen xl': {
                    //   maxWidth: '1280px',
                    // },
                }
            })
        }
    ]
};