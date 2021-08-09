let signature = null

$('#signature').change(function(e) {
    $(this).parents('.custom-file').hide()
    let file = this.files[0]
    let fileType = file['type']
    let fileSize = file['size']
    let fileName = file['name']
	signature = file

    // if (fileType == 'image/jpeg') {
	    if (fileSize <= 10000000) {
	        if ($('#signature')[0].files.length !== 0) {
	            let input = e.currentTarget
	            let reader = new FileReader()
	            reader.onload = function() {
	                $('#signature-preview').show()
	                $('#signature-image').attr('src', reader.result)
	            }
	            reader.readAsDataURL(input.files[0])
	            $('#signature-image').removeClass('is-invalid')
	        }
	    } else {
	        $('#signature').addClass('is-invalid')
	        $('#signature').siblings('.invalid-feedback').html('Ukuran maksimum 10MB')
	    }
    // } else {
    //     $('#signature').addClass('is-invalid')
    //     $('#signature').siblings('.invalid-feedback').html('Format file JPG')
    // }
})