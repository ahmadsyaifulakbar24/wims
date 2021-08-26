let pic_id = null

// Board
$.ajax({
    url: `${api_url}/board/fetch/${board_id}`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        let value = result.data
        $('title').prepend(value.title)
        $('#board').html(value.title)
        pic_id = value.division.pic.id
        if (role == 100 || value.division.pic.id == user_id) {
			$('#card').removeClass('none')
			$('.button-add').removeClass('none')
			$('#detail-task .dropdown').removeClass('none')
			$('#member').siblings('.dropdown').removeClass('none')
		}
    }
})


// Task
get_task()
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
function get_task_id(task_id) {
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
            if (value.finish_due_date != null) {
                if (value.start_due_date != null) {
                    $('#duedate-task').html(`${date_format(value.start_due_date)} - ${date_format(value.finish_due_date)}`)
                } else {
                    $('#duedate-task').html(date_format(value.finish_due_date))
                }
            } else {
                $('#duedate-task').html('-')
            }
            if (value.description != null) {
                $('#description-task').html(value.description)
            } else {
                $('#description-task').hide()
            }
            $('#detail-task').show()
            $('#loading-task').hide()
        }
    })
}
let task_id, attachment_id
$(document).on('click', '.task', function() {
    $('#detail-task').hide()
    $('#empty-task').hide()
    $('#loading-task').show()
    $('.task').removeClass('border-dark')
    $(this).addClass('border-dark')
    task_id = $(this).attr('data-id')
    get_task_id(task_id)
    get_task_member()
    get_attachment()
    get_checklist()
    get_comment()
})
$('#form-task').submit(function(e) {
    e.preventDefault()
    let type = $(this).attr('data-type')
    if (type == 'create') {
        $('#task-submit').attr('disabled', true)
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
                customAlert('success', 'Task created')
                get_task()
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
                $('#task-submit').attr('disabled', false)
            }
        })
    } else {
        $('#task-submit').attr('disabled', true)
        $('.is-invalid').removeClass('is-invalid')
        $.ajax({
            url: `${api_url}/task/${board_id}/update`,
            type: 'PATCH',
            data: {
                title: $('#title').val(),
                description: $('#description').val(),
                start_due_date: $('#start_due_date').val(),
                finish_due_date: $('#finish_due_date').val()
            },
            success: function(result) {
                // console.log(result)
                let value = result.data
                $('#modal-task').modal('hide')
                $('#detail-task').attr('data-title', value.title)
                $('#task-title').html(value.title)
                $('#duedate-task').html(value.finish_due_date != null ? date_format(value.finish_due_date) : '-')
                if (value.finish_due_date != null) {
                    if (value.start_due_date != null) {
                        $('#duedate-task').html(`${date_format(value.start_due_date)} - ${date_format(value.finish_due_date)}`)
                    } else {
                        $('#duedate-task').html(date_format(value.finish_due_date))
                    }
                }
                customAlert('success', 'Task updated')
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
                $('#task-submit').attr('disabled', false)
            }
        })
    }
})
$(document).on('click', '.create-task', function() {
    $('#modal-task').modal('show')
    $('#title-task').html('Create Task')
    $('#task-submit').html('Create')
    $('#task-submit').attr('disabled', false)
    $('#form-task').attr('data-type', 'create')
})
$(document).on('click', '.edit-task', function() {
    $('#modal-task').modal('show')
    $('#title-task').html('Edit Task')
    $('#task-submit').html('Save Changes')
    $('#task-submit').attr('disabled', true)
    $('#form-task').attr('data-type', 'edit')
    $.ajax({
        url: `${api_url}/task/fetch/${task_id}`,
        type: 'GET',
        data: {
            board_id: board_id
        },
        success: function(result) {
            // console.log(result)
            let value = result.data
            $('#title').val(value.title)
            $('#start_due_date').val(value.start_due_date)
            $('#finish_due_date').val(value.finish_due_date)
            $('#description').val(value.description)
            $('#task-submit').attr('disabled', false)
        }
    })
})
$(document).on('click', '.delete-task', function() {
    let title = $(this).parents('.card').attr('data-title')
    $('#delete-title').html('Archive Task')
    $('#delete').attr('data-type', 'task')
    $('#delete').html('Archive')
    $('#delete-body').html(title)
})
$('#modal-task').on('hidden.bs.modal', function() {
    $('#title').val('')
    $('#start_due_date').val('')
    $('#finish_due_date').val('')
    $('#description').val('')
    $('.is-invalid').removeClass('.is-invalid')
})


