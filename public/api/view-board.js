let task_id = null

get_data()

function get_data() {
    $('#modal').nextAll().remove()
    $.ajax({
        url: `${api_url}/task/fetch`,
        type: 'GET',
        data: {
            board_id: board_id
        },
        success: function(result) {
            $.each(result.data, function(index, value) {
                // console.log(value)
                append = `<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
		        	<div class="card card-height">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h6 class="mb-0">${value.title}</h6>
							<div class="d-flex ml-2">
								<i class="mdi mdi-18px mdi-trash-can-outline pr-0 delete" data-id="${value.id}" data-title="${value.title}" role="button"></i>
							</div>
						</div>
						<div class="card-body text-dark edit" data-id="${value.id}" role="button">
							<p class="text-secondary text-truncate mb-0">${value.description != null ? value.description : '<i>No description</i>'}</p>
						</a>
					</div>
				</div>`
                $('#data').append(append)
            })
        }
    })
}

$.ajax({
    url: `${api_url}/board/fetch/${board_id}`,
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        let value = result.data
        // console.log(result)
        $('title').prepend(value.title)
        $('#board').html(value.title)
    }
})

$(document).ajaxStop(function() {
    $('#card').show()
    $('#loading').remove()
})

$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('#form-create').submit(function(e) {
    e.preventDefault()
    $('#submit').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')
    let formData = new FormData()
    formData.append('board_id', board_id)
    formData.append('title', $('#title').val())
    formData.append('description', $('#description').val())
    formData.append('start_due_date', $('#start_due_date').val())
    formData.append('finish_due_date', $('#finish_due_date').val())
    $.ajax({
        url: `${api_url}/task/create`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
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
    task_id = $(this).attr('data-id')
    $('#modal-edit').modal('show')
    $('#members').empty()
    $.ajax({
        url: `${api_url}/task/fetch/${task_id}`,
        type: 'GET',
        data: {
            board_id: board_id
        },
        success: function(result) {
            let value = result.data
            // console.log(result)
            // $('title').prepend(value.title)
            $('#edit_title').val(value.title)
            $('#edit_start_due_date').val(value.start_due_date)
            $('#edit_finish_due_date').val(value.finish_due_date)
            $('#edit_description').val(value.description)
            $.each(result.members, function(index, value) {
                append = `<img class="rounded-circle mr-1" width="24">`
                $('#members').prepend(append)
            })
        }
    })
})

$('#dropdown-member').click(function() {
    setTimeout(function() {
        $('#search_user_id').focus()
    }, 100)
})

// $('#search_user_id').keyup(delay(function(e) {
//     let param = $(this).val()
//     let keyCode = e.originalEvent.keyCode
//     // 0-1 && A-Z || Backspace
//     if (keyCode >= 48 && keyCode <= 90 || keyCode == 8) {
//         param.length != 0 ? get_user(param) : ''
//     }
// }, 500))

// get_user()

// function get_user(param) {
$.ajax({
    url: `${api_url}/employee/fetch`,
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            // append = `<option value="${value.id}" data-photo="${value.profile_photo_url}">${value.name}</option>`
            append = `<div class="dropdown-item user_id" data-id="${value.id}" role="button">
					<img src="${value.profile_photo_url}" class="rounded-circle mr-2" width="24">
					<span class="pl-0">${value.name}</span>
				</div>`
            $('#user_id').append(append)
        })
    }
})
// }

// $('#user_id').change(function() {
// 	let id = $(this).val()
// 	let name = $(this).find('option:selected').html()
// 	let photo = $(this).find('option:selected').attr('data-photo')
// 	$('#members').prepend(`<img src="${photo}" class="avatar rounded-circle mr-1" width="24" data-toggle="tooltip" data-placement="bottom" title="${name}">`)
// 	// $('.dropdown').dropdown('hide')
// 	$('#user_id').val('')
// 	$('[data-toggle="tooltip"]').tooltip()
// })

$(document).on('click', '.user_id', function() {
    let formData = new FormData()
    formData.append('user_id', $(this).attr('data-id'))
    console.log(`user_id: ${$(this).attr('data-id')}`)
    $.ajax({
        url: `${api_url}/task/${task_id}/create_task_member`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            console.log(result)
            let append = `<div class="dropdown">
				<img src="${photo}" class="rounded-circle mr-1" width="24" data-toggle="dropdown" role="button">
				<div class="dropdown-menu py-0" aria-labelledby="dropdown-member">
					<div class="p-3 border-bottom">
						<div class="d-flex">
							<img src="${photo}" class="rounded-circle pb-1" width="40">
							<div class="ml-3 text-truncate">
								<h6 class="mb-0 text-truncate">Nur Hilmi</h6>
								<small class="text-secondary">@nurhlmi</small>
							</div>
						</div>
					</div>
					<div class="dropdown-item" role="button">Remove from task</div>
				</div>
			</div>`
            $('#members').append(append)
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            console.log(err)
        }
    })
    // $('#members').append(`<img src="${photo}" class="rounded-circle mr-1" width="24" data-toggle="tooltip" data-placement="bottom" title="${name}">`)
    // $('#dropdown-member').dropdown('show')
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
        url: `${api_url}/task/${id}/archive`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
            get_data()
        }
    })
})
