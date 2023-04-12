"use strict";

jQuery(document).ready(function() {
    var csrfName = $('meta[name="csrf"]').attr("content"); // CSRF Token name
    var csrfHash = $('meta[name="csrf_token"]').attr("content"); // CSRF hash

    $(".summernote").summernote({
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            },
            onMediaDelete: function(target) {
                deleteImage(target[0].src);
            },
        },
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        data.append(csrfName, csrfHash);
        $.ajax({
            url: base_url + "/cms/upload_image_content",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $(".summernote").summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            },
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {
                src: src,
                csrfName: csrfHash,
            },
            type: "POST",
            url: base_url + "/cms/delete_image_content/", // replace with your url
            cache: false,
            success: function(resp) {
                console.log(resp);
            },
        });
    }
});

function preview_logo(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function preview_cover(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image_cover');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}