// Member
$.ajax({
    url: `${api_url}/board/${board_id}/get_member`,
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            if (value.user_id != user_id) {
                append = `<div class="dropdown-item create-member" data-id="${value.user_id}" data-name="${value.name}" role="button">
					<img src="${value.profile_photo_url}" class="rounded-circle mr-2" width="24">
					<span class="pl-0">${value.name}</span>
				</div>`
                $('#list-members').append(append)
            }
        })
    }
})
function get_task_member() {
    $('#members').empty()
    $('#loading-member').show()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_task_member`,
        type: 'GET',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
            	remove = ''
            	if (role == 100 || pic_id == user_id) {
	            	remove = `<div class="dropdown-item remove-member" data-id="${value.user_id}" data-name="${value.name}" role="button">Remove from board</div>`
		        }
                append = `<div class="dropdown">
					<img src="${value.profile_photo_url}" class="rounded-circle mr-1" width="24" data-toggle="dropdown" role="button">
					<div class="dropdown-menu py-0">
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
$(document).on('click', '.create-member', function() {
    let name = $(this).attr('data-name')
    let formData = new FormData()
    formData.append('user_id', $(this).attr('data-id'))
    $.ajax({
        url: `${api_url}/task/${task_id}/create_task_member`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            // console.log(result)
            customAlert('success', `${name} added to task`)
            get_task_member()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            let msg = xhr.responseJSON.data
            // console.log(msg)
            if (msg == "member already exists") {
                customAlert('warning', `${name} has been added in this task`)
            }
        }
    })
})
$(document).on('click', '.remove-member', function() {
    let member_id = $(this).attr('data-id')
    let member_name = $(this).attr('data-name')
    $.ajax({
        url: `${api_url}/task/${task_id}/${member_id}/delete_task_member`,
        type: 'DELETE',
        success: function(result) {
            customAlert('success', `${member_name} removed from task`)
            get_task_member()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.log(err)
        }
    })
})


