$(document).ready(function() {
	if (localStorage.getItem('token') != null) logout()
})

$('#form').submit(function(e) {
    e.preventDefault()
    $('.alert').hide()
    const username = $('#username').val()
    const password = $('#password').val()
    addLoading()
    $.ajax({
        url: `${api_url}/login`,
        type: 'POST',
        data: {
            username: username,
            password: password
        },
        success: function(result) {
            let value = result.data
            localStorage.setItem('token', value.access_token)
            localStorage.setItem('user_id', value.user.id)
            localStorage.setItem('name', value.user.name)
            localStorage.setItem('username', value.user.username)
            localStorage.setItem('role', value.user.role_id.id)
            localStorage.setItem('photo', value.user.profile_photo_url)
            $.ajax({
                url: `${root}/session/login`,
                type: 'GET',
                data: {
                    token: value.access_token,
                    role: value.user.role_id.id
                },
                success: function(result) {
                    location.href = `${root}/dashboard`
                }
            })
        },
        error: function(xhr) {
            // let err = JSON.parse(xhr.responseText)
            // console.log(err)
            $('.alert-danger').show()
            removeLoading('Login')
        }
    })
})
