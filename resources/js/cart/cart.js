import axios from 'axios'
import { Alert } from 'bootstrap'

function showErrorMessage (message) {
    const errorAlert = document.querySelector('#errorAlert').content.cloneNode(true)
    const errorMessage = errorAlert.querySelector('#alertMessage')
    errorMessage.innerText = message

    const errorContainer = document.querySelector('#errorContainer')

    const oldError = errorContainer.querySelector('.alert')
    if (oldError) {
        const oldAlert = Alert.getOrCreateInstance(oldError)
        oldError.addEventListener('closed.bs.alert', () => {
            errorContainer.appendChild(errorAlert)
        })
        oldAlert.close()
    } else {
        errorContainer.appendChild(errorAlert)
    }

    const cartSectionStart = document.querySelector('#cartSectionStart')
    cartSectionStart.scrollIntoView()
}

window.initializeQuantityChangeHandler = function (options) {
    const { cartRoute } = options

    const quantitySelects = document.querySelectorAll('.product-quantity')
    quantitySelects.forEach(select => select.addEventListener('change', async e => {
        try {
            const productRowId = select.dataset.id

            await axios.patch(`${cartRoute}/${productRowId}`, {
                quantity: +e.target.value
            })
        } catch (e) {
            showErrorMessage('Произошла ошибка при изменении количества товаров.')
        } finally {
            window.location.href = cartRoute
        }
    }))
}
