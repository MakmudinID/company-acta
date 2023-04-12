jQuery(document).ready(function() {
    $(document).on("click", ".detail-blog", function() {
        $("#detail-blog").modal("show");
        var output = document.getElementById('photo-blog');
        output.src = $(this).data('photo');
        $('#text-judul').text($(this).data('judul'));
        $('#text-date').text($(this).data('date'));
        $('#text-create').text($(this).data('create'));
        $('#text-konten').html($(this).data('konten'));
        $('#text-tag').html($(this).data('tag'));
    });
});