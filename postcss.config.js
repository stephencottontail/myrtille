var config = require('gulp-wp-toolkit');

/**
 * I had to pluck this function out separately because I couldn't figure out
 * how to modify the build task
 */
const buildThemeHeader = function() {
	const themeHeaderArr = {
		// 'Header Name': 'Key under config.theme',
		'Theme Name': 'name',
		'Theme URI': 'themeuri',
		Author: 'author',
		'Author URI': 'authoruri',
		Description: 'description',
		Version: 'version',
		Status: 'status',
		License: 'license',
		'License URI': 'licenseuri',
		Tags: 'tags',
		'Text Domain': 'textdomain',
		'Domain Path': 'domainpath',
		Template: 'template',
	};

	let key;
	let themeHeader = '';

	// Loop through above object properties.
	for (key in themeHeaderArr) {
		// If a value has been set in config.theme.???, ...
		if (config.config.theme[themeHeaderArr[key]]) {
			// Then build the file header for it.
			themeHeader += key + ': ' + config.config.theme[themeHeaderArr[key]] + '\n';
		}
	}

	if (config.config.theme.notes) {
		themeHeader += '\n' + config.config.theme.notes;
	}

	// Remove final new line character.
	themeHeader = themeHeader.slice(0, -1);

	return themeHeader;
};

module.exports = {
	/* You can return this as an array or an object, but I couldn't figure out
	 * how to make Tailwind work when returning an object
	 */
	plugins: [
		require('tailwindcss')('./tailwind.js'),
		require('postcss-banner')({ banner: buildThemeHeader() }),
		require('autoprefixer'),
		require('postcss-hexrgba')
	]
};
