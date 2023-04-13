"use strict";
var editor, table, save_method;

jQuery(document).ready(function() {
    var csrfName = $('meta[name="csrf"]').attr('content') // CSRF Token name
    var csrfHash = $('meta[name="csrf_token"]').attr('content') // CSRF hash

    $(document).on("click", ".edit", function() {
        let id_product = $(this).data("id");

        var data = new FormData();
        data.append("id", id_product);
        data.append(csrfName, csrfHash);

        $.ajax({
            url: base_url + "/cms/fetch-modal-fitur",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            success: function(datas) {
                $("#content-produk-edit").html("");
                $("#content-produk-edit").html(datas);
                $('#modal-produk-edit').modal({ backdrop: 'static', keyboard: false });
                $('#modal-produk-edit').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            },
        });
    });

    var ai = 1;
    $(document).on("click", ".add-fitur", function(e) {
        e.preventDefault();
        let html;
        html = `<div id='list-fitur-` + ai + `'> `;
        html += `<div class="row mt-3">
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="fitur-` + ai + `" name="fitur[]" required>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-danger w-100 delete-fitur" id='` + ai + `'><i class="fa fa-trash"></i></button>
                    </div>
                    </div>
                </div>`;
        html += `</div'> `;

        $("#list-fitur").append(html);
    });

    $(document).on("click", ".delete-fitur", function() {
        var button_id = $(this).attr("id");
        $("#list-fitur-" + button_id + "").remove();
    });

    $(document).on("click", ".delete-fitur-edit", function() {
        var button_id = $(this).attr("id");
        $("#list-fitur-edit-" + button_id + "").remove();
    });

    $.validator.setDefaults({
        submitHandler: function() {
            var url;
            url = base_url + "/cms/update_produk_price";
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
                            html: data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                    } else {
                        window.location.reload();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        }
    });

    $("#form").validate({
        validClass: "success",
        rules: {
            judul: {
                required: true
            },
            ringkasan: {
                required: true
            },
            harga: {
                required: true
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});