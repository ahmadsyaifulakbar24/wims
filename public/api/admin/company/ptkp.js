get_data()

function get_data() {
	$('#table').empty()
	$.ajax({
	    url: `${api_url}/ptkp`,
	    type: 'GET',
	    success: function(result) {
	        // console.log(result)
	        if (result.data != '') {
	            $.each(result.data, function(index, value) {
	            	if (role == 1) {
		            	option = `<i class="mdi mdi-24px mdi-pencil-outline pr-0 mr-2 edit" role="button"></i>
						<i class="mdi mdi-24px mdi-trash-can-outline pr-0 delete" role="button"></i>`
					} else {
						option = ''
					}
	                append = `<tr data-id="${value.id}" data-title="${value.ptkp}" data-rate="${fnumber(value.rate)}" data-description="${value.description}">
						<td class="text-center">${index + 1}.</td>
						<td class="text-truncate">${value.ptkp}</td>
						<td class="text-truncate">${fntr(value.rate)}</td>
						<td class="text-truncate">${value.description}</td>
						<td class="d-flex align-items-center">${option}</td>
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
    $('#modal h5').html('Add PTKP')
    $('form').attr('data-type', 'create')
    $('#submit').html('Create')
    $('#modal').modal('show')
})

$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('#ptkp').val('')
    $('#rate').val('')
    $('#description').val('')
})

$(document).on('click', '.edit', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    let rate = $(this).parents('tr').attr('data-rate')
    let description = $(this).parents('tr').attr('data-description')
    $('#ptkp').val(title)
    $('#rate').val(rate)
    $('#description').val(description)
    $('#modal h5').html('Edit PTKP')
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
        formData.append('ptkp', $('#ptkp').val())
        formData.append('rate', frtn($('#rate').val()))
        formData.append('description', $('#description').val())
        $.ajax({
            url: `${api_url}/ptkp/create`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'PTKP added')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.ptkp) {
                    $('#ptkp').addClass('is-invalid')
                    $('#ptkp').siblings('.invalid-feedback').html(err.ptkp)
                }
                if (err.rate) {
                    $('#rate').addClass('is-invalid')
                    $('#rate').siblings('.invalid-feedback').html(err.rate)
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
            url: `${api_url}/ptkp/${id}/update`,
            type: 'PATCH',
            data: {
                ptkp: $('#ptkp').val(),
                rate: frtn($('#rate').val()),
                description: $('#description').val()
            },
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'PTKP updated')
                get_data()
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors
                // console.log(err)
                if (err.ptkp) {
                    $('#ptkp').addClass('is-invalid')
                    $('#ptkp').siblings('.invalid-feedback').html(err.ptkp)
                }
                if (err.rate) {
                    $('#rate').addClass('is-invalid')
                    $('#rate').siblings('.invalid-feedback').html(err.rate)
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
        url: `${api_url}/ptkp/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
		    $('#delete').attr('disabled', false)
            customAlert('success', 'PTKP deleted')
            get_data()
        }
    })
})
