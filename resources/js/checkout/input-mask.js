import IMask from 'imask'

const phoneInput = document.querySelector('#phone')
const postalCodeInput = document.querySelector('#postalCode')

if (phoneInput) {
    IMask(phoneInput, {
        mask: '+0(000)000-00-00'
    })
}

if (postalCodeInput) {
    IMask(postalCodeInput, {
        mask: /^[1-6]\d{0,5}$/
    })
}
