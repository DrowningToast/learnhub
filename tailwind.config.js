/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                beth: ["Beth Ellen", "cursive"],
                "noto-thai": ["Noto Sans Thai", "sans-serif"],
                poppins: ["Poppins", "sans-serif"],
            },
            backgroundColor: {
                "radial-gradient": "radial-gradient(#e66465, #9198e5)",
                nudge: "nudge",
            },
        },
    },
    plugins: [
        require("tailwindcss"),
        require("autoprefixer"),
        require("daisyui"),
    ],
};
