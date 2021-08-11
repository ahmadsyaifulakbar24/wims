get_data()

function get_data() {
	$('#table').empty()
	$.ajax({
	    url: `${api_url}/employee/fetch`,
	    type: 'GET',
	    success: function(result) {
	        // console.log(result)
	        if (result.data != '') {
	            $.each(result.data, function(index, value) {
	                append = `<tr data-id="${value.id}" data-title="${value.name}">
						<!--<td class="text-truncate text-center">${index + 1}.</td>-->
						<td class="text-truncate">
							<a href="${root}/employee/${value.id}" class="d-flex align-items-center">
								<img src="${value.profile_photo_url}" class="avatar rounded-circle mr-3" width="35">
								<div>${value.name}<br><span class="text-secondary">${value.employee_id}</span></div>
							</a>
						</td>
						<td class="text-truncate text-capitalize">${value.company_id.type}</td>
						<td class="text-truncate">${value.organization_id.param}</td>
						<td class="text-truncate">${value.job_position_id.param}</td>
						<td class="text-truncate">${value.job_level_id.param}</td>
						<td class="text-truncate">${value.employee_status_id.param}</td>
						<td class="text-truncate">${date_format(value.join_date)}</td>
						<td class="text-truncate">${value.end_date != null ? date_format(value.end_date) : '-'}</td>
						<td class="text-truncate">
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
        url: `${api_url}/employee/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
            customAlert('success', 'Employee deleted')
            get_data()
        },
        error: function(xhr) {
            let err = xhr.responseJSON.data.message
            // console.log(err)
        }
    })
})

