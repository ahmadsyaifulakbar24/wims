$.ajax({
    url: `${api_url}/company/fetch`,
    type: 'GET',
    // data: {
    //     type: 'center'
    // },
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function(result) {
        console.log(result)
    }
})