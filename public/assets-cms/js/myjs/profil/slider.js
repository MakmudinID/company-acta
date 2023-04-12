"use strict";

let table; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function() {
    var csrfName = $('meta[name="csrf"]').attr('content') // CSRF Token name
    var csrfHash = $('meta[name="csrf_token"]').attr('content') // CSRF hash
    var save_method;
    table = $('#table').DataTable({
        "ajax": {
            "url": base_url + "/cms/slider_",
            "type": "POST",
            data: function(d) {
                d[csrfName] = csrfHash;
            }
        },
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "order": [],
        "columnDefs": [{
                "targets": [-1, 2],
                "orderable": false,
                "className": "text-center",
            },
            {
                "targets": [0, 1],
                "className": "text-center",
            },
            {
                "targets": [3],
                "className": "text-wrap",
            }
        ]
    });

    $('#modal-default').modal({ backdrop: 'static', keyboard: false });

    $(document).on('click', '.add', function() {
        save_method = 'add';
        document.getElementById("row-display").style.display = "none";
        $('#form')[0].reset();
        $('#modal-default').modal('show');
        $('.modal-title').text('Tambah Slider');
    });

    $(document).on('click', '.edit', function() {
        save_method = 'update';
        $('#form')[0].reset();
        document.getElementById("row-display").style.display = "block";
        document.getElementById("output_image").src = $(this).data('gambar');
        $('#modal-default').modal('show');
        $('.update').text('Update');
        $('.modal-title').text('Update Slider');
        $('[name="id"]').val($(this).data('id'));
        $('[name="no_urut"]').val($(this).data('urutan'));
        $('[name="title_bold"]').val($(this).data('title_bold'));
        $('[name="title_normal"]').val($(this).data('title'));
        $('[name="keterangan"]').val($(this).data('keterangan'));
        $('[name="gambar_"]').val($(this).data('gambar'));
        $('[name="status"]').val($(this).data('status'));
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Anda Yakin?',
            html: "<b>Data ini akan Dihapus! </b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "/cms/delete_slider/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#table').DataTable().ajax.reload();
                        Swal.fire({
                            title: data.title,
                            html: data.status,
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

    $.validator.setDefaults({
        submitHandler: function() {
            var url;
            if (save_method == 'add') {
                url = base_url + "/cms/create_slider";
            } else {
                url = base_url + "/cms/update_slider";
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
                            html: data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                    } else {
                        $('#table').DataTable().ajax.reload();
                        $('#modal-default').modal('hide');
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
            urutan: {
                required: true
            },
            status: {
                required: true
            },
            gambar: {
                required: function() {
                    if ($("#id").val() == "") {
                        return true;
                    } else {
                        return false;
                    }
                },
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

function preview_image(event) {
    document.getElementById("row-display").style.display = "block";
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}