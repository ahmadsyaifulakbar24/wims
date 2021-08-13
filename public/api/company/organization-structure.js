let chart = []

get_data()

function get_data() {
    $('#table').empty()
    $('#parent').empty()
    $('#parent_id').empty()
    $.ajax({
        url: `${api_url}/organization`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
            if (result.data != '') {
                chart = []
                $.each(result.data, function(index, value) {
                    chart.push(value)
                    append = `<tr data-id="${value.id}" data-title="${value.param}" data-parent="${value.parent != null ? value.parent.id : ''}">
						<td class="text-center">${index + 1}.</td>
						<td class="text-truncate">${value.param}</td>
						<td class="text-truncate">${value.parent != null ? value.parent.param : ''}</td>
						<td class="d-flex align-items-center">
							<i class="mdi mdi-24px mdi-pencil-outline pr-0 mr-2 edit" role="button"></i>
							<i class="mdi mdi-24px mdi-trash-can-outline pr-0 delete" role="button"></i>
						</td>
					</tr>`
                    $('#table').append(append)

                    chartAppend = `<li>
                       	<span class="tf-nc">${value.param}</span>
                        <ul id="parent${value.id}"></ul>
                    </li>`
                    $(`#parent`).prepend(chartAppend)
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
        },
        complete: function() {
            // Move organization position
            $.each(chart, function(index, value) {
                if (value.parent != null) {
                    append = $(`#parent${value.id}`).parent('li')
                    $(`#parent${value.parent.id}`).prepend(append)
                }
            })
            // Remove vertical line
            $.each($('ul'), function(index, value) {
                if ($(this).is(':empty')) {
                    $(this).remove()
                }
            })
        }
    })
}

$('#sitemap').click(function() {
    $('#modal-sitemap').modal('show')
})

$('#add').click(function() {
    $('#modal h5').html('Add Organization')
    $('form').attr('data-type', 'create')
    $('#submit').html('Create')
    $('#modal').modal('show')
})

$('.modal').on('shown.bs.modal', function() {
    $('input:first').focus()
})

$('.modal').on('hidden.bs.modal', function() {
    $('#organization_name').val('')
    $('#parent_id').val('')
    $('select option').show()
})

$(document).on('click', '.edit', function() {
    let id = $(this).parents('tr').attr('data-id')
    let title = $(this).parents('tr').attr('data-title')
    let parent = $(this).parents('tr').attr('data-parent')
    $(`select option[value=${id}]`).hide()
    $('#organization_name').val(title)
    $('#parent_id').val(parent)
    $('#modal h5').html('Edit Organization')
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
        formData.append('organization_name', $('#organization_name').val())
        $('#parent_id').val() != null ? formData.append('parent_id', $('#parent_id').val()) : ''
        $.ajax({
            url: `${api_url}/organization/create`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Organization added')
                get_data()
            },
            error: function(xhr) {
                // console.log(xhr)
                let err = xhr.responseJSON.errors
                if (err != undefined) {
                    if (err.organization_name) {
                        $('#organization_name').addClass('is-invalid')
                        $('#organization_name').siblings('.invalid-feedback').html(err.organization_name)
                    }
                } else {
                    $('#organization_name').addClass('is-invalid')
                    $('#organization_name').siblings('.invalid-feedback').html(`The ${xhr.responseJSON.data.message}.`)
                }
            },
            complete: function() {
                $('#submit').attr('disabled', false)
            }
        })
    } else {
        $.ajax({
            url: `${api_url}/organization/${id}/update`,
            type: 'PATCH',
            data: {
                organization_name: $('#organization_name').val(),
                parent_id: $('#parent_id').val()
            },
            success: function(result) {
                $('#modal').modal('hide')
                customAlert('success', 'Organization updated')
                get_data()
            },
            error: function(xhr) {
                // console.log(xhr)
                let err = xhr.responseJSON.errors
                if (err != undefined) {
                    if (err.organization_name) {
                        $('#organization_name').addClass('is-invalid')
                        $('#organization_name').siblings('.invalid-feedback').html(err.organization_name)
                    }
                } else {
                    $('#organization_name').addClass('is-invalid')
                    $('#organization_name').siblings('.invalid-feedback').html(`The ${xhr.responseJSON.data.message}.`)
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
        url: `${api_url}/organization/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
            customAlert('success', 'Organization deleted')
            get_data()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.data.message
            // console.log(err)
            if (err == "The organization already used by employee") {
                $('#modal-delete').modal('hide')
                $('#delete').attr('disabled', false)
                customAlert('warning', err)
            }
        }
    })
})
