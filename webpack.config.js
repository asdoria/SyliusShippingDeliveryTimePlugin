const Encore = require('@symfony/webpack-encore')
const path   = require('path')

const assetsPath = path.resolve('./src/Resources/private')
const outputPath = path.resolve('./src/Resources/public')
const publicPath = '/bundles/asdoriashippingdeliverytimeplugin/'

const cssPath = path.join(assetsPath, './css')
const jsPath  = path.join(assetsPath, './js')

Encore
    .setOutputPath(outputPath)
    .setPublicPath(publicPath)
    .setManifestKeyPrefix('bundles/asdoriashippingdeliverytimeplugin/')

    .addEntry('asdoria-deliverytime', [
        path.join(jsPath, './shop.js'),
        path.join(jsPath, './shipping-delivery-time.js')
    ])

    .enableSourceMaps()
    // .disableSingleRuntimeChunk()

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    // .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureFilenames({
        js: 'js/[name].min.js',
        css: 'css/[name].min.css',
    })
    .enableSassLoader()
;

const config = Encore.getWebpackConfig()

// config = Encore.getWebpackConfig();
config.watchOptions = {
    poll: true,
    ignored: /node_modules/
}
// export the final configuration
module.exports      = config
