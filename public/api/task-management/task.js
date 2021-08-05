$.ajax({
    url: `${api_url}/board/fetch/${board_id}`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        let value = result.data
        $('title').prepend(value.title)
        $('#board').html(value.title)
    }
})

let members = null
$.ajax({
    url: `${api_url}/employee/fetch`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        members = result
        //     $.each(result.data, function(index, value) {
        //         // append = `<option value="${value.id}" data-photo="${value.profile_photo_url}">${value.name}</option>`
        //         append = `<div class="dropdown-item user_id" data-id="${value.id}" role="button">
        // 	<img src="${value.profile_photo_url}" class="rounded-circle mr-2" width="24">
        // 	<span class="pl-0">${value.name}</span>
        // </div>`
        //         $('#user_id').append(append)
        //     })
    }
})

function get_task() {
    $('#list-task').empty()
    $.ajax({
        url: `${api_url}/task/fetch`,
        type: 'GET',
        data: {
            board_id: board_id
            // user_id
        },
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
                append = `<div class="card task mb-3" data-id="${value.id}" data-title="${value.title}" role="button">
					<div class="card-body">
						<h6>${value.title}</h6>
						<p>${value.description != null ? value.description : ''}</p>
						<small class="text-secondary">${date_format(value.created_at.substr(0, 10))}</small>
					</div>
				</div>`
                $('#list-task').append(append)
            })
        }
    })
}

function get_member() {
    $('#member-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_member`,
        type: 'GET',
        success: function(result) {
            console.log(result)
            // $.each(result.data, function(index, value) {
            //     append = ``
            //     $('#checklist-task').prepend(append)
            // })
        }
    })
}

function get_attachment() {
    $('#attachment-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_attachment`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
                append = `<div class="card mb-1" data-id="${value.id}" data-title="${value.name}">
					<div class="d-flex align-items-center">
						<a href="${root}/storage/${value.file_url}" class="d-flex align-items-center text-truncate my-3 ml-3" style="width: 90%" target="_blank">
							<i class="mdi mdi-24px mdi-file-outline text-dark"></i>
							<div class="text-primary text-truncate">${value.name}</div>
						</a>
						<i class="mdi mdi-24px mdi-trash-can-outline ml-auto delete delete-attachment px-3" role="button"></i>
					</div>
				</div>`
                $('#attachment-task').prepend(append)
            })
        }
    })
}

function get_checklist() {
    $('#checklist-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_checklist`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
                append = `<div class="mb-1">
					<div class="form-check d-flex align-items-center pt-0" data-id="${value.id}" data-title="${value.title}">
						<input class="form-check-input" type="checkbox" value="${value.id}" id="checklist${value.id}">
						<label class="form-check-label" for="checklist${value.id}">${value.title}</label>
						<div class="ml-auto">
							<i class="mdi mdi-pencil-outline modal-checklist edit-checklist pr-0" role="button"></i>
							<i class="mdi mdi-trash-can-outline delete-checklist pr-0" role="button"></i>
						</div>
					</div>
				</div>`
                $('#checklist-task').prepend(append)
            })
        }
    })
}

function get_checklist_item() {
    $('#checklist-item-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_checklist_item`,
        type: 'GET',
        success: function(result) {
            console.log(result)
            // $.each(result.data, function(index, value) {
            //     append = ``
            //     $('#checklist-task').prepend(append)
            // })
        }
    })
}

function get_comment() {
    $('#comment-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_comment`,
        type: 'GET',
        success: function(result) {
            console.log(result)
            $.each(result.data, function(index, value) {
                append = `<div class="d-flex align-items-start mb-3" data-id="${value.id}">
					<img src="${localStorage.getItem('photo')}" class="rounded-circle mb-1" width="30" alt="">
					<div class="ml-3">
						<div><b>value.name</b> <small class="text-secondary">value.date</small></div>
						<div>${value.comment}Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Ratione rerum architecto facilis nisi vel perspiciatis maiores tempore dolorem voluptates non at quia natus assumenda, suscipit soluta, culpa quos labore. Ducimus.</div>
					</div>
					<div class="dropdown">
						<i class="mdi mdi-dots-horizontal pr-0" data-toggle="dropdown" role="button"></i>
						<div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="dropdown-member">
							<div class="dropdown-item" data-toggle="modal" data-target="#modal-task" role="button">Edit Task</div>
							<div class="dropdown-item delete delete-task" role="button">Delete Task</div>
						</div>
					</div>
				</div>`
                $('#comment-task').prepend(append)
            })
        }
    })
}

