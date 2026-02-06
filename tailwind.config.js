import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                // TU PALETA BONVOY (Azules y Aquas)
                bonvoy: {
                    light: '#5C9EAD',    // Aqua claro (Botones secundarios)
                    main: '#007EA7',     // Azul VIBRANTE (Botón Buscar/Principal)
                    teal: '#005E7C',     // Azul petróleo
                    dark: '#0A3D52',     // Oscuro verdoso (Fondos fuertes)
                    navy: '#211A4D',     // Morado/Azul profundo (Navbar/Footer)
                    gray: '#F3F4F6',     // Fondo general suave
                }
            },
            fontFamily: {
                // Fuentes personalizadas
                sans: ['"Red Hat Display"', ...defaultTheme.fontFamily.sans],
                display: ['"Bebas Neue"', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};