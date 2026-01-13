"use strict";

const setEditor = {
    ckeditor: {
        classic: (selector) => {
            ClassicEditor.create(document.querySelector(selector), {
                link: {
                    addTargetToExternalLinks: true,
                },
            }).catch((error) => {
                console.error(`ckeditor error " ${error}`);
            });
        },
        popup: (selector) => {
            ClassicEditor.create(document.querySelector(selector), {
                toolbar: [
                    "heading",
                    "|",
                    "bold",
                    "italic",
                    "link",
                    "bulletedList",
                    "numberedList",
                    "|",
                    "indent",
                    "outdent",
                    "|",
                    "imageUpload",
                    "blockQuote",
                    "insertTable",
                    "mediaEmbed",
                    "undo",
                    "redo",
                ],
                link: {
                    addTargetToExternalLinks: true,
                },
            }).catch((error) => {
                console.error(`ckeditor error " ${error}`);
            });
        },
    },
};
