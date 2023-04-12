"use strict";

let table, save_method; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function() {
    var csrfName = $('meta[name="csrf"]').attr("content"); // CSRF Token name
    var csrfHash = $('meta[name="csrf_token"]').attr("content"); // CSRF hash

    $('#mdl-blog').modal({ backdrop: 'static', keyboard: false });

    table = $("#table").DataTable({
        ajax: {
            url: base_url + "/cms/blog_",
            type: "POST",
            data: function(d) {
                d[csrfName] = csrfHash;
            },
        },
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 25,
        order: [],
        columnDefs: [{
            targets: [0, -1],
            orderable: false,
            className: "text-center",
        }, ],
        ordering: true,
    });

    $(document).on("click", ".delete", function() {
        var id = $(this).data("id");
        var judul = $(this).data("judul");
        Swal.fire({
            title: "Anda Yakin?",
            html: "Blog " + judul + "<br><br><b>Akan Dihapus!</b>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "/cms/delete_blog/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $("#table").DataTable().ajax.reload();
                        Swal.fire({
                            title: data.title,
                            html: judul + "<br><br><b>" + data.status + "</b>",
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error");
                    },
                });
            }
        });
    });

    var input = document.querySelector('input[name="tag"]'),
        tagify = new Tagify(input, {
            whitelist: listTag,
            maxTags: 10,
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
            },
        });


    $(document).on("click", ".add", function() {
        save_method = "add";
        $("#form")[0].reset();
        document.getElementById("row-display").style.display = "none";
        document.getElementById("edit").style.display = "none";
        document.getElementById("create").style.display = "block";

        $('[name="konten"]').summernote("code", '');
        $("#mdl-blog").modal("show");
        $(".modal-title").text("Tambah Blog");
    });

    var input_e = document.querySelector('input[name=tags]');
    var tagify_e = new Tagify(input_e, {
        whitelist: listTag,
        maxTags: 10,
        dropdown: {
            maxItems: 20, // <- mixumum allowed rendered suggestions
            classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
        },
    });

    $(document).on("click", ".edit", function() {
        save_method = "update";
        $("#form").trigger("reset");
        $("#mdl-blog").modal("show");
        $(".update").text("Update");

        document.getElementById("row-display").style.display = "block";
        document.getElementById("edit").style.display = "block";
        document.getElementById("create").style.display = "none";
        document.getElementById("output_image").src = $(this).data("photo");

        tagify_e.addTags($(this).data("tag"));

        $(".modal-title").text("Edit Blog");
        $('[name="id"]').val($(this).data("id"));
        $('[name="judul"]').val($(this).data("judul"));
        $('[name="konten"]').summernote("code", $(this).data("konten"));
        $('[name="ringkasan"]').val($(this).data("ringkasan"));
        $('[name="photo_url"]').val($(this).data("photo"));
        $('[name="status"]').val($(this).data("status"));
    });

    $.validator.setDefaults({
        ignore: ":hidden, [contenteditable='true']:not([name])",
        submitHandler: function() {
            var url;
            if (save_method == "add") {
                url = base_url + "/cms/create_blog";
            } else {
                url = base_url + "/cms/update_blog";
            }
            var form_data = new FormData(document.getElementById("form"));
            form_data.append(csrfName, csrfHash);

            $.ajax({
                url: url,
                type: "POST",
                data: form_data,
                dataType: "JSON",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.result != true) {
                        Swal.fire({
                            title: data.title,
                            html: $("#judul").val() + "<br>" + data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                    } else {
                        $("#table").DataTable().ajax.reload();
                        $("#mdl-blog").modal("hide");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error adding / update data");
                    alert(textStatus);
                    alert(errorThrown);
                    alert(jqXHR);
                },
            });
        },
    });

    $("#form").validate({
        validClass: "success",
        rules: {
            judul: {
                required: true,
            },
            ringkasan: {
                required: true,
            },
            photo: {
                required: function() {
                    if ($("#id").val() == "") {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
            status: {
                required: true,
            },
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });

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

function preview_image(event) {
    document.getElementById("row-display").style.display = "block";
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById("output_image");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}