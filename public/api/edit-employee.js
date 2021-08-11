// Education
$.ajax({
    url: `${api_url}/master_param/education`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.name}</option>`
            $('#education_id').append(append)
        })
    }
})

// Religion
$.ajax({
    url: `${api_url}/master_param/religion`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.name}</option>`
            $('#religion_id').append(append)
        })
    }
})

// Marital Status
$.ajax({
    url: `${api_url}/master_param/marital_status`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.name}</option>`
            $('#marital_status_id').append(append)
        })
    }
})

// Blood Type
$.ajax({
    url: `${api_url}/master_param/blood_type`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.name}</option>`
            $('#blood_type_id').append(append)
        })
    }
})

// Employee Status
$.ajax({
    url: `${api_url}/employee_status`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.param}</option>`
            $('#employee_status_id').append(append)
        })
    }
})

// Company
$.ajax({
    url: `${api_url}/company/fetch`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.name}</option>`
            $('#company_id').append(append)
        })
    }
})

// Organization
$.ajax({
    url: `${api_url}/organization`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.param}</option>`
            $('#organization_id').append(append)
        })
    }
})

// Job Position
$.ajax({
    url: `${api_url}/job_position`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.param}</option>`
            $('#job_position_id').append(append)
        })
    }
})

// Job Level
$.ajax({
    url: `${api_url}/job_level`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.param}</option>`
            $('#job_level_id').append(append)
        })
    }
})

// Bank
$.ajax({
    url: `${api_url}/master_param/bank`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.bank}</option>`
            $('#bank_id').append(append)
        })
    }
})

// PTKP
$.ajax({
    url: `${api_url}/ptkp`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.ptkp}</option>`
            $('#ptkp_id').append(append)
        })
    }
})

let stop = false
$(document).ajaxStop(function() {
    if (stop == false) {
		get_data()
        $('#card').show()
        $('#loading').remove()
    }
})

function get_data() {
    $.ajax({
        url: `${api_url}/employee/fetch/${employee_id}`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            let value = result.data
            // Personal Data
            $('#image').attr('src', value.profile_photo_url)
            $('#first_name').val(value.first_name)
            $('#last_name').val(value.last_name)
            $('#email').val(value.email)
            $('#mobile_phone').val(value.mobile_phone)
            $('#phone').val(value.phone)
            $('#place_of_birth').val(value.place_of_birth)
            $('#date_of_birth').val(value.date_of_birth)
            $(`#${value.gender}`).prop('checked', true)
            $('#religion_id').val(value.religion_id.id)
            $('#marital_status_id').val(value.marital_status_id.id)
            value.education_id != null ? $('#education_id').val(value.education_id.id) : ''
            value.blood_type_id != null ? $('#blood_type_id').val(value.blood_type_id.id) : ''

            // Identity & Address
            $('#identity_type').val(value.identity_type)
            $('#no_identity').val(value.no_identity)
            $('#expired_date_identity').val(value.expired_date_identity)
            $('#postal_code').val(value.postal_code)
            $('#identity_address').val(value.identity_address)
            $('#residential_address').val(value.residential_address)

		    // Employment Data
		    $('#employee_id').val(value.employee_id)
		    value.employee_status_id != null ? $('#employee_status_id').val(value.employee_status_id.id) : ''
		    $('#join_date').val(value.join_date)
		    $('#end_date').val(value.end_date)
		    value.company_id != null ? $('#company_id').val(value.company_id.id) : ''
		    value.organization_id != null ? $('#organization_id').val(value.organization_id.id) : ''
		    value.job_position_id != null ? $('#job_position_id').val(value.job_position_id.id) : ''
		    value.job_level_id != null ? $('#job_level_id').val(value.job_level_id.id) : ''

		    // Salary
		    $('#basic_salary').val(fnumber(value.basic_salary))
		    $('#type_salary').val(value.type_salary)

		    // Bank Account
		    value.bank_id != null ? $('#bank_id').val(value.bank_id.id) : ''
		    $('#bank_account').val(value.bank_account)
		    $('#bank_account_holder').val(value.bank_account_holder)

		    // Tax Configuration
		    $('#npwp').val(value.npwp)
		    value.ptkp_id != null ? $('#ptkp_id').val(value.ptkp_id) : ''

		    // BPJS Configuration
		    $('#bpjs_ketenagakerjaan').val(value.bpjs_ketenagakerjaan)
		    $('#bpjs_kesehatan').val(value.bpjs_kesehatan)
		    $('#bpjs_kesehatan_family').val(value.bpjs_kesehatan_family)

		    // Login Account
		    $('#username').val(value.username)
		    $('#active').val(value.active)

		    stop = true
        }
    })
}

