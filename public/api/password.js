$('form').submit(function(e) {
    addLoading()
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid')

    let formData = new FormData()
    formData.append('user_id', user_id)
    formData.append('old_password', $('#password').val())
    formData.append('password', $('#npassword').val())
    formData.append('password_confirmation', $('#cpassword').val())

    $.ajax({
        url: `${api_url}/reset_password`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            // console.log(result)
            addLoading()
            customAlert('success', 'Change password successfully')
            $('input').val('')
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            let dat = xhr.responseJSON.data
            // console.clear()
            // console.log(err)
            // console.log(xhr)
            // console.log(dat)
            if (dat == undefined) {
	            if (err.old_password) {
	                $('#password').addClass('is-invalid')
	                $('#password').siblings('.invalid-feedback').html(err.old_password)
	            }
	            if (err.password) {
	                if (err.password != "The password confirmation does not match.") {
	                    $('#npassword').addClass('is-invalid')
	                    $('#npassword').siblings('.invalid-feedback').html("The new password field is required.")
	                } else {
	                    $('#cpassword').addClass('is-invalid')
	                    $('#cpassword').siblings('.invalid-feedback').html(err.password)
	                }
	            }
	            if (err.password_confirmation) {
	                $('#cpassword').addClass('is-invalid')
	                $('#cpassword').siblings('.invalid-feedback').html(err.password_confirmation)
	            }
            } else {
                $('#password').addClass('is-invalid')
                $('#password').siblings('.invalid-feedback').html("The current password is invalid.")
            }
        },
        complete: function() {
            removeLoading('Submit')
        }
    })
})
