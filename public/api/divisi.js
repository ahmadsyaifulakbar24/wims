get_data()

function get_data() {
	$('#modal').nextAll().remove()
	$.ajax({
	    url: `${api_url}/division/fetch`,
	    type: 'GET',
	    // data: {
	    //     user_id: user
	    // },
	    beforeSend: function(xhr) {
	        xhr.setRequestHeader("Authorization", "Bearer " + token)
	    },
	    success: function(result) {
	        $.each(result.data, function(index, value) {
		        // console.log(value)
		        append = `<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
		        	<div class="card card-height">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h6 class="mb-0">${value.name}</h6>
							<div class="d-flex ml-2">
								<i class="mdi mdi-18px mdi-pencil-outline pr-0 mr-2 update" data-id="${value.id}" data-name="${value.name}" role="button"></i>
								<i class="mdi mdi-18px mdi-trash-can-outline pr-0 delete" data-id="${value.id}" data-name="${value.name}" role="button"></i>
							</div>
						</div>
						<a href="${root}/task-management/division/${value.id}" class="card-body text-dark">
							<p class="text-secondary">${value.pic.name}</p>
						</a>
					</div>
				</div>`
		        $('#data').append(append)
	        })
	    }
	})
}

$.ajax({
    url: `${api_url}/employee/fetch`,
    type: 'GET',
    data: {
        pic_id: user
    },
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        $.each(result.data, function(index, value) {
	        // console.log(value)
	        append = `<option value="${value.id}">${value.name}</option>`
	        $('.pic_id').append(append)
        })
    }
})

$(document).ajaxStop(function() {
    $('#card').show()
    $('#loading').remove()
})

$('.modal').on('shown.bs.modal', function() {
    $('#name').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('.is-invalid').removeClass('is-invalid')
    $('#submit').attr('disabled', false)
    $('#edit').attr('disabled', true)
    $('#name').val('')
    $('#pic_id').val('')
})

$('#form-create').submit(function(e) {
    e.preventDefault()
    let formData = new FormData()
    formData.append('name', $('#name').val())
    formData.append('pic_id', $('#pic_id').val())
    formData.append('user_id', user)
    $('#submit').attr('disabled', true)
    $.ajax({
        url: `${api_url}/division/create`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            $('#modal-create').modal('hide')
            get_data()
        },
        error: function(xhr) {
            $('#submit').attr('disabled', false)
        	let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.name) {
                $('#name').addClass('is-invalid')
                $('#name').siblings('div').html('Please enter division name')
            }
            if (err.pic_id) {
                $('#pic_id').addClass('is-invalid')
                $('#pic_id').siblings('div').html('Please select pic')
            }
        }
    })
})

$(document).on('click', '.update', function() {
	$('#modal-edit').modal('show')
	let id = $(this).data('id')	
	$('#edit').attr('data-id', id)
    $.ajax({
	    url: `${api_url}/division/fetch/${id}`,
	    type: 'GET',
	    beforeSend: function(xhr) {
	        xhr.setRequestHeader("Authorization", "Bearer " + token)
	    },
	    success: function(result) {
	    	let value = result.data
	    	// console.log(result)
	    	$('#edit_name').val(value.name)
	    	$('#edit_pic_id').val(value.pic.id)
	    }
	})
})
$('#form-edit').submit(function(e) {
    e.preventDefault()
    let formData = new FormData()
    formData.append('name', $('#edit_name').val())
    formData.append('pic_id', $('#edit_pic_id').val())
    formData.append('user_id', user)
    $('#submit').attr('disabled', true)
    $.ajax({
        url: `${api_url}/division/create`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            $('#modal-edit').modal('hide')
            get_data()
        },
        error: function(xhr) {
            $('#submit').attr('disabled', false)
        	let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.name) {
                $('#name').addClass('is-invalid')
                $('#name').siblings('div').html('Please enter division name')
            }
            if (err.pic_id) {
                $('#pic_id').addClass('is-invalid')
                $('#pic_id').siblings('div').html('Please select pic')
            }
        }
    })
})


$(document).on('click', '.delete', function() {
	$('#modal-delete').modal('show')
	let id = $(this).data('id')
	let name = $(this).data('name')
	$('#modal-delete .modal-body b').html(name)
	$('#delete').attr('data-id', id)
})
