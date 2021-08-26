let board_id = null
let pic_id = null

$.ajax({
    url: `${api_url}/division/fetch/${division_id}`,
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        let value = result.data
        // console.log(result)
        pic_id = value.pic.id
        $('title').prepend(value.name)
        $('#project').html(value.name)
        if (role == 100 || role == 101) {
        	if (pic_id == user_id) {
				$('#modal').removeClass('none')
        	}
		}
    }
})


$.ajax({
    url: `${api_url}/employee/fetch`,
    type: 'GET',
    data: {
        pic_id: user_id
    },
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
    	// console.log(result)
        $.each(result.data, function(index, value) {
        	if (value.user_id != pic_id) {
	            append = `<div class="dropdown-item members" data-id="${value.id}" data-name="${value.name}" role="button">
					<img src="${value.profile_photo_url}" class="rounded-circle mr-2" width="24">
					<span class="pl-0">${value.name}</span>
				</div>`
	            $('#list-members').append(append)
	        }
        })
    }
})

get_data()

function get_data() {
    $('#modal').nextAll().remove()
    $.ajax({
        url: `${api_url}/board/fetch`,
        type: 'GET',
        data: {
            division_id: division_id
        },
        success: function(result) {
            $.each(result.data, function(index, value) {
                // console.log(value)
                option = ''
                if (role == 100 || role == 101) {
                	if (pic_id == user_id) {
		                option = `<div class="d-flex ml-2">
							<i class="mdi mdi-18px mdi-pencil-outline pr-0 mr-2 edit" role="button"></i>
							<i class="mdi mdi-18px mdi-trash-can-outline pr-0 delete" role="button"></i>
						</div>`
                	}
                }
                append = `<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
		        	<div class="card card-height" data-id="${value.id}" data-title="${value.title}">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h6 class="mb-0">${value.title}</h6>
							${option}
						</div>
						<a href="${root}/task-management/task/${value.id}" class="card-body text-dark">
							<p class="text-secondary text-truncate mb-0">${value.description != null ? value.description : '-'}</p>
						</a>
					</div>
				</div>`
                $('#data').append(append)
            })
        }
    })
}

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
        success: function(result) {
            // console.log(result)
            $('#modal-create').modal('hide')
            customAlert('success', 'Project created')
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
    let id = $(this).parents('.card').attr('data-id')
    $('#modal-edit').modal('show')
    $('#edit').attr('data-id', id)
    $.ajax({
        url: `${api_url}/board/fetch/${id}`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            let value = result.data
            $('#edit_title').val(value.title)
            $('#edit_description').val(value.description)
            $('#edit').attr('disabled', false)
            board_id = value.id
        }
    })
    get_member(id)
})

function get_member(id_member) {
    $('#members').empty()
    $('#loading-member').show()
    $.ajax({
        url: `${api_url}/board/${id_member}/get_member`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
            	index != 0 ? remove = `<div class="dropdown-item remove-member" data-id="${value.id}" data-name="${value.name}" role="button">Remove from project</div>` : remove = ''
                append = `<div class="dropdown">
					<img src="${value.profile_photo_url}" class="rounded-circle mr-1" width="24" data-toggle="dropdown" role="button">
					<div class="dropdown-menu py-0" aria-labelledby="dropdown-member">
						<div class="p-3 border-bottom">
							<div class="d-flex">
								<img src="${value.profile_photo_url}" class="rounded-circle pb-1" width="40">
								<div class="ml-3 text-truncate">
									<h6 class="mb-0 text-truncate">${value.name}</h6>
									<small class="text-secondary">@${value.username}</small>
								</div>
							</div>
						</div>
						${remove}
					</div>
				</div>`
                $('#members').append(append)
            })
            $('#loading-member').hide()
        }
    })
}

$(document).on('click', '.members', function() {
    let name = $(this).attr('data-name')
    let formData = new FormData()
    formData.append('user_id', $(this).attr('data-id'))
    $.ajax({
        url: `${api_url}/board/${board_id}/add_member`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            // console.log(result)
            customAlert('success', `${name} added to project`)
            get_member(board_id)
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            let msg = xhr.responseJSON.data.message
            // console.log(xhr)
            if (msg == "user already exists in this board") {
	            customAlert('danger', `${name} has been added in this project`)
            }
        }
    })
})

$(document).on('click', '.remove-member', function() {
    let member_id = $(this).attr('data-id')
    let member_name = $(this).attr('data-name')
    $.ajax({
        url: `${api_url}/board/${member_id}/delete_member`,
        type: 'DELETE',
        success: function(result) {
            customAlert('success', `${member_name} removed from project`)
            get_member(board_id)
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.log(err)
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
        success: function(result) {
            // console.log(result)
            customAlert('success', 'Project updated')
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
    let id = $(this).parents('.card').attr('data-id')
    let title = $(this).parents('.card').attr('data-title')
    $('#modal-delete .modal-body b').html(title)
    $('#delete').attr('data-id', id)
    $('#delete').attr('data-title', title)
})

$(document).on('click', '#delete', function() {
    let id = $('#delete').attr('data-id')
    let title = $('#delete').attr('data-title')
    $.ajax({
        url: `${api_url}/board/${id}/soft_delete`,
        type: 'DELETE',
        success: function(result) {
        	// console.log(result)
            customAlert('success', 'Project deleted')
            $('#modal-delete').modal('hide')
            get_data()
        }
    })
})
