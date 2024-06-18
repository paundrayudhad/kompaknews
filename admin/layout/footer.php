</div>
</div>
</div>
</div>
</div>
<script src="<?= $base_url; ?>assets-admin/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= $base_url; ?>assets-admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $base_url; ?>assets-admin/js/sidebarmenu.js"></script>
<script src="<?= $base_url; ?>assets-admin/js/app.min.js"></script>
<script src="<?= $base_url; ?>assets-admin/libs/simplebar/dist/simplebar.js"></script>
<script src="<?= $base_url; ?>assets/ckeditor/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</body>
<script type="text/javascript"> 
function modal(name,link,size) {
    console.log(name);
    $.ajax({
        type: "GET",
        url: link,
        beforeSend: function() {
            $('#SModal-title').html(name);
            $('#SModal-body').html('Loading...');
            if(size == 'sm' || size == 'small') {
                $('#SModal-size').addClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            } else if(size == 'lg' || size == 'large') {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').addClass('modal-lg');
            } else {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            }
        },
        success: function(result) {
            $('#SModal-title').html(name);
            $('#SModal-body').html(result);
            if(size == 'sm' || size == 'small') {
                $('#SModal-size').addClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            } else if(size == 'lg' || size == 'large') {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').addClass('modal-lg');
            } else {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            }
        },
        error: function() {
            $('#SModal-title').html(name);
            $('#SModal-body').html('Failed to get contents...');
            if(size == 'sm' || size == 'small') {
                $('#SModal-size').addClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            } else if(size == 'lg' || size == 'large') {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').addClass('modal-lg');
            } else {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            }
        }
    });
    $('#SModal').modal();
}
</script>
</html>