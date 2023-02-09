const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/shop/slider.js', 'public/js')
    .js('resources/js/checkout/checkout.js', 'public/js')
    .js('resources/js/checkout/input-mask.js', 'public/js')
    .js('resources/js/cart/cart.js', 'public/js')
    .js('resources/js/shop/algolia.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/landing/landing.scss', 'public/css')
    .sass('resources/sass/shop/shop.scss', 'public/css')
    .sass('resources/sass/checkout/success.scss', 'public/css')
    .sourceMaps()
