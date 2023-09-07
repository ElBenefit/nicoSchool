const path = require('path');

module.exports = {
    entry: './resources/js/app.js', // Chemin vers votre fichier JavaScript principal
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'public/js'), // Le répertoire de sortie pour les fichiers bundle.js
    },
};
