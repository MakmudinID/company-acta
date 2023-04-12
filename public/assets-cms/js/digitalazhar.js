$(function() {
    if ($('#myform').length > 0) {
        $('#myform').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true; // Don't submit form for this demo
            });
    }
});

$('#logout').click(function() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Anda akan keluar aplikasi ini!!',
        type: 'error',
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-danger btn-lg',
            cancelButton: 'btn btn-secondary btn-lg'
        }
    }).then(function(result) {
        if (result.value) {
            window.location.href = base_url + "/logout";
        } else {
            Swal.fire('Cancelled', 'Terima kasih', 'error');
        }
    });
});

$(document).ready(function() {
    $('.delete').on('click', function(e, data) {
        if (!data) {
            handleDelete(e, 1);
        } else {
            window.location = $(this).attr('href');
        }
    });
});

function handleDelete(e, stop) {
    if (stop) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'Anda akan menghapus data ini!!',
            type: 'error',
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-danger btn-lg',
                cancelButton: 'btn btn-default btn-lg'
            }
        }).then(function(result) {
            if (result.value) {
                $(e.target).trigger('click', {});
            } else {
                Swal.fire('Cancelled', 'Terima kasih', 'error');
            }
        });
    }
};

/**
 * Custom file input
 */
$(document).ready(function() {
    bsCustomFileInput.init();
});

$(document).on('click', '#btn-submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: 'Anda akan melanjutkan!!',
        type: 'error',
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-danger btn-lg',
            cancelButton: 'btn btn-default btn-lg'
        }
    }).then(function(result) {
        if (result.value) {
            $('#myform').submit();
        }
    });
});

$(document).on('click', '#btn-submit-profile', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: 'Anda akan melanjutkan, Anda akan keluar sistem jika proses ini berhasil!!',
        type: 'error',
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-danger btn-lg',
            cancelButton: 'btn btn-default btn-lg'
        }
    }).then(function(result) {
        if (result.value) {
            $('#myform').submit();
        }
    });
});

// Bootstrap Daterangepicker
$(function() {
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

    $('.daterange-picker').daterangepicker({
        opens: (isRtl ? 'left' : 'right'),
        alwaysShowCalendars: true,
        timePicker: true,
        showWeekNumbers: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        },
        ranges: {
            'Today': [moment().startOf('day'), moment().endOf('day')],
            'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment().endOf('day')],
            'Last 30 Days': [moment().subtract(29, 'days'), moment().endOf('day')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('.daterange-picker2').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        timePickerSeconds: true,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        },
        opens: (isRtl ? 'left' : 'right')
    });

    $('.daterange-picker3').daterangepicker({
        opens: (isRtl ? 'left' : 'right'),
        alwaysShowCalendars: true,
        timePicker: false,
        showWeekNumbers: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
        ranges: {
            'Today': [moment().startOf('day'), moment().endOf('day')],
            'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment().endOf('day')],
            'Last 30 Days': [moment().subtract(29, 'days'), moment().endOf('day')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        container: '#mdl-window',
    });

    $('.datetimepicker').bootstrapMaterialDatePicker({
        weekStart: 1,
        format: 'YYYY-MM-DD HH:mm:ss',
        shortTime: true,
        nowButton: true,
        minDate: new Date()
    });

    // $('.datetimepicker_singl').datetimepicker({
    //     format: 'yyyy-mm-dd hh:ii:ss'
    // });
});