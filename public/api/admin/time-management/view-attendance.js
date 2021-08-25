$.ajax({
    url: `${api_url}/attendance/fetch/${id}`,
    type: 'GET',
    success: function(result) {
        // console.log(result.data)
        if (result.data.length != 0) {
        	let value = result.data
        	$('#name').html(value.employe_name)
            if (type == 'in') {
                $('#type').html('Clock In')
                $('#image').attr('src', value.login_image_url)
                $('#date').html(date_format(value.login_time.substr(0, 10)))
                $('#time').html(value.login_time.substr(10, 6))
                $('#coordinate').html(`${value.login_latitude},${value.login_longitude}`)
                $('#description').html(value.login_description)
            } else if (type == 'out') {
                $('#type').html('Clock Out')
                $('#image').attr('src', value.home_image_url)
                $('#date').html(date_format(value.home_time.substr(0, 10)))
                $('#time').html(value.home_time.substr(10, 6))
                $('#coordinate').html(`${value.home_latitude},${value.home_longitude}`)
                $('#description').html(value.home_description)
            }
            $('#card').show()
            $('#loading').remove()
        } else {
            window.history.back()
        }
    }
})