get_task()

let task_id, attachment_id
$(document).on('click', '.task', function() {
    $('#detail-task').hide()
    $('#empty-task').hide()
    $('#loading-task').show()
    $('.task').removeClass('border-dark')
    $(this).addClass('border-dark')
    task_id = $(this).attr('data-id')
    $.ajax({
        url: `${api_url}/task/fetch/${task_id}`,
        type: 'GET',
        data: {
            board_id: board_id
        },
        success: function(result) {
            // console.log(result)
            let value = result.data
            $('#detail-task').attr('data-id', value.id)
            $('#detail-task').attr('data-title', value.title)
            $('#task-title').html(value.title)
            $('#duedate-task').html(value.finish_due_date != null ? date_format(value.finish_due_date) : '-')
            if (value.description != null) {
                $('#description-task').html(value.description)
            } else {
                $('#description-task').hide()
            }
            $.each(value.member, function(index, value) {
                append = `<div class="dropdown">
					<img class="avatar rounded-circle mr-1" width="24" data-toggle="dropdown" role="button" data-display="static" aria-haspopup="true" aria-expanded="false">
					<div class="dropdown-menu py-0" aria-labelledby="dropdown-member">
						<div class="p-3 border-bottom">
							<div class="d-flex">
								<img class="avatar rounded-circle pb-1" width="40">
								<div class="ml-3 text-truncate">
									<h6 class="mb-0 text-truncate">Nur Hilmi</h6>
									<small class="text-secondary">@nurhlmi</small>
								</div>
							</div>
						</div>
						<div class="dropdown-item" role="button">Remove from task</div>
					</div>
				</div>`
                $('#members').prepend(append)
            })
        }
    })
    get_attachment()
    get_checklist()
    get_comment()

    $(document).ajaxStop(function() {
        $('#detail-task').show()
        $('#loading-task').hide()
    })
})

$('#form-task').submit(function(e) {
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
            $('#modal-task').modal('hide')
            get_task()
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





$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('#setting .dropdown-menu .dropdown-item').click(function() {
    $('#setting i').dropdown('toggle')
})

$('#attachment').click(function() {
    $('#file').click()
})
$(document).on('change', 'input[type="file"]', function(e) {
    let value = $(this).get(0).files[0]
    let formData = new FormData()
    formData.append('attachment', value)
    // formData.append('title', $('#title').val())
    $.ajax({
        url: `${api_url}/task/${task_id}/attachment`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            $('#file').val('')
            customAlert('success', 'Attachment uploaded')
            get_attachment()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.log(err)
        }
    })
})


// Checklist
$(document).on('click', '.modal-checklist', function() {
    $('#modal-checklist').modal('show')
    $('#checklist-title').val('')
})
$(document).on('click', '.create-checklist', function() {
    $('#modal-checklist-title').html('Add Checklist')
    $('#checklist-form').attr('data-type', 'create')
    $('#checklist-submit').html('Create')
})
$(document).on('click', '.edit-checklist', function() {
    let id = $(this).parents('.form-check').attr('data-id')
    let title = $(this).parents('.form-check').attr('data-title')
    $('#checklist-title').val(title)
    $('#modal-checklist-title').html('Edit Checklist')
    $('#checklist-form').attr('data-id', id)
    $('#checklist-form').attr('data-type', 'edit')
    $('#checklist-submit').html('Save Changes')
})
$('#checklist-form').submit(function(e) {
    e.preventDefault()
    let type = $(this).attr('data-type')
    if (type == 'create') {
        $('#checklist-submit').attr('disabled', true)
        $('.is-invalid').removeClass('is-invalid')
        let formData = new FormData()
        formData.append('title', $('#checklist-title').val())
        $.ajax({
            url: `${api_url}/task/${board_id}/create_checklist`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal-checklist').modal('hide')
                customAlert('success', `Checklist added`)
                get_checklist()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.title) {
                    $('#title').addClass('is-invalid')
                    $('#title').siblings('.invalid-feedback').html(err.title)
                }
            },
            complete: function() {
                $('#checklist-submit').attr('disabled', false)
            }
        })
    } else {
        $('#checklist-submit').attr('disabled', true)
        $('.is-invalid').removeClass('is-invalid')
        let id = $(this).attr('data-id')
        // console.log(id)
        $.ajax({
            url: `${api_url}/task/${id}/update_checklist`,
            type: 'PATCH',
            data: {
                title: $('#checklist-title').val()
            },
            success: function(result) {
                $('#modal-checklist').modal('hide')
                customAlert('success', `Checklist updated`)
                get_checklist()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.title) {
                    $('#title').addClass('is-invalid')
                    $('#title').siblings('.invalid-feedback').html(err.title)
                }
            },
            complete: function() {
                $('#checklist-submit').attr('disabled', false)
            }
        })
    }
})

