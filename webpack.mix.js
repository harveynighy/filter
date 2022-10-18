const mix = require('laravel-mix');

mix
	.js('src/js/app.js', 'dist')
	.sass('src/scss/app.scss', 'dist')
	.browserSync({
		proxy: 'filter.local/',
		files: ['dist/*'],
	})
	.options({
		processCssUrls: false,
	});
    mix.minify('dist/app.js');
