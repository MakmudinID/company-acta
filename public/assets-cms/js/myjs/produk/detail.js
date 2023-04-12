jQuery(document).ready(function() {
    $(document).on("click", ".detail-produk", function() {
        $("#detail-produk").modal("show");
        var output = document.getElementById('photo-produk');
        output.src = $(this).data('photo');

        $('#text-nama').text($(this).data('nama'));
        $('#text-merek').text($(this).data('merek'));
        $('#text-deskripsi').html($(this).data('deskripsi'));
    });
});