// Comment
$('#form-comment').submit(function(e) {
    e.preventDefault()
    $('#submit-comment').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')
    let formData = new FormData()
    formData.append('comment', $('#comment').val())
    $.ajax({
        url: `${api_url}/task/${board_id}/create_comment`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            customAlert('success', `Comment submited`)
            get_comment()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            console.log(err)
            if (err.comment) {
                $('#comment').addClass('is-invalid')
                $('#comment').siblings('.invalid-feedback').html(err.comment)
            }
        },
        complete: function() {
            $('#submit-comment').attr('disabled', false)
        }
    })
})

// Delete
$(document).on('click', '.delete', function() {
    let id = $(this).parents('.card').attr('data-id')
    $('#modal-delete').modal('show')
    $('#delete').attr('data-id', id)
})
$(document).on('click', '.delete-task', function() {
    let title = $(this).parents('.card').attr('data-title')
    $('#delete-title').html('Delete Task')
    $('#delete').attr('data-type', 'task')
    $('#delete-body').html(title)
})
$(document).on('click', '.delete-attachment', function() {
    let title = $(this).parents('.card').attr('data-title')
    $('#delete-title').html('Delete Attachment')
    $('#delete').attr('data-type', 'attachment')
    $('#delete-body').html(title)
})
$(document).on('click', '.delete-checklist', function() {
    let id = $(this).parents('.form-check').attr('data-id')
    let title = $(this).parents('.form-check').attr('data-title')
    $('#modal-delete').modal('show')
    $('#delete-title').html('Delete Checklist')
    $('#delete').attr('data-type', 'checklist')
    $('#delete').attr('data-id', id)
    $('#delete-body').html(title)
})
$(document).on('click', '#delete', function() {
    let id = $(this).attr('data-id')
    let type = $(this).attr('data-type')
    // console.log(id)
    if (type == 'task') {
        $.ajax({
            url: `${api_url}/task/${task_id}/archive`,
            type: 'DELETE',
            success: function(result) {
                customAlert('success', `Task deleted`)
                $('#modal-delete').modal('hide')
                $('#detail-task').hide()
                $('#empty-task').show()
                get_task()
            }
        })
    } else if (type == 'member') {
        $.ajax({
            url: `${api_url}/task/${task_id}/${id}/delete_task_member`,
            type: 'DELETE',
            success: function(result) {
                customAlert('success', `Member deleted`)
                $('#modal-delete').modal('hide')
            }
        })
    } else if (type == 'attachment') {
        $.ajax({
            url: `${api_url}/task/${id}/delete_attachment`,
            type: 'DELETE',
            success: function(result) {
                $('#modal-delete').modal('hide')
                customAlert('success', `Attachment deleted`)
                get_attachment()
            }
        })
    } else if (type == 'checklist') {
        $.ajax({
            url: `${api_url}/task/${id}/delete_checklist`,
            type: 'DELETE',
            success: function(result) {
                $('#modal-delete').modal('hide')
                customAlert('success', `Checklist deleted`)
                get_checklist()
            }
        })
    } else if (type == 'checklist_item') {
        $.ajax({
            url: `${api_url}/task/${id}/delete_checklist_item`,
            type: 'DELETE',
            success: function(result) {
                customAlert('success', `Checklist item deleted`)
                $('#modal-delete').modal('hide')
            }
        })
    } else if (type == 'comment') {
        $.ajax({
            url: `${api_url}/task/${id}/delete_attachment`,
            type: 'DELETE',
            success: function(result) {
                customAlert('success', `Comment deleted`)
                $('#modal-delete').modal('hide')
            }
        })
    }
})