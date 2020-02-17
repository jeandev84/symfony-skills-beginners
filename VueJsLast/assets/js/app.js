/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import tinymce from 'tinymce'
import "tinymce/themes/modern/theme";

import "tinymce/plugins/image";


require("../../node_modules/tinymce/skins/lightgray/skin.min.css");
require("../../node_modules/tinymce/skins/lightgray/content.min.css");

let form = document.querySelector('#tinymce_editor');

tinymce.init({
    selector: '#post_content',
    plugins: 'image', /* plugins: 'image link paste' like this specify many plugins */
    toolbar: 'image',
    atomatic_uploads: true,
    images_upload_url: '/attachment/' + form.dataset.postId, // url -> post_id
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);


                // call the callback and populate the Title field with the file name
                cb(blobInfo.blobUri(), {title: file.name});
            };

            reader.readAsDataURL(file);
        }

        input.click();
    }
})