// Attachment
function get_attachment() {
    $('#attachment-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_attachment`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
                append = `<div class="card mb-2" data-id="${value.id}" data-title="${value.name}">
					<div class="d-flex align-items-center">
						<a href="${value.file_url}" class="d-flex align-items-center text-truncate my-3 ml-3" style="width: 90%" target="_blank">
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
$(document).on('change', 'input[type="file"]', function(e) {
    let value = $(this).get(0).files[0]
    if (value['size'] < 8388608) {
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
                customAlert('success', 'Attachment uploaded')
                get_attachment()
            },
            error: function(xhr) {
                // let err = xhr.responseJSON.errors
                // console.log(xhr)
            }
        })
    } else {
        customAlert('warning', 'Maximal size 8 MB')
    }
    $('#file').val('')
})
$(document).on('click', '.delete-attachment', function() {
    let title = $(this).parents('.card').attr('data-title')
    $('#delete-title').html('Delete Attachment')
    $('#delete').attr('data-type', 'attachment')
    $('#delete-body').html(title)
})


// Checklist
function get_checklist() {
    $('#checklist-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_checklist`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
            	option = ''
            	additem = ''
            	if (role == 100 || pic_id == user_id) {
	            	option = `<div class="dropdown ml-auto">
						<i class="mdi mdi-24px mdi-dots-horizontal px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
						<div class="dropdown-menu dropdown-menu-right py-0">
							<div class="dropdown-item modal-checklist edit-checklist" role="button">Edit</div>
							<div class="dropdown-item delete delete-checklist" role="button">Delete</div>
						</div>
					</div>`
					additem = `<div class="card p-1 mx-3 modal-checklist-item create-checklist-item" role="button">
						<div class="d-flex align-items-center justify-content-center">
							<i class="mdi mdi-18px mdi-plus"></i>
							<span>Add item</span>
						</div>
					</div>`
				}
                append = `<div class="card card-checklist mb-2" data-id="${value.id}" data-title="${value.title}">
					<div class="d-flex align-items-center mt-2">
						<div class="d-flex align-items-center text-truncate ml-3" style="width: 90%">
							<div class="text-truncate mb-0"><b>${value.title}</b></div>
						</div>
						${option}
					</div>
					<div class="progress mx-3 my-2">
						<div class="progress-bar bg-dark" id="progress${value.id}" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
					</div>
					${additem}
					<div class="mx-3 mb-2" id="checklist-item-list${value.id}"></div>
				</div>`
                $('#checklist-task').prepend(append)

                $.each(value.checklist_item, function(index, val) {
                    // console.log(val)
                    let duedate = ''
                    if (val.finish_due_date != null) {
                        if (val.start_due_date != null) {
                            duedate = `${date_format(val.start_due_date)} - ${date_format(val.finish_due_date)}`
                        } else {
                            duedate = date_format(val.finish_due_date)
                        }
                    }
                    let item = ''
                    if (val.done == 1) {
                        item = `<del>${val.item}</del>`
                    } else {
                        item = val.item
                    }
                    option = ''
                    if (role == 100 || pic_id == user_id) {
	                    option = `<div class="dropdown ml-auto">
							<i class="mdi mdi-24px mdi-dots-horizontal pr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
							<div class="dropdown-menu dropdown-menu-right py-0">
								<div class="dropdown-item modal-checklist-item edit-checklist-item" role="button">Edit</div>
								<div class="dropdown-item delete-checklist-item" role="button">Delete</div>
							</div>
						</div>`
					}
                    append = `<div class="form-check card-checklist-item pt-0" data-id="${val.id}" data-title="${val.item}" data-start="${val.start_due_date}" data-finish="${val.finish_due_date}" data-done="${val.done}">
                    	<div class="d-flex align-items-start">
                    		<div class="pt-2">
								<input class="form-check-input" type="checkbox" value="${val.id}" ${val.done == 1 ? 'checked' : ''}>
								<label class="form-check-label mr-3">${item}</label>
							</div>
							${option}
						</div>
						<div class="small text-secondary">${duedate}</div>
					</div>`
                    $(`#checklist-item-list${value.id}`).prepend(append)
                })
            })
            get_progress()
        }
    })
}
function get_progress() {
    $.ajax({
        url: `${api_url}/task/${task_id}/get_checklist`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
                length = value.checklist_item.length
                if (length > 0) {
                    done = 0
                    $.each(value.checklist_item, function(index, val) {
                        val.done == 1 ? done++ : ''
                    })
                    let percentage = `${Math.floor(done / (length * 1 / 100))}%`
                    $(`#progress${value.id}`).css('width', `${percentage}`)
                    $(`#progress${value.id}`).html(`${percentage}`)
                } else {
                    $(`#progress${value.id}`).css('width', `0%`)
                    $(`#progress${value.id}`).html(`0%`)
                }
            })
        }
    })
}
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
    let id = $(this).parents('.card').attr('data-id')
    let title = $(this).parents('.card').attr('data-title')
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
            url: `${api_url}/task/${task_id}/create_checklist`,
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
$(document).on('click', '.delete-checklist', function() {
    let title = $(this).parents('.card').attr('data-title')
    $('#delete-title').html('Delete Checklist')
    $('#delete').attr('data-type', 'checklist')
    $('#delete-body').html(title)
})


