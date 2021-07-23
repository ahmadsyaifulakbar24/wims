$.ajax({
    url: `${api_url}/company/fetch`,
    type: 'GET',
    data: {
        type: 'branch'
    },
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        console.log(result)
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
					<td class="text-truncate">${value.ref_company_code}</td>
					<td class="text-truncate">${value.type}</td>
					<td class="text-truncate">${value.employee_reach_id}</td>
					<td class="text-truncate">${value.email}</td>
					<td class="text-truncate">${value.phone_number}</td>
					<td class="text-truncate"></td>
				</tr>`
                $('#table').append(append)
            })
        } else {
        	append = `<td class="text-truncate" colspan="10">Data not found.</td>`
            $('#table').append(append)
        }
    }
})
