const { build } = require('esbuild')

build({
  entryPoints: ['src/index.js'],
  outdir: 'build',
  external: [ 'react', 
              'react-dom', 
              'wp.blocks',
              'wp.i18n',
              'wp.block-editor',
              'wp.i18n',
              ],
  loader: { '.js': 'jsx', '.png': 'base64' },
  minify: true,
  bundle: true,
}).catch((error) => {
  console.error(error)
  process.exit(1)
})