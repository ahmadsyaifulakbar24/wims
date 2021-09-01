get_data()
function get_data() {
	$('#table').empty()
	$.ajax({
	    url: `${api_url}/leave/fetch`,
	    type: 'GET',
	    success: function(result) {
	        // console.log(result.data)
	        if (result.data.length != 0) {
	            $.each(result.data, function(index, value) {
	            	option = ''
	            	if (value.status == 'pending') {
	            		option = `<div class="d-flex">
	            			<button class="btn btn-sm btn-dark mr-2 approval" data-status="approve">Approve</button>
	            			<button class="btn btn-sm btn-outline-dark approval" data-status="reject">Reject</button>
	            		</div>`
	            	}
	                append = `<tr data-id="${value.id}">
	                	<td class="text-center">${index + 1}.</td>
			            <td class="text-truncate"><div class="text-primary detail" role="button">${value.employee_name}</div></td>
						<td class="text-truncate">${value.total_leave > 1 ? value.total_leave + ' Days' : value.total_leave + ' Day'}</td>
						<td class="text-truncate">${date_format(value.from_date.substr(0,10))} - ${date_format(value.till_date.substr(0,10))}</td>
						<td class="text-truncate">${value.description}</td>
						<td class="text-truncate">${status_format(value.status)}</td>
						<td class="text-truncate">${option}</td>
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

$(document).on('click', '.detail', function() {
    get_detail($(this).parents('tr').attr('data-id'))
})
function get_detail(id) {
    $.ajax({
        url: `${api_url}/leave/fetch/${id}`,
        type: 'GET',
        success: function(result) {
            // console.log(result.data)
            let value = result.data
            get_comment(id)
            $('#total-detail').html(`${value.total_leave > 1 ? value.total_leave + ' Days' : value.total_leave + ' Day'}`)
            $('#date-detail').html(`${date_format(value.from_date.substr(0,10))} - ${date_format(value.till_date.substr(0,10))}`)
            $('#description-detail').html(value.description)
            $('#status-detail').html(status_format(value.status))
            $('#modal-detail').attr('data-id', id)
            $('#modal-detail').modal('show')
        }
    })
}

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

$(document).on('click', '.approval', function() {
	let id = $(this).parents('tr').attr('data-id')
	let status = $(this).attr('data-status')
	if (status == 'approve') {
		$('#modal-approval').modal('show')
		$('#modal-approval .modal-title').html('Approve Leave')
		$('#modal-approval .modal-body').html('Are you sure want to approve?')
		$('#approve').html('Approve')
	} else {
		$('#modal-approval').modal('show')
		$('#modal-approval .modal-title').html('Approve Leave')
		$('#modal-approval .modal-body').html('Are you sure want to reject?')
		$('#approve').html('Reject')
	}
	$('#approve').attr('data-id', id)
	$('#approve').attr('data-status', status)
})
$(document).on('click', '#approve', function() {
	let id = $(this).attr('data-id')
	let status = $(this).attr('data-status')
	approval(id, status)
})
function approval(id, status) {
    $('#approve').attr('disabled', true)
    $.ajax({
        url: `${api_url}/leave/${id}/approval`,
        type: 'PATCH',
        data: {
        	status: status
        },
        success: function(result) {
            $('#modal-approval').modal('hide')
            $('#approve').attr('disabled', false)
            if (status == 'approve') {
	            customAlert('success', 'Leave approved')
            } else {
	            customAlert('success', 'Leave rejected')
            }
            get_data()
        }
    })
}
