import Swal from 'sweetalert2'

function Errors (data) {
    const errors = Object.values(data.errors)
    let textError = ''

    for (let i = 0; i < errors.length; i++) {
        let err = errors[i][0]
        textError += `<div>${err}</div>`
    }

    Swal.fire({
        icon: 'error',
        title: data.message,
        html: textError,
    })
}

export default Errors;