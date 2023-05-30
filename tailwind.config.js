/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./resources/**/**/*.blade.php', './resources/**/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php'],
    theme: {
        extend: {
            dropShadow: {
                glow: [
                    "0 0px 20px rgba(255,255, 255, 0.35)",
                ],
            },
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
            },
            '@layer utilities': {
                '.custom-class': {
                    'background-color': 'bg-blue-100',
                    'border': 'border-gray-200',
                    'margin-bottom': 'mb-4',
                },
            },
        },
    },
    plugins: [],
}
