const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
    ...defaultConfig,
    entry: {
        'contact-form': './blocks/contact-form/index.js',
    },
    output: {
        path: path.resolve(__dirname, 'blocks/contact-form/build'),
        filename: 'index.js',
    },
};
