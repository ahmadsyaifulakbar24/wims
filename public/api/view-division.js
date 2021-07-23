get_data()

function get_data() {
    $('#modal').nextAll().remove()
    $.ajax({
        url: `${api_url}/board/fetch`,
        type: 'GET',
        data: {
            division_id: division_id
        },
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            $.each(result.data, function(index, value) {
                // console.log(value)
                append = `<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
		        	<div class="card card-height">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h6 class="mb-0">${value.title}</h6>
							<div class="d-flex ml-2">
								<i class="mdi mdi-18px mdi-pencil-outline pr-0 mr-2 edit" data-id="${value.id}" data-title="${value.title}" role="button"></i>
								<i class="mdi mdi-18px mdi-trash-can-outline pr-0 delete" data-id="${value.id}" data-title="${value.title}" role="button"></i>
							</div>
						</div>
						<a href="${root}/task-management/board/${value.id}" class="card-body text-dark">
							<p class="text-secondary text-truncate mb-0">${value.description}</p>
						</a>
					</div>
				</div>`
                $('#data').append(append)
            })
        }
    })
}

$.ajax({
    url: `${api_url}/division/fetch/${division_id}`,
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        let value = result.data
        // console.log(result)
        $('title').prepend(value.name)
        $('#division').html(value.name)
    }
})

$(document).ajaxStop(function() {
    $('#card').show()
    $('#loading').remove()
})

$('.modal').on('shown.bs.modal', function() {
    $('input').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('.is-invalid').removeClass('is-invalid')
    $('#edit').attr('disabled', true)
    $('input').val('')
    $('select').val('')
})

$('#form-create').submit(function(e) {
    e.preventDefault()
    let formData = new FormData()
    formData.append('division_id', division_id)
    formData.append('title', $('#title').val())
    formData.append('description', $('#description').val())
    $('#submit').attr('disabled', true)
    $.ajax({
        url: `${api_url}/board/create`,
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
            if (err.title) {
                $('#title').addClass('is-invalid')
                $('#title').siblings('.invalid-feedback').html(err.title)
            }
        }
    })
})

$(document).on('click', '.edit', function() {
    let id = $(this).data('id')
    $('#modal-edit').modal('show')
    $('#edit').attr('data-id', id)
    $.ajax({
        url: `${api_url}/board/fetch/${id}`,
        type: 'GET',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            // console.log(result)
            let value = result.data
            $('#edit_title').val(value.title)
            $('#edit_description').val(value.description)
            $('#edit').attr('disabled', false)
        }
    })
})
$('#form-edit').submit(function(e) {
    e.preventDefault()
    let id = $('#edit').attr('data-id')
    $('#edit').attr('disabled', true)
    $.ajax({
        url: `${api_url}/board/${id}/update`,
        type: 'PATCH',
        data: {
            title: $('#edit_title').val(),
            description: $('#edit_description').val()
        },
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            $('#modal-edit').modal('hide')
            get_data()
        },
        error: function(xhr) {
            $('#edit').attr('disabled', false)
            let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.title) {
                $('#edit_title').addClass('is-invalid')
                $('#edit_title').siblings('.invalid-feedback').html(err.title)
            }
        }
    })
})

$(document).on('click', '.delete', function() {
    $('#modal-delete').modal('show')
    let id = $(this).data('id')
    let title = $(this).data('title')
    $('#modal-delete .modal-body b').html(title)
    $('#delete').attr('data-id', id)
})
$(document).on('click', '#delete', function() {
    let id = $('#delete').attr('data-id')
    $.ajax({
        url: `${api_url}/board/${id}/soft_delete`,
        type: 'DELETE',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            $('#modal-delete').modal('hide')
            get_data()
        }
    })
})
