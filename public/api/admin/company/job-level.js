get_data()

function get_data() {
    $('#table').empty()
    $.ajax({
        url: `${api_url}/job_level`,
        type: 'GET',
        success: function(result) {
            // console.log(result)
            if (result.data != '') {
                $.each(result.data, function(index, value) {
                    append = `<tr data-id="${value.id}" data-title="${value.param}">
						<td class="text-center">${index + 1}.</td>
						<td class="text-truncate">${value.param}</td>
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
    $('#modal h5').html('Add Job Level')
    $('form').attr('data-type', 'create')
    $('#submit').html('Create')
    $('#modal').modal('show')
})

$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('#job_level_name').val('')
})

$(document).on('click', '.edit', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    $('#job_level_name').val(title)
    $('#modal h5').html('Edit Job Level')
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
        formData.append('job_level_name', $('#job_level_name').val())
        $.ajax({
            url: `${api_url}/job_level/create`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Job level added')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.job_level_name) {
                    $('#job_level_name').addClass('is-invalid')
                    $('#job_level_name').siblings('.invalid-feedback').html(err.job_level_name)
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    } else {
        $.ajax({
            url: `${api_url}/job_level/${id}/update`,
            type: 'PATCH',
            data: {
                job_level_name: $('#job_level_name').val()
            },
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Job level updated')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.job_level_name) {
                    $('#job_level_name').addClass('is-invalid')
                    $('#job_level_name').siblings('.invalid-feedback').html(err.job_level_name)
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
        url: `${api_url}/job_level/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
            customAlert('success', 'Job level deleted')
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
