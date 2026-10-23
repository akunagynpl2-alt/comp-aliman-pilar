import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                gold: {
                    50:      '#fffbeb',
                    100:     '#fef3c7',
                    200:     '#fde68a',
                    300:     '#fcd34d',
                    400:     '#fbbf24',
                    500:     '#f59e0b',
                    600:     '#d97706',
                    700:     '#b45309',
                    DEFAULT: '#C9A84C',
                    light:   '#E8C97E',
                    dark:    '#A07830',
                },
                charcoal: {
                    DEFAULT: '#0A0A0A',
                    50:      '#1a1a1a',
                    100:     '#111111',
                },
            },
            fontFamily: {
                heading: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                body:    ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                serif:   ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                sans:    ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'gold-gradient':   'linear-gradient(135deg, #E8C97E, #C9A84C, #A07830)',
                'gold-gradient-h': 'linear-gradient(90deg, #E8C97E, #C9A84C)',
            },
            boxShadow: {
                gold:    '0 0 20px rgba(201, 168, 76, 0.3)',
                'gold-lg': '0 0 40px rgba(201, 168, 76, 0.45)',
            },
            animation: {
                'fade-up':    'fadeUp 0.7s ease-out forwards',
                'fade-in':    'fadeIn 0.6s ease-out forwards',
                'shimmer':    'shimmer 3s linear infinite',
                'pilar-grow': 'pilarGrow 1.4s cubic-bezier(0.4,0,0.2,1) forwards',
            },
            keyframes: {
                fadeUp: {
                    '0%':   { transform: 'translateY(30px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                shimmer: {
                    '0%':   { backgroundPosition: '-200% center' },
                    '100%': { backgroundPosition: '200% center' },
                },
                pilarGrow: {
                    '0%':   { height: '0', opacity: '0' },
                    '100%': { height: '100%', opacity: '1' },
                },
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: theme('colors.white'),
                        a: {
                            color: theme('colors.gold.DEFAULT'),
                            '&:hover': { color: theme('colors.gold.light') },
                        },
                        h1: { color: theme('colors.white') },
                        h2: { color: theme('colors.white') },
                        h3: { color: theme('colors.white') },
                        h4: { color: theme('colors.gold.DEFAULT') },
                        strong: { color: theme('colors.white') },
                        blockquote: {
                            borderLeftColor: theme('colors.gold.DEFAULT'),
                            color: '#d1d5db',
                        },
                    },
                },
            }),
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
