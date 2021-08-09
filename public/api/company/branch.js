get_data()

function get_data() {
	$('#table').empty()
	$.ajax({
	    url: `${api_url}/company/fetch`,
	    type: 'GET',
	    data: {
	        type: 'branch'
	    },
	    success: function(result) {
	        // console.log(result)
	        if (result.data != '') {
	            $.each(result.data, function(index, value) {
	                append = `<tr data-id="${value.id}" data-title="${value.name}">
						<td class="text-center">${index + 1}.</td>
						<td class="text-truncate">
							<a href="${root}/company/branch/${value.id}" class="d-flex align-items-center text-dark">
								<img src="${value.logo_url}" class="border rounded-circle mr-3" width="30">
								<span>${value.name}</span>
							</a>
						</td>
						<td class="text-truncate">${value.phone_number}</td>
						<td class="text-truncate">${value.email}</td>
						<td class="text-truncate">${value.address}</td>
						<td class="text-right">
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
        url: `${api_url}/company/${id}/delete`,
        type: 'DELETE',
        success: function(result) {
            $('#modal-delete').modal('hide')
		    $('#delete').attr('disabled', false)
            customAlert('success', 'Branch deleted')
            get_data()
        }
    })
})
