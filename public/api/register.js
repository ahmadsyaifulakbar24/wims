$.ajax({
    url: `${api_url}/master_param/employee_reach`,
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        // console.log(result)
        let append = `<option value="" disabled selected>Choose</option>`
        $.each(result.data, function(index, value) {
            append += `<option value="${value.id}">${value.name}</option>`
        })
        $('#employee_reach_id').html(append)
        $('#submit').attr('disabled', false)
    }
})

$('form').submit(function(e) {
    addLoading()
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid')

    $.ajax({
        url: `${api_url}/registration`,
        type: 'POST',
        data: {
            name: $('#name').val(),
            email: $('#email').val(),
            company_name: $('#company_name').val(),
            employee_reach_id: $('#employee_reach_id').val(),
            phone_number: $('#phone_number').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            password_confirmation: $('#cpassword').val()
        },
        success: function(result) {
            // console.log(result)
            location.href = `${root}/login?registration=success`
        },
        error: function(xhr) {
            removeLoading('Register')
            let err = xhr.responseJSON.errors
            console.clear()
            console.log(xhr)

            if (err.name) {
            	$('#name').addClass('is-invalid')
            	$('#name').siblings('.invalid-feedback').html(err.name)
            }
            if (err.email) {
            	$('#email').addClass('is-invalid')
            	$('#email').siblings('.invalid-feedback').html(err.email)
            }
            if (err.company_name) {
            	$('#company_name').addClass('is-invalid')
            	$('#company_name').siblings('.invalid-feedback').html(err.company_name)
            }
            if (err.employee_reach_id) {
            	$('#employee_reach_id').addClass('is-invalid')
            	$('#employee_reach_id').siblings('.invalid-feedback').html('The number of employee field is required.')
            }
            if (err.phone_number) {
            	$('#phone_number').addClass('is-invalid')
            	$('#phone_number').siblings('.invalid-feedback').html(err.phone_number)
            }
            if (err.username) {
            	$('#username').addClass('is-invalid')
            	$('#username').siblings('.invalid-feedback').html(err.username)
            }
            if (err.password) {
	            if (err.password != "The password confirmation does not match.") {
	            	$('#password').addClass('is-invalid')
	            	$('#password').siblings('.invalid-feedback').html(err.password)
	            } else {
	            	$('#cpassword').addClass('is-invalid')
	            	$('#cpassword').siblings('.invalid-feedback').html(err.password)
	            }
            }
            if (err.password_confirmation) {
            	$('#cpassword').addClass('is-invalid')
            	$('#cpassword').siblings('.invalid-feedback').html(err.password_confirmation)
            }
        }
    })
})
