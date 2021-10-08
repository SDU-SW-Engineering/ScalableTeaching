module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'media', // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                limeGreen: {
                    50: '#F2FDE0',
                    100: '#E2F7C2',
                    200: '#C7EA8F',
                    300: '#ABDB5E',
                    400: '#94C843',
                    500: '#7BB026',
                    600: '#63921A',
                    700: '#507712',
                    800: '#42600C',
                    900: '#2B4005'
                },
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
