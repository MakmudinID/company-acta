"use strict";

let table; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function() {
    var csrfName = $('meta[name="csrf"]').attr('content') // CSRF Token name
    var csrfHash = $('meta[name="csrf_token"]').attr('content') // CSRF hash
    var save_method;
    table = $('#table').DataTable({
        "ajax": {
            "url": base_url + "/adminprofil/sejarah_singkat_",
            "type": "POST",
            data: function(d){
                d[csrfName] = csrfHash;
            }
        },
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "order": [],
        "columnDefs": [{
                "targets": [-1],
                "orderable": false,
                "className": "text-center",
            },
            {
                "targets": [0, 2, 3],
                "className": "text-center",
            },
            {
                "targets": [1],
                "className": "text-wrap",
            }
        ]
    });

    $(document).on('click', '.add', function() {
        save_method = 'add';
        document.getElementById("row-display").style.display = "none";
        $('#form')[0].reset();
        $('#modal-default').modal('show');
        $('.modal-title').text('Tambah Sejarah Singkat');
    });

    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ol', 'ul', 'paragraph']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $(document).on('click', '.edit', function() {
        save_method = 'update';
        $('#form')[0].reset();
        document.getElementById("row-display").style.display = "block";
        document.getElementById("output_image").src = $(this).data('gambar');
        $('#modal-default').modal('show');
        $('.update').text('Update');
        $('.modal-title').text('Edit Sejarah Singkat');
        $('[name="id"]').val($(this).data('id'));
        $('[name="deskripsi"]').summernote('code', $(this).data('deskripsi'));
        $('[name="gambar_"]').val($(this).data('gambar'));
        $('[name="status"]').val($(this).data('status'));
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Anda Yakin?',
            html: "<br><b>Data Ini Akan Dihapus! </b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "/adminprofil/delete_sejarah_singkat/" + id,
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

    $.validator.setDefaults({
        submitHandler: function() {
            var url;
            if (save_method == 'add') {
                url = base_url + "/adminprofil/create_sejarah_singkat";
            } else {
                url = base_url + "/adminprofil/update_sejarah_singkat";
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
                            html: 'sejarah_singkat <br>' + data.status,
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