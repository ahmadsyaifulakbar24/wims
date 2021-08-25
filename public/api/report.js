let url_string = window.location.href
let url = new URL(url_string)
let detail = url.searchParams.get('detail')
if (detail != null) {
    $.ajax({
        url: `${api_url}/user_report/fetch/${detail}`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
        	let value = result.data
		    attachment_detail(detail)
		    get_comment(detail)
		    $('#title-detail').html(value.title)
		    $('#form-comment').attr('data-id', detail)
		    $('#modal-detail').modal('show')
        }
    })
}

get_data()

function get_data() {
    $('#table').empty()
    $.ajax({
        url: `${api_url}/user_report/fetch`,
        type: 'GET',
        data: {
            user_id: user_id
        },
        success: function(result) {
            // console.log(result.data)
            if (result.data != '') {
                $.each(result.data, function(index, value) {
                    append = `<tr data-id="${value.id}" data-title="${value.title}">
						<td class="text-center">${index + 1}.</td>
						<td class="text-truncate">
							<div class="text-primary detail" role="button">${value.title}</div>
						</td>
						<td class="d-flex align-items-center">
							<i class="mdi mdi-24px mdi-pencil-outline pr-0 mr-2 edit" role="button"></i>
							<i class="mdi mdi-24px mdi-trash-can-outline pr-0 delete" role="button"></i>
						</td>
					</tr>`
                    $('#table').append(append)
                })
            } else {
                append = `<td class="text-truncate" colspan="10">Data not found.</td>`
                $('#table').append(append)
            }
        }
    })
}

$('#add').click(function() {
    $('#modal h5').html('Add Report')
    $('form').attr('data-type', 'create')
    $('#submit').html('Create')
    $('#modal').modal('show')
})

$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('.is-invalid').removeClass('is-invalid')
    $('.card-attachment').remove()
    $('#title').val('')
    attachments = []
    attachment_staging()
})

let attachments = []
$(document).on('change', 'input[type="file"]', function(e) {
    attachments.push(this.files[0])
    $('input[type="file"]').val('')
    attachment_staging()
})

$(document).on('click', '.delete-staging-attachment', function(e) {
    $(this).parents('.card').remove()
    let id = $(this).parents('.card').attr('data-id')
    if (id > -1) attachments.splice(id, 1)
    $.each($('.card-staging-attachment'), function(index, value) {
        $(this).attr('data-id', index)
    })
})

function attachment_staging(value) {
    $('.card-staging-attachment').remove()
    $.each(attachments, function(index, value) {
        let append = `<div class="card card-staging-attachment mb-2" data-id="${index}" data-title="${value.name}">
			<div class="d-flex align-items-center">
				<div class="d-flex align-items-center text-truncate my-3 ml-3" style="width: 90%" target="_blank">
					<i class="mdi mdi-24px mdi-file-outline text-dark"></i>
					<div class="text-truncate">${value.name}</div>
				</div>
				<i class="mdi mdi-24px mdi-trash-can-outline ml-auto delete-staging-attachment px-3" role="button"></i>
			</div>
		</div>`
        $('#attachments').append(append)
    })
}

$(document).on('click', '.edit', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    attachment_edit(id)
    $('#title').val(title)
    $('#modal h5').html('Edit Report')
    $('#form').attr('data-id', id)
    $('#form').attr('data-type', 'edit')
    $('#submit').html('Save Changes')
    $('#modal').modal('show')
})

function attachment_edit(id) {
    $('#attachments').empty()
    $.ajax({
        url: `${api_url}/user_report/attachment/${id}/fetch`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
            $.each(result.data, function(index, value) {
                append = `<div class="card card-attachment mb-2" data-id="${value.id}" data-title="${value.name}">
					<div class="d-flex align-items-center">
						<a href="${value.file_url}" class="d-flex align-items-center text-truncate my-3 ml-3" style="width: 90%" target="_blank">
							<i class="mdi mdi-24px mdi-file-outline text-dark"></i>
							<div class="text-truncate">${value.name}</div>
						</a>
						<!--<i class="mdi mdi-24px mdi-trash-can-outline ml-auto delete-attachment px-3" role="button"></i>-->
					</div>
				</div>`
                $('#attachments').append(append)
            })
        }
    })
}

$(document).on('click', '.detail', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    attachment_detail(id)
    get_comment(id)
    $('#form-comment').attr('data-id', id)
    $('#title-detail').html(title)
    $('#modal-detail').modal('show')
})