// Checklist Item
$(document).on('click', '.modal-checklist-item', function() {
    $('#modal-checklist-item').modal('show')
    $('#checklist-item-title').val('')
})
$(document).on('click', '.create-checklist-item', function() {
    $('#modal-checklist-item-title').html('Add Item')
    $('#checklist-item-submit').html('Create')
    let id = $(this).parents('.card').attr('data-id')
    $('#checklist-item-form').attr('data-id', id)
    $('#checklist-item-form').attr('data-type', 'create')
})
$(document).on('click', '.edit-checklist-item', function() {
    let id = $(this).parents('.form-check').attr('data-id')
    let title = $(this).parents('.form-check').attr('data-title')
    let start = $(this).parents('.form-check').attr('data-start')
    let finish = $(this).parents('.form-check').attr('data-finish')
    let done = $(this).parents('.form-check').attr('data-done')
    $('#checklist-item-title').val(title)
    $('#checklist-item-start_due_date').val(start)
    $('#checklist-item-finish_due_date').val(finish)
    $('#modal-checklist-item-title').html('Edit Item')
    $('#checklist-item-form').attr('data-id', id)
    $('#checklist-item-form').attr('data-done', done)
    $('#checklist-item-form').attr('data-type', 'edit')
    $('#checklist-item-submit').html('Save Changes')
})
$('#checklist-item-form').submit(function(e) {
    e.preventDefault()
    let id = $(this).attr('data-id')
    let type = $(this).attr('data-type')
    if (type == 'create') {
        $('#checklist-item-submit').attr('disabled', true)
        $('.is-invalid').removeClass('is-invalid')
        let formData = new FormData()
        formData.append('item', $('#checklist-item-title').val())
        formData.append('start_due_date', $('#checklist-item-start_due_date').val())
        formData.append('finish_due_date', $('#checklist-item-finish_due_date').val())
        // formData.append('assign_id', $('#checklist-item-assign_id').val())
        $.ajax({
            url: `${api_url}/task/${id}/create_checklist_item`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal-checklist-item').modal('hide')
                customAlert('success', `Item added`)
                get_checklist()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.item) {
                    $('#checklist-item-title').addClass('is-invalid')
                    $('#checklist-item-title').siblings('.invalid-feedback').html(err.item)
                }
            },
            complete: function() {
                $('#checklist-item-submit').attr('disabled', false)
            }
        })
    } else {
        $('#checklist-item-submit').attr('disabled', true)
        $('.is-invalid').removeClass('is-invalid')
        let id = $(this).attr('data-id')
        // console.log(id)
        $.ajax({
            url: `${api_url}/task/${id}/update_checklist_item`,
            type: 'PATCH',
            data: {
                item: $('#checklist-item-title').val(),
                start_due_date: $('#checklist-item-start_due_date').val(),
                finish_due_date: $('#checklist-item-finish_due_date').val(),
                done: $('#checklist-item-form').attr('data-done')
            },
            success: function(result) {
                $('#modal-checklist-item').modal('hide')
                customAlert('success', `Item updated`)
                get_checklist()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.title) {
                    $('#checklist-item-title').addClass('is-invalid')
                    $('#checklist-item-title').siblings('.invalid-feedback').html(err.title)
                }
            },
            complete: function() {
                $('#checklist-item-submit').attr('disabled', false)
            }
        })
    }
})
$(document).on('change', 'input[type=checkbox]', function() {
    let div = $(this)
    let id = $(this).val()
    let title = $(this).parents('.form-check').attr('data-title')
    let done = $(this).parents('.form-check').attr('data-done')
    done == 0 ? done = 1 : done = 0
    $.ajax({
        url: `${api_url}/task/${id}/update_checklist_item`,
        type: 'PATCH',
        data: {
            item: title,
            done: done
        },
        success: function(result) {
            if (done == 1) {
                customAlert('success', `Item checked`)
                div.siblings('label').html(`<del>${div.siblings('label').html()}</del>`)
            } else {
                customAlert('success', `Item unchecked`)
                div.siblings('label').html(div.siblings('label').children().html())
            }
            div.parents('.form-check').attr('data-done', done)
            get_progress()
        }
    })
})
$(document).on('click', '.delete-checklist-item', function() {
    let div = $(this)
    let id = $(this).parents('.form-check').attr('data-id')
    $.ajax({
        url: `${api_url}/task/${id}/delete_checklist_item`,
        type: 'DELETE',
        success: function(result) {
            customAlert('success', `Item deleted`)
            div.parents('.card-checklist-item').remove()
            get_progress()
        }
    })
})
$('#modal-checklist-item').on('hidden.bs.modal', function() {
    $('#checklist-item-title').val('')
    $('#checklist-item-start_due_date').val('')
    $('#checklist-item-finish_due_date').val('')
    $('.is-invalid').removeClass('.is-invalid')
})


