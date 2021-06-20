module.exports = {
  purge: { 
    content: [
      './resources/views/article/create.blade.php',
      './resources/views/article/index.blade.php',
      './resources/views/article/show.blade.php',
      './resources/views/auth/login.blade.php',
      './resources/views/auth/register.blade.php',
      './resources/views/layouts/app.blade.php',
      './resources/views/partials/filter.blade.php',
      './resources/views/partials/sidebar.blade.php',
      './resources/views/vendor/pagination/simple-tailwind.blade.php',
      './resources/views/vendor/pagination/tailwind.blade.php',
    ],
    safelist: [
      'opacity-100',
      'visible',
      'invisible',
      'translate-y-0',
      'scale-100'
    ]
  },
  theme: {
    extend: {}
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
