const tinymce = require('tinymce/tinymce');
require('tinymce/themes/silver');
require('tinymce/plugins/image');

tinymce.init({
    selector: 'textarea#content',
    plugins: 'image',
    toolbar: 'undo redo | image',
});
