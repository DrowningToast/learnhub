/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'beth': ['Beth Ellen', 'cursive'],
                'noto-thai': ['Noto Sans Thai', 'sans-serif'],
                'poppins': ['Poppins', 'sans-serif'],
            }
        },
    },
    plugins: [],
};
