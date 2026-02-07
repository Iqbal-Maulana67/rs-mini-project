function success(params)
{
    Swal.fire({
        title: 'Success!',
        text: params,
        icon: 'success',
        confirmButtonText: 'OK'
    })
}

function error(params)
{
    Swal.fire({
        title: 'Error!',
        text: params,
        icon: 'error',
        confirmButtonText: 'OK'
    })
}