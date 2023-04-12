"use strict";
var editor, table, save_method;

jQuery(document).ready(function() {
    var csrfName = $('meta[name="csrf"]').attr('content') // CSRF Token name
    var csrfHash = $('meta[name="csrf_token"]').attr('content') // CSRF hash

    table = $('#table').DataTable({
        "ajax": {
            "url": base_url + "/cms/produk_value_",
            "type": "POST",
            data: function(d) {
                d[csrfName] = csrfHash;
            }
        },
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "pageLength": 25,
        "columnDefs": [{
                targets: [0, -1],
                orderable: false,
                className: 'text-center'
            },
            {
                targets: [2],
                className: 'text-wrap'
            }, {
                targets: [3, 4],
                orderable: false,
                className: 'text-center'
            }
        ],
        "ordering": true,
    });

    $.validator.setDefaults({
        ignore: ":hidden, [contenteditable='true']:not([name])",
        submitHandler: function() {
            var url;
            if (save_method == 'add') {
                url = base_url + "/cms/create_produk_value";
            } else {
                url = base_url + "/cms/update_produk_value";
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
                            html: $('#nama').val() + '<br>' + data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                    } else {
                        $('#table').DataTable().ajax.reload();
                        $('#mdl-produk-value').modal('hide');
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
            deskripsi: {
                required: true
            },
            status: {
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

    $('#mdl-produk-value').modal({ backdrop: 'static', keyboard: false });

    $(document).on('click', '.add', function() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#mdl-produk-value').modal('show');
        $('.modal-title').text('Tambah Produk Value');
    });

    $(document).on('click', '.edit', function() {
        save_method = 'update';
        $('#form').trigger("reset");
        $('#mdl-produk-value').modal('show');
        $('.update').text('Update');

        $('.modal-title').text('Edit Produk Value');
        $('[name="id"]').val($(this).data('id'));
        $('[name="judul"]').val($(this).data('judul'));
        $('[name="deskripsi"]').val($(this).data('deskripsi'));
        $('[name="status"]').val($(this).data('status'));
    })

    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Anda Yakin?',
            html: "<b> Data ini akan Dihapus! </b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Hapus!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "/cms/delete_produk_value/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#table').DataTable().ajax.reload();
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
                        alert('Error');
                    }
                });
            }
        })
    });
});