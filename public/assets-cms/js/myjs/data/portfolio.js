"use strict";
var editor, table, save_method;

jQuery(document).ready(function() {
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

    var input_e = document.querySelector("input[name=tags]");
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

    var csrfName = $('meta[name="csrf"]').attr("content"); // CSRF Token name
    var csrfHash = $('meta[name="csrf_token"]').attr("content"); // CSRF hash

    table = $("#table").DataTable({
        ajax: {
            url: base_url + "/cms/portfolio_",
            type: "POST",
            data: function(d) {
                d[csrfName] = csrfHash;
            },
        },
        responsive: true,
        processing: true,
        serverSide: true,
        order: [],
        pageLength: 25,
        columnDefs: [{
                targets: [0, -1],
                orderable: false,
                className: "text-center",
            },
            {
                targets: [3],
                orderable: false,
                className: "text-center",
            },
            {
                targets: [4],
                className: "text-wrap",
            },
        ],
        ordering: true,
    });

    $.validator.setDefaults({
        ignore: ":hidden, [contenteditable='true']:not([name])",
        submitHandler: function() {
            var url;
            if (save_method == "add") {
                url = base_url + "/cms/create_portfolio";
            } else {
                url = base_url + "/cms/update_portfolio";
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
                            html: $("#nama").val() + "<br>" + data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                    } else {
                        $("#table").DataTable().ajax.reload();
                        $("#mdl-portfolio").modal("hide");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error adding / update data");
                },
            });
        },
    });

    $("#form").validate({
        validClass: "success",
        rules: {
            title: {
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

    $("#mdl-portfolio").modal({ backdrop: "static", keyboard: false });

    $(document).on("click", ".add", function() {
        save_method = "add";
        document.getElementById("row-display").style.display = "none";
        document.getElementById("edit").style.display = "none";
        document.getElementById("create").style.display = "block";

        $('[name="deskripsi"]').summernote("code", '');

        $("#form")[0].reset();
        $("#mdl-portfolio").modal("show");
        $(".modal-title").text("Tambah Portfolio");
    });

    $(document).on("click", ".edit", function() {
        save_method = "update";
        $("#form").trigger("reset");
        $("#mdl-portfolio").modal("show");
        $(".update").text("Update");

        document.getElementById("edit").style.display = "block";
        document.getElementById("create").style.display = "none";
        document.getElementById("row-display").style.display = "block";
        document.getElementById("output_image").src = $(this).data("photo_url");

        tagify_e.addTags($(this).data("tag"));

        $(".modal-title").text("Edit portfolio");
        $('[name="id"]').val($(this).data("id"));
        $('[name="title"]').val($(this).data("title"));
        $('[name="keterangan"]').val($(this).data("keterangan"));
        $('[name="deskripsi"]').summernote("code", $(this).data("deskripsi"));
        $('[name="photo_url"]').val($(this).data("photo_url"));
        $('[name="status"]').val($(this).data("status"));
        $('[name="client"]').val($(this).data("client"));
        $('[name="location_project"]').val($(this).data("location_project"));
        $('[name="date_project"]').val($(this).data("date_project"));
    });

    $(document).on("click", ".delete", function() {
        var id = $(this).data("id");
        Swal.fire({
            title: "Anda Yakin?",
            html: "<b> Data ini akan Dihapus! </b>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal",
            confirmButtonText: "Ya, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "/cms/delete_portfolio/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $("#table").DataTable().ajax.reload();
                        Swal.fire({
                            title: data.title,
                            html: "<b>" + data.status + " </b>",
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