module.exports = {
    future: {
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
    },
    corePlugins: {
        container: false
    },
    content: [
        // './*.php',
        './templates/**/*.php',
        './build/js/*.js',
    ],
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
    plugins: [
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
                }
            })
        }
    ]
};