// Comment
function get_comment() {
    $('#comment-task').empty()
    $.ajax({
        url: `${api_url}/task/${task_id}/get_comment`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
            	option = `<div class="dropdown ml-auto">
					<i class="mdi mdi-24px mdi-dots-horizontal pr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
					<div class="dropdown-menu dropdown-menu-right py-0">
						<div class="dropdown-item edit-comment" role="button">Edit</div>
						<div class="dropdown-item delete-comment" role="button">Delete</div>
					</div>
				</div>`
                append = `<div class="d-flex align-items-start mb-3" data-id="${value.id}" data-title="${value.comment}">
					<img src="${value.user.profile_photo_url}" class="rounded-circle mb-1" width="30" alt="">
					<div class="ml-3">
						<div><b>${value.user.name}</b> <small class="text-secondary">${date_format(value.created_at.substr(0, 10))}</small></div>
						<div>${value.comment}</div>
					</div>
					${value.user.id == user_id ? option : ''}
				</div>`
                $('#comment-task').prepend(append)
            })
        }
    })
}
$('#form-comment').submit(function(e) {
    e.preventDefault()
    $('#submit-comment').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')
    let formData = new FormData()
    formData.append('comment', $('#comment').val())
    $.ajax({
        url: `${api_url}/task/${task_id}/create_comment`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            $('#comment').val('')
            customAlert('success', `Comment submited`)
            get_comment()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.log(err)
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
$(document).on('click', '.edit-comment', function() {
    $('#modal-comment').modal('show')
    $('#comment-title').val('')
    let id = $(this).parents('.d-flex').attr('data-id')
    let title = $(this).parents('.d-flex').attr('data-title')
    $('#comment-title').val(title)
    $('#modal-comment-title').html('Edit comment')
    $('#comment-form').attr('data-id', id)
    $('#comment-submit').html('Save Changes')
})
$('#comment-form').submit(function(e) {
    e.preventDefault()
    $('#comment-submit').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')
    let id = $(this).attr('data-id')
    // console.log(id)
    $.ajax({
        url: `${api_url}/task/${id}/update_comment`,
        type: 'PATCH',
        data: {
            comment: $('#comment-title').val()
        },
        success: function(result) {
            $('#modal-comment').modal('hide')
            customAlert('success', `Comment updated`)
            get_comment()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.title) {
                $('#comment-title').addClass('is-invalid')
                $('#comment-title').siblings('.invalid-feedback').html(err.title)
            }
        },
        complete: function() {
            $('#comment-submit').attr('disabled', false)
        }
    })
})
$(document).on('click', '.delete-comment', function() {
    let div = $(this)
    let id = $(this).parents('.d-flex').attr('data-id')
    $.ajax({
        url: `${api_url}/task/${id}/delete_comment`,
        type: 'DELETE',
        success: function(result) {
            customAlert('success', `Comment deleted`)
            div.parents('.d-flex').remove()
        }
    })
})


// Delete
$(document).on('click', '.delete', function() {
    let id = $(this).parents('.card').attr('data-id')
    $('#modal-delete').modal('show')
    $('#delete').html('Delete')
    $('#delete').attr('data-id', id)
})
$(document).on('click', '#delete', function() {
    let id = $(this).attr('data-id')
    let type = $(this).attr('data-type')
    if (type == 'task') {
        $.ajax({
            url: `${api_url}/task/${task_id}/archive`,
            type: 'DELETE',
            success: function(result) {
                $('#detail-task').hide()
                $('#empty-task').show()
                $('#loading-task').hide()
                $('#modal-delete').modal('hide')
                customAlert('success', `Task archived`)
                get_task()
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
    }
})

$(document).on('click', '.dropdown .dropdown-menu .dropdown-item', function() {
    $(this).parents('.dropdown-menu').siblings('i').dropdown('toggle')
})

// $('.modal').on('shown.bs.modal', function() {
//     $('input:first').focus()
// })
