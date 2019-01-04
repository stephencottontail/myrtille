'use strict';

/**
 * Dependencies.
 *
 * @since 0.0.1
 */
var gulp    = require('gulp');
var toolkit = require('gulp-wp-toolkit');
var pkg     = require('./package');
var postcss = require('gulp-postcss');

/**
 * Setup toolkit config defaults.
 *
 * @since 0.0.1
 */
toolkit.extendConfig({
	theme: {
		name: pkg.themename,
		homepage: pkg.homepage,
		description: pkg.description,
		author: pkg.author,
		version: pkg.version,
		license: pkg.license,
		template: pkg.template,
		textdomain: pkg.name
	},
	src: {
		php: ['**/*.php', '!vendor/**'],
		images: 'assets/images/**/*',
		scss: 'assets/scss/**/*.scss',
		css: ['**/*.css', '!node_modules/**', '!assets/vendor/**'],
		js: ['assets/js/**/*.js', '!node_modules/**'],
		json: ['**/*.json', '!node_modules/**'],
		i18n: 'assets/languages/'
	},
	/**
	 * I'm using Tailwind for this project so I don't need most of the default config here
	 *
	 * @since 1.0.0
	 */
	css: {
		style: {
			src: 'assets/scss/style.css',
			dest: './'
		}
	},
	js: {
		'theme' : ['assets/js/*.js', '!assets/js/menu.js'],
		'responsive-menu' : ['assets/js/menu.js']
	},
	dest: {
		i18npo: 'dist/languages/',
		i18nmo: 'dist/languages/',
		images: 'dist/images/',
		css: 'dist/css',
		js: 'dist/js'
	}
});

const css = () => {
	gulp.src(toolkit.config.css.style.src)
		.pipe(postcss())
		.pipe(gulp.dest(toolkit.config.css.style.dest));
}

const tasks = {
	'build:css': css
}

toolkit.extendTasks(gulp, tasks);
