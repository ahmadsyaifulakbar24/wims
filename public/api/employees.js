$.ajax({
    url: `${api_url}/employee/fetch`,
    type: 'GET',
    success: function(result) {
        // console.log(result)
        if (result.data != '') {
            $.each(result.data, function(index, value) {
                append = `<tr>
					<td class="text-center">${index + 1}.</td>
					<td class="text-truncate">
						<a href="${root}/company/${value.id}" class="d-flex align-items-center text-dark">
							<img src="${root}/assets/images/user.jpg" class="avatar rounded-circle mr-2" width="30">
							<span>${value.name}</span>
						</a>
					</td>
					<td class="text-truncate">${value.employee_id}</td>
					<td class="text-truncate">${value.organization_id.param}</td>
					<td class="text-truncate">${value.job_position_id.param}</td>
					<td class="text-truncate">${value.job_level_id.param}</td>
					<td class="text-truncate">
						<i class="mdi mdi-18px mdi-pencil-outline"></i>
						<i class="mdi mdi-18px mdi-trash-can-outline"></i>
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
