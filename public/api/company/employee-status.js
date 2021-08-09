get_data()

function get_data() {
    $('#table').empty()
    $.ajax({
        url: `${api_url}/employee_status`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            if (result.data != '') {
                $.each(result.data, function(index, value) {
                    append = `<tr data-id="${value.id}" data-title="${value.param}">
						<td class="text-center">${index + 1}.</td>
						<td class="text-truncate">${value.param}</td>
						<td class="text-truncate">${value.option != null ? (value.option == 1 ? 'Yes' : 'No') : 'No'}</td>
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
    $('#end_date').parents('.form-check').show()
    $('#modal h5').html('Add Employee Status')
    $('form').attr('data-type', 'create')
    $('#submit').html('Create')
    $('#modal').modal('show')
})

$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('#employee_status_name').val('')
    $('#end_date').prop('checked', false)
})

$(document).on('click', '.edit', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    let option = $(this).parents('tr').attr('data-option')
    $('#employee_status_name').val(title)
    $('#end_date').parents('.form-check').hide()
    $('#modal h5').html('Edit Employee Status')
    $('form').attr('data-id', id)
    $('form').attr('data-type', 'edit')
    $('#submit').html('Save Changes')
    $('#modal').modal('show')
})
$('form').submit(function(e) {
    e.preventDefault()
    let id = $(this).attr('data-id')
    let type = $(this).attr('data-type')
    $('#submit').attr('disabled', true)
    if (type == 'create') {
        let formData = new FormData()
        formData.append('employee_status_name', $('#employee_status_name').val())
        formData.append('end_date', $('#end_date').prop('checked') == true ? 1 : 0)
        $.ajax({
            url: `${api_url}/employee_status/create`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Employee status added')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.employee_status_name) {
                    $('#employee_status_name').addClass('is-invalid')
                    $('#employee_status_name').siblings('.invalid-feedback').html(err.employee_status_name)
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    } else {
        $.ajax({
            url: `${api_url}/employee_status/${id}/update`,
            type: 'PATCH',
            data: {
                employee_status_name: $('#employee_status_name').val()
            },
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Employee status updated')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.employee_status_name) {
                    $('#employee_status_name').addClass('is-invalid')
                    $('#employee_status_name').siblings('.invalid-feedback').html(err.employee_status_name)
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
        url: `${api_url}/employee_status/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            // $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
            customAlert('success', 'Employee status deleted')
            get_data()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.data.message
            // console.log(err)
            if (err == "The employee status already used by employee") {
	            $('#modal-delete').modal('hide')
	            $('#delete').attr('disabled', false)
	            customAlert('warning', err)
            }
        }
    })
})