function attachment_detail(id) {
    $('#attachments-detail').empty()
    $.ajax({
        url: `${api_url}/user_report/attachment/${id}/fetch`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
            if (result.data.length > 0) {
                $.each(result.data, function(index, value) {
                    append = `<div class="card card-attachment mb-2" data-id="${value.id}" data-title="${value.name}">
						<div class="d-flex align-items-center">
							<a href="${value.file_url}" class="d-flex align-items-center text-truncate my-3 ml-3" target="_blank">
								<i class="mdi mdi-24px mdi-file-outline text-dark"></i>
								<div class="text-truncate">${value.name}</div>
							</a>
						</div>
					</div>`
                    $('#attachments-detail').append(append)
                })
            } else {
                let append = `<label class="card p-1">
					<div class="d-flex align-items-center justify-content-center py-1 mb-0">
						<span>No attachment</span>
					</div>
				</label>`
                $('#attachments-detail').append(append)
            }
        }
    })
}

$('#form').submit(function(e) {
    e.preventDefault()
    let id = $(this).attr('data-id')
    let type = $(this).attr('data-type')
    $('#submit').attr('disabled', true)
    if (type == 'create') {
        let formData = new FormData()
        formData.append('user_id', user_id)
        formData.append('title', $('#title').val())
        $.ajax({
            url: `${api_url}/user_report/create`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                if (attachments.length > 0) {
                    $.each(attachments, function(index, value) {
                        let formData = new FormData()
                        formData.append('attachment', value)
                        $.ajax({
                            url: `${api_url}/user_report/attachment/${result.data.id}/create`,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                        })
                    })
                }
                $('#modal').modal('hide')
                customAlert('success', 'Report added')
                get_data()
            },
            error: function(xhr) {
                // console.log(xhr)
                let err = xhr.responseJSON.errors
                if (err.title) {
                    $('#title').addClass('is-invalid')
                    $('#title').siblings('.invalid-feedback').html(err.title)
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    } else {
        $.ajax({
            url: `${api_url}/user_report/${id}/update`,
            type: 'PATCH',
            data: {
                title: $('#title').val(),
            },
            success: function(result) {
                if (attachments.length > 0) {
                    $.each(attachments, function(index, value) {
                        let formData = new FormData()
                        formData.append('attachment', value)
                        $.ajax({
                            url: `${api_url}/user_report/attachment/${result.data.id}/create`,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                        })
                    })
                }
                $('#modal').modal('hide')
                customAlert('success', 'Report updated')
                get_data()
            },
            error: function(xhr) {
                // console.log(xhr)
                let err = xhr.responseJSON.errors
                if (err.title) {
                    $('#title').addClass('is-invalid')
                    $('#title').siblings('.invalid-feedback').html(err.title)
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    }
})

$(document).on('click', '.delete', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    $('#delete').attr('data-id', id)
    $('#modal-delete .modal-body b').html(title)
    $('#modal-delete').modal('show')
})

$(document).on('click', '#delete', function() {
    let id = $('#delete').attr('data-id')
    $('#delete').attr('disabled', true)
    $.ajax({
        url: `${api_url}/user_report/${id}/archive`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
            customAlert('success', 'Report deleted')
            get_data()
        }
    })
})

function get_comment(report_id) {
    $('#comment-detail').empty()
    $.ajax({
        url: `${api_url}/user_report/comment/${report_id}/fetch`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            $.each(result.data, function(index, value) {
                append = `<div class="d-flex align-items-start mb-3" data-id="${value.id}" data-title="${value.comment}">
					<img src="${value.user.profile_photo_url}" class="rounded-circle mb-1" width="30" alt="">
					<div class="ml-3">
						<div><b>${value.user.name}</b> <small class="text-secondary">${date_format(value.created_at.substr(0, 10))}</small></div>
						<div>${value.comment}</div>
					</div>
					<!--<div class="dropdown ml-auto">
						<i class="mdi mdi-24px mdi-dots-horizontal pr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
						<div class="dropdown-menu dropdown-menu-right py-0">
							<div class="dropdown-item edit-comment" role="button">Edit</div>
							<div class="dropdown-item delete-comment" role="button">Delete</div>
						</div>
					</div>-->
				</div>`
                $('#comment-detail').prepend(append)
            })
        }
    })
}

$('#form-comment').submit(function(e) {
    e.preventDefault()
    $('#submit-comment').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')
    let report_id = $('#form-comment').attr('data-id')
    let formData = new FormData()
    formData.append('comment', $('#comment').val())
    $.ajax({
        url: `${api_url}/user_report/comment/${report_id}/create`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            $('#comment').val('')
            customAlert('success', `Comment submited`)
            get_comment(report_id)
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
