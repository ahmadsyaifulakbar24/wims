let url_string = window.location.href
let url = new URL(url_string)
let detail = url.searchParams.get('detail')
if (detail != null) get_detail(detail)

let employee_id = null
$.ajax({
    url: `${api_url}/employee/fetch/${user_id}`,
    type: 'GET',
    success: function(result) {
        // console.log(result.data)
        employee_id = result.data.id
        get_data()
    }
})

$(document).ajaxStop(function() {
    $('#loading').remove()
})

$('#add').click(function() {
    $('#modal h5').html('Request Leave')
    $('form').attr('data-type', 'create')
    $('#submit').html('Create')
    $('#modal').modal('show')
})

function get_data() {
    $('#table').empty()
    $.ajax({
        url: `${api_url}/leave/fetch`,
        type: 'GET',
        data: {
            employee_id: employee_id
        },
        success: function(result) {
            // console.log(result.data)
            if (result.data != '') {
                $('#data').show()
                $('#empty').hide()
                $.each(result.data, function(index, value) {
                    append = `<tr class="detail" data-id="${value.id}" role="button">
						<td class="text-truncate">${value.total_leave > 1 ? value.total_leave + ' Days' : value.total_leave + ' Day'}</td>
						<td class="text-truncate">${date_format(value.from_date.substr(0,10))} - ${date_format(value.till_date.substr(0,10))}</td>
						<td class="text-truncate">${status_format(value.status)}</td>
						<td class="text-right"><i class="mdi mdi-18px mdi-chevron-right pr-0"></i></td>
					</tr>`
                    $('#table').append(append)
                })
            } else {
                $('#data').hide()
                $('#empty').show()
            }
        }
    })
}

$(document).on('click', '.detail', function() {
    get_detail($(this).attr('data-id'))
})
function get_detail(id) {
    $.ajax({
        url: `${api_url}/leave/fetch/${id}`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
            let value = result.data
            get_comment(id)
            value.status == 'pending' ? $('#option').show() : $('#option').hide()
            $('#total-detail').html(`${value.total_leave > 1 ? value.total_leave + ' Days' : value.total_leave + ' Day'}`)
            $('#date-detail').html(`${date_format(value.from_date.substr(0,10))} - ${date_format(value.till_date.substr(0,10))}`)
            $('#description-detail').html(value.description)
            $('#status-detail').html(status_format(value.status))
            $('#modal-detail').attr('data-id', id)
            $('#modal-detail').modal('show')
        }
    })
}

$(document).on('click', '.edit', function() {
    $('#modal-detail').modal('hide')
    let id = $(this).parents('#modal-detail').attr('data-id')
    get_edit(id)
    $('#modal h5').html('Edit Leave')
    $('#form').attr('data-id', id)
    $('#form').attr('data-type', 'edit')
    $('#submit').html('Save Changes')
    $('#modal').modal('show')
})
function get_edit(id) {
    $.ajax({
        url: `${api_url}/leave/fetch/${id}`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
            let value = result.data
            $('#from_date').val(value.from_date)
            $('#till_date').val(value.till_date)
            $('#description').val(value.description)
        }
    })
}

$('#form').submit(function(e) {
    e.preventDefault()
    $('#submit').attr('disabled', true)
    let id = $(this).attr('data-id')
    let type = $(this).attr('data-type')
    let from = new Date($('#from_date').val())
    let till = new Date($('#till_date').val())
    let time = till.getTime() - from.getTime()
    let total_leave = (time / (1000 * 3600 * 24)) + 1
    if (type == 'create') {
        let formData = new FormData()
        formData.append('employee_id', employee_id)
        formData.append('total_leave', total_leave)
        formData.append('from_date', $('#from_date').val())
        formData.append('till_date', $('#till_date').val())
        formData.append('description', $('#description').val())
        $.ajax({
            url: `${api_url}/leave/create`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Leave requested')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.from_date) {
                    $('#from_date').addClass('is-invalid')
                    $('#from_date').siblings('.invalid-feedback').html(err.from_date)
                }
                if (err.till_date) {
                    $('#till_date').addClass('is-invalid')
                    $('#till_date').siblings('.invalid-feedback').html(err.till_date)
                }
                if (err.description) {
                    $('#description').addClass('is-invalid')
                    $('#description').siblings('.invalid-feedback').html(err.description)
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    } else {
        $.ajax({
            url: `${api_url}/leave/${id}/update`,
            type: 'PATCH',
            data: {
                total_leave: total_leave,
                from_date: $('#from_date').val(),
                till_date: $('#till_date').val(),
                description: $('#description').val()
            },
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Leave updated')
                get_data()
                get_detail(id)
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.from_date) {
                    $('#from_date').addClass('is-invalid')
                    $('#from_date').siblings('.invalid-feedback').html(err.from_date)
                }
                if (err.till_date) {
                    $('#till_date').addClass('is-invalid')
                    $('#till_date').siblings('.invalid-feedback').html(err.till_date)
                }
                if (err.description) {
                    $('#description').addClass('is-invalid')
                    $('#description').siblings('.invalid-feedback').html(err.description)
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    }
})

$(document).on('click', '.delete', function() {
    let id = $(this).parents('#modal-detail').attr('data-id')
    $('#delete').attr('data-id', id)
    $('#modal-detail').modal('hide')
    $('#modal-delete').modal('show')
})
$(document).on('click', '#delete', function() {
    let id = $('#delete').attr('data-id')
    $('#delete').attr('disabled', true)
    $.ajax({
        url: `${api_url}/leave/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
            customAlert('success', 'Leave deleted')
            get_data()
        }
    })
})

function get_comment(leave_id) {
    $('#comment-detail').empty()
    $.ajax({
        url: `${api_url}/leave/${leave_id}/get_comment`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
            $.each(result.data, function(index, value) {
                append = `<div class="d-flex align-items-start mb-3" data-id="${value.id}" data-title="${value.comment}">
					<img src="${value.user.profile_photo_url}" class="rounded-circle mb-1" width="30" alt="">
					<div class="ml-3">
						<div><b>${value.user.name}</b> <small class="text-secondary">${date_format(value.created_at.substr(0, 10))}</small></div>
						<div>${value.comment}</div>
					</div>
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
    let leave_id = $('#modal-detail').attr('data-id')
    let formData = new FormData()
    formData.append('comment', $('#comment').val())
    $.ajax({
        url: `${api_url}/leave/${leave_id}/create_comment`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            $('#comment').val('')
            customAlert('success', `Comment submited`)
            get_comment(leave_id)
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

$('#from_date').change(function() {
    let val = $(this).val()
    $('#till_date').attr('min', val)
})

$('#modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('#modal').on('hidden.bs.modal', function() {
    $('.is-invalid').removeClass('is-invalid')
    $('input').val('')
    $('textarea').val('')
})
