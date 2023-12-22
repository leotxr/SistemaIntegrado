/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      './Resources/views/**/*.blade.php',
      "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('flowbite/plugin')
  ],
}