$('form').submit(function(e) {
    addLoading()
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid')

    let formData = new FormData()
    // Personal Data
    photo != null ? formData.append('profile_photo', photo, photoname) : ''
    formData.append('first_name', $('#first_name').val())
    formData.append('last_name', $('#last_name').val())
    formData.append('email', $('#email').val())
    formData.append('mobile_phone', $('#mobile_phone').val())
    formData.append('phone', $('#phone').val())
    formData.append('place_of_birth', $('#place_of_birth').val())
    formData.append('date_of_birth', $('#date_of_birth').val())
    formData.append('gender', $('input[name="gender"]:checked').val())
    $('#education_id').val() != null ? formData.append('education_id', $('#education_id').val()) : ''
    formData.append('religion_id', $('#religion_id').val())
    formData.append('marital_status_id', $('#marital_status_id').val())
    $('#blood_type_id').val() != null ? formData.append('blood_type_id', $('#blood_type_id').val()) : ''

    // Identity & Address
    $('#identity_type').val() != null ? formData.append('identity_type', $('#identity_type').val()) : ''
    formData.append('no_identity', $('#no_identity').val())
    formData.append('expired_date_identity', $('#expired_date_identity').val())
    formData.append('postal_code', $('#postal_code').val())
    formData.append('identity_address', $('#identity_address').val())
    formData.append('residential_address', $('#residential_address').val())

    // Employment Data
    formData.append('employee_id', $('#employee_id').val())
    formData.append('employee_status_id', $('#employee_status_id').val())
    formData.append('join_date', $('#join_date').val())
    formData.append('end_date', $('#end_date').val())
    formData.append('company_id', $('#company_id').val())
    formData.append('organization_id', $('#organization_id').val())
    formData.append('job_position_id', $('#job_position_id').val())
    formData.append('job_level_id', $('#job_level_id').val())

    // Salary
    formData.append('basic_salary', frtn($('#basic_salary').val()))
    formData.append('type_salary', $('#type_salary').val())

    // Bank Account
    $('#bank_id').val() != null ? formData.append('bank_id', $('#bank_id').val()) : ''
    formData.append('bank_account', $('#bank_account').val())
    formData.append('bank_account_holder', $('#bank_account_holder').val())

    // Tax Configuration
    formData.append('npwp', $('#npwp').val())
    $('#ptkp_id').val() != null ? formData.append('ptkp_id', $('#ptkp_id').val()) : ''

    // BPJS Configuration
    formData.append('bpjs_ketenagakerjaan', $('#bpjs_ketenagakerjaan').val())
    formData.append('bpjs_kesehatan', $('#bpjs_kesehatan').val())
    formData.append('bpjs_kesehatan_family', $('#bpjs_kesehatan_family').val())

    // Login Account
    formData.append('username', $('#username').val())
    formData.append('active', $('#active').val())

    $.ajax({
        url: `${api_url}/employee/${employee_id}/update`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            // console.log(result)
            addLoading()
            location.href = `${root}/employee`
            // $('#form').hide()
            // $('#success').show()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.clear()
            // console.log(err)
            // console.log(xhr)
            if (err.first_name) {
                $('#first_name').addClass('is-invalid')
                $('#first_name').siblings('.invalid-feedback').html(err.first_name)
            }
            if (err.gender) {
                $('#gender').addClass('is-invalid')
                $('#gender').siblings('.invalid-feedback').html(err.gender)
            }
            if (err.religion_id) {
                $('#religion_id').addClass('is-invalid')
                $('#religion_id').siblings('.invalid-feedback').html(err.religion_id)
            }
            if (err.marital_status_id) {
                $('#marital_status_id').addClass('is-invalid')
                $('#marital_status_id').siblings('.invalid-feedback').html(err.marital_status_id)
            }
            if (err.employee_id) {
                $('#employee_id').addClass('is-invalid')
                $('#employee_id').siblings('.invalid-feedback').html(err.employee_id)
            }
            if (err.employee_status_id) {
                $('#employee_status_id').addClass('is-invalid')
                $('#employee_status_id').siblings('.invalid-feedback').html(err.employee_status_id)
            }
            if (err.join_date) {
                $('#join_date').addClass('is-invalid')
                $('#join_date').siblings('.invalid-feedback').html(err.join_date)
            }
            if (err.company_id) {
                $('#company_id').addClass('is-invalid')
                $('#company_id').siblings('.invalid-feedback').html(err.company_id)
            }
            if (err.organization_id) {
                $('#organization_id').addClass('is-invalid')
                $('#organization_id').siblings('.invalid-feedback').html(err.organization_id)
            }
            if (err.job_position_id) {
                $('#job_position_id').addClass('is-invalid')
                $('#job_position_id').siblings('.invalid-feedback').html(err.job_position_id)
            }
            if (err.job_level_id) {
                $('#job_level_id').addClass('is-invalid')
                $('#job_level_id').siblings('.invalid-feedback').html(err.job_level_id)
            }
            if (err.basic_salary) {
                $('#basic_salary').addClass('is-invalid')
                $('#basic_salary').siblings('.invalid-feedback').html(err.basic_salary)
            }
            if (err.type_salary) {
                $('#type_salary').addClass('is-invalid')
                $('#type_salary').siblings('.invalid-feedback').html(err.type_salary)
            }
            if (err.username) {
                $('#username').addClass('is-invalid')
                $('#username').siblings('.invalid-feedback').html(err.username)
            }
            removeLoading('Save Changes')
        }
    })
})
