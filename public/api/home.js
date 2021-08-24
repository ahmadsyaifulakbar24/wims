// Attendance Log
$.ajax({
    url: `${api_url}/attendance/fetch`,
    type: 'GET',
    data: {
    	limit: 2
    },
    success: function(result) {
        // console.log(result.data)
        if (result.data.length != 0) {
            $.each(result.data, function(index, value) {
            	append = ''
                if (value.home_time != null) {
                    append += `<tr onclick="return location.href='${root}/attendance/${value.home_time.substr(0,10)}/out'">
			            <td>${date_format(value.home_time.substr(0,10))}</td>
			            <td>Clock Out</td>
			            <td>${value.home_time.substr(10,6)}</td>
			            <td class="text-right"><i class="mdi mdi-18px mdi-chevron-right pr-0"></i></td>
			        </tr>`
                }
                append += `<tr onclick="return location.href='${root}/attendance/${value.login_time.substr(0,10)}/in'">
		            <td>${date_format(value.login_time.substr(0,10))}</td>
		            <td>Clock In</td>
		            <td>${value.login_time.substr(10,6)}</td>
		            <td class="text-right"><i class="mdi mdi-18px mdi-chevron-right pr-0"></i></td>
		        </tr>`
                $('#attendance').append(append)
            })
        } else {
            let append = `<td class="text-center">
            	<div class="font-weight-bold pt-3">No attendance</div>
            	<div class="text-secondary">Clock In for attendance</div>
            </td>`
            $('#attendance').append(append)
        }
    }
})

// Report
$.ajax({
    url: `${api_url}/user_report/fetch`,
    type: 'GET',
    data: {
        user_id: user_id
    },
    success: function(result) {
        // console.log(result.data)
        if (result.data != '') {
            $.each(result.data, function(index, value) {
                append = `<tr onclick="return location.href='${root}/report?detail=${value.id}'">
					<td class="text-truncate">${value.title}</td>
		            <td class="text-right"><i class="mdi mdi-18px mdi-chevron-right pr-0"></i></td>
				</tr>`
                $('#report').append(append)
            })
        } else {
            let append = `<td class="text-center">
            	<div class="font-weight-bold pt-3">No report</div>
            	<div class="text-secondary">Your report will show here</div>
            </td>`
            $('#report').append(append)
        }
    }
})
