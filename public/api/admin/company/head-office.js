let company_id = null

// Province
$.ajax({
    url: `${api_url}/master_param/province`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.province}</option>`
            $('#province_id').append(append)
        })
    }
})

// District/City
function get_city(province_id, city_id) {
	$('#city_id').empty()
	$.ajax({
	    url: `${api_url}/master_param/city/${province_id}`,
	    type: 'GET',
	    success: function(result) {
	        // console.log(result)
	        let append = `<option disabled selected value="">Choose</option>`
	        $.each(result.data, function(index, value) {
	            append += `<option value="${value.id}">${value.city}</option>`
	        })
            $('#city_id').append(append)
	        if (city_id != undefined) {
	        	$('#city_id').val(city_id)
	        }
	    }
	})
}

// JKK
$.ajax({
    url: `${api_url}/master_param/jkk`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.name}%</option>`
            $('#jkk_id').append(append)
        })
    }
})

$('#province_id').change(function() {
	get_city($(this).val())
})

stop = false
$(document).ajaxStop(function() {
	if (stop == false) {
		get_data()
	    $('#card').show()
	    $('#loading').remove()
	}
})

function get_data() {
	$.ajax({
	    url: `${api_url}/company/fetch`,
	    type: 'GET',
	    data: {
	        type: 'center'
	    },
	    success: function(result) {
	        // console.log(result)
	        let value = result.data
	        company_id = value.id
	        if (value.logo_url != `${root}/storage/`) {
		        $('#image').attr('src', value.logo_url)
		    }
	        $('#name').val(value.name)
	        $('#parent_id').val(value.parent_id)
	        $('#address').val(value.address)
	        $('#postal_code').val(value.postal_code)
	        value.province != null ? $('#province_id').val(value.province.id) : ''
	        value.city != null ? get_city(value.province.id, value.city.id) : ''
	        $('#umr').val(fnumber(value.umr))
	        $('#phone_number').val(value.phone_number)
	        $('#email').val(value.email)
	        $('#bpjs').val(value.bpjs)
	        value.jkk != null ? $('#jkk_id').val(value.jkk.id) : ''
	        $('#npwp').val(value.npwp)
	        $('#taxable_date').val(value.taxable_date)
	        $('#tax_person_name').val(value.tax_person_name)
	        $('#tax_person_npwp').val(value.tax_person_npwp)
	        if (value.signature_url != `${root}/storage/`) {
		        $('#signature-image').attr('src', value.signature_url)
		        $('#signature').parents('.custom-file').hide()
		        $('#signature-preview').show()
		    }
	        stop = true
	    }
	})
}

$('form').submit(function(e) {
    addLoading()
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid')

    let formData = new FormData()
    photo != null ? formData.append('logo', photo, photoname) : ''
    formData.append('name', $('#name').val())
    formData.append('address', $('#address').val())
    formData.append('postal_code', $('#postal_code').val())
    formData.append('province_id', $('#province_id').val())
    formData.append('city_id', $('#city_id').val())
    $('#umr').val() != '' ? formData.append('umr', frtn($('#umr').val())) : ''
    formData.append('phone_number', $('#phone_number').val())
    formData.append('email', $('#email').val())
    formData.append('bpjs', $('#bpjs').val())
    formData.append('jkk_id', $('#jkk_id').val())
    formData.append('npwp', $('#npwp').val())
    formData.append('taxable_date', $('#taxable_date').val())
    formData.append('tax_person_name', $('#tax_person_name').val())
    formData.append('tax_person_npwp', $('#tax_person_npwp').val())
    signature != null ? formData.append('signature', signature) : ''
    
	$.ajax({
	    url: `${api_url}/company/${company_id}/update`,
	    type: 'POST',
	    data: formData,
        processData: false,
        contentType: false,
	    success: function(result) {
	        customAlert('success', 'Head office updated')
	    },
	    error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.name) {
                $('#name').addClass('is-invalid')
                $('#name').siblings('.invalid-feedback').html(err.name)
            }
            if (err.address) {
                $('#address').addClass('is-invalid')
                $('#address').siblings('.invalid-feedback').html(err.address)
            }
            if (err.postal_code) {
                $('#postal_code').addClass('is-invalid')
                $('#postal_code').siblings('.invalid-feedback').html(err.postal_code)
            }
            if (err.province_id) {
                $('#province_id').addClass('is-invalid')
                $('#province_id').siblings('.invalid-feedback').html(err.province_id)
            }
            if (err.city_id) {
                $('#city_id').addClass('is-invalid')
                $('#city_id').siblings('.invalid-feedback').html(err.city_id)
            }
            if (err.phone_number) {
                $('#phone_number').addClass('is-invalid')
                $('#phone_number').siblings('.invalid-feedback').html(err.phone_number)
            }
            if (err.email) {
                $('#email').addClass('is-invalid')
                $('#email').siblings('.invalid-feedback').html(err.email)
            }
            if (err.bpjs) {
                $('#bpjs').addClass('is-invalid')
                $('#bpjs').siblings('.invalid-feedback').html(err.bpjs)
            }
            if (err.jkk_id) {
                $('#jkk_id').addClass('is-invalid')
                $('#jkk_id').siblings('.invalid-feedback').html(err.jkk_id)
            }
            if (err.npwp) {
                $('#npwp').addClass('is-invalid')
                $('#npwp').siblings('.invalid-feedback').html(err.npwp)
            }
            if (err.taxable_date) {
                $('#taxable_date').addClass('is-invalid')
                $('#taxable_date').siblings('.invalid-feedback').html(err.taxable_date)
            }
            if (err.tax_person_name) {
                $('#tax_person_name').addClass('is-invalid')
                $('#tax_person_name').siblings('.invalid-feedback').html(err.tax_person_name)
            }
            if (err.tax_person_npwp) {
                $('#tax_person_npwp').addClass('is-invalid')
                $('#tax_person_npwp').siblings('.invalid-feedback').html(err.tax_person_npwp)
            }
	    },
	    complete: function() {
            removeLoading('Save Changes')
	    }
	})
})
