let parent_id = null

// Parent
$.ajax({
    url: `${api_url}/company/fetch`,
    type: 'GET',
    data: {
    	type: 'center'
    },
    success: function(result) {
        // console.log(result)
        parent_id = result.data.id
    }
})

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

$(document).ajaxStop(function() {
    $('#card').show()
    $('#loading').remove()
})

$('form').submit(function(e) {
    addLoading()
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid')

    let formData = new FormData()
    photo != null ? formData.append('logo', photo, photoname) : ''
    formData.append('type', 'branch')
    formData.append('parent_id', parent_id)
    formData.append('name', $('#name').val())
    formData.append('address', $('#address').val())
    formData.append('postal_code', $('#postal_code').val())
    formData.append('province_id', $('#province_id').val())
    formData.append('city_id', $('#city_id').val())
    formData.append('umr', frtn($('#umr').val()))
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
	    url: `${api_url}/company/create`,
	    type: 'POST',
	    data: formData,
        processData: false,
        contentType: false,
	    success: function(result) {
	        location.href = `${root}/company/branch`
	    },
	    error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.logo) {
                $('#photo').addClass('is-invalid')
                $('#photo').siblings('.invalid-feedback').html(err.logo)
            }
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
            if (err.umr) {
                $('#umr').addClass('is-invalid')
                $('#umr').siblings('.invalid-feedback').html(err.umr)
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
            if (err.signature) {
                $('#signature-image').addClass('is-invalid')
                $('#signature-image').siblings('.invalid-feedback').html(err.signature)
            }
            removeLoading('Submit')
	    }
	})
})
