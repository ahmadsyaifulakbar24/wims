// Attendance Log
get_attendance()
function get_attendance(date) {
	date != undefined ? $('#date_filter').html(date_format(date)) : $('#date_filter').empty()
	$('#table').empty()
	$.ajax({
	    url: `${api_url}/attendance/fetch`,
	    type: 'GET',
        data: {
            login_time: date
        },
	    success: function(result) {
	        // console.log(result.data)
	        if (result.data.length != 0) {
	            $.each(result.data, function(index, value) {
	                append = `<tr>
	                	<td class="text-center">${index + 1}.</td>
			            <td class="text-truncate"></td>
			            <td class="text-truncate">${date_format(value.login_time.substr(0,10))}</td>
			            <td><a href="${root}/time-management/attendance/${value.id}/in">${value.login_time.substr(10,6)}</a></td>
			            <td>${value.login_description != null ? value.login_description : '-'}</td>
			            <td>${value.home_time != null ? `<a href="${root}/time-management/attendance/${value.id}/out">${value.home_time.substr(10,6)}</a>` : ''}</td>
			            <td>${value.home_time != null ? value.home_description != null ? value.home_description : '-' : ''}</td>
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

$('#filter').click(function() {
    let date = $('#date').val()
    get_attendance(date)
    $('#modal-filter').modal('hide')
})
