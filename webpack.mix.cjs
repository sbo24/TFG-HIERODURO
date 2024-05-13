const mix = require('laravel-mix');

mix.copy('resources/css', 'public/css');
mix.copy('resources/js', 'public/js');
mix.copy('resources/img', 'public/img');
mix.copy('node_modules/chart.js/dist/chart.js', 'public/chart.js/chart.js');