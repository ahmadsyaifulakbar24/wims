get_data()

function get_data() {
    $('#table').empty()
    $('#parent_id').empty()
    $.ajax({
        url: `${api_url}/job_position`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            if (result.data != '') {
                $.each(result.data, function(index, value) {
                    append = `<tr data-id="${value.id}" data-title="${value.param}" data-parent="${value.parent_id != null ? value.parent_id : ''}">
						<td class="text-center">${index + 1}.</td>
						<td class="text-truncate">${value.param}</td>
						<td class="text-truncate">${value.parent_id != null ? value.parent_id : ''}</td>
						<td class="d-flex align-items-center">
							<i class="mdi mdi-24px mdi-pencil-outline pr-0 mr-2 edit" role="button"></i>
							<i class="mdi mdi-24px mdi-trash-can-outline pr-0 delete" role="button"></i>
						</td>
					</tr>`
                    $('#table').append(append)
                })
                let parent = `<option value="" selected>None</option>`
                $.each(result.data, function(index, value) {
                    parent += `<option value="${value.id}">${value.param}</option>`
                })
                $('#parent_id').append(parent)
            } else {
                append = `<td class="text-truncate" colspan="10">Data not found.</td>`
                $('#table').append(append)
            }
        }
    })
}

$('#add').click(function() {
    $('#modal h5').html('Add Job Position')
    $('form').attr('data-type', 'create')
    $('#submit').html('Create')
    $('#modal').modal('show')
})

$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('#job_position_name').val('')
    $('#parent_id').val('')
    $('select option').show()
})

$(document).on('click', '.edit', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    let parent = $(this).parents('tr').attr('data-parent')
    $(`select option[value=${id}]`).hide()
    $('#job_position_name').val(title)
    $('#parent_id').val(parent)
    $('#modal h5').html('Edit Job Position')
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
        formData.append('job_position_name', $('#job_position_name').val())
        $('#parent_id').val() != null ? formData.append('parent_id', $('#parent_id').val()) : ''
        $.ajax({
            url: `${api_url}/job_position/create`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Job position added')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.job_position_name) {
                    $('#job_position_name').addClass('is-invalid')
                    $('#job_position_name').siblings('.invalid-feedback').html(err.job_position_name)
                }
                if (err.parent_id) {
                    $('#parent_id').addClass('is-invalid')
                    $('#parent_id').siblings('.invalid-feedback').html('The parent field is required.')
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    } else {
        $.ajax({
            url: `${api_url}/job_position/${id}/update`,
            type: 'PATCH',
            data: {
                job_position_name: $('#job_position_name').val(),
                parent_id: $('#parent_id').val()
            },
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Job position updated')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.job_position_name) {
                    $('#job_position_name').addClass('is-invalid')
                    $('#job_position_name').siblings('.invalid-feedback').html(err.job_position_name)
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
        url: `${api_url}/job_position/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
            customAlert('success', 'Job position deleted')
            get_data()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.data.message
            // console.log(err)
            if (err == "The job position already used by employee") {
	            $('#modal-delete').modal('hide')
	            $('#delete').attr('disabled', false)
	            customAlert('warning', err)
            }
        }
    })
})
