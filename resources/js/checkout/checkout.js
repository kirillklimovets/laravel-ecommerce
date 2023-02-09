import _ from 'lodash/fp'
import axios from 'axios'
import { Alert } from 'bootstrap'

let stripe, elements, allowSubmitWithoutValidityCheck = true

// Fetches a payment intent and captures the client secret
async function initialize ({ paymentIntentRoute, csrfToken, locale }) {
    try {
        setLoading(true)

        const response = await axios.post(paymentIntentRoute, null, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-Token': csrfToken
            }
        })

        const clientSecret = response.data.clientSecret

        const styles = getComputedStyle(document.body)

        const appearance = {
            theme: 'none',
            rules: {
                '.Input': {
                    border: `1px solid ${styles.getPropertyValue('--bs-gray-400')}`,
                    lineHeight: '1.6',
                    fontSize: '0.9rem',
                    fontWeight: '500',
                    padding: '0.375rem 0.75rem',
                    transition: 'border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out',
                },
                '.Input:focus': {
                    borderColor: '#86b7fe',
                    outline: 0,
                    boxShadow: `0 0 0 0.25rem rgba(${styles.getPropertyValue('--bs-primary-rgb')}, 0.25)`,
                },
                '.Label': {
                    fontSize: '0.9rem',
                    marginBottom: '0.5rem',
                },
                '.Error': {
                    fontSize: '0.7875em'
                }
            },
        }

        elements = stripe.elements({ clientSecret, appearance, locale })

        const paymentElement = elements.create('payment')
        paymentElement.mount('#payment-element')

        paymentElement.on('ready', setLoading.bind(null, false))

        paymentElement.on('change', e => {
            const messageAlert = document.querySelector('#stripeMessageContainer > .alert')
            if (messageAlert) {
                Alert.getOrCreateInstance(messageAlert).close()
            }
            setSubmitWithoutValidityCheck(!e.complete)
        })
    } catch (e) {
        setLoading(false)

        if (e.response.status === 409) {
            const errorMessageTitle = e.response.data.message
            const errorMessageSubtitle = 'Пожалуйста, обновите страницу.'
            showError(errorMessageTitle, errorMessageSubtitle)

            return
        }

        showError()
    }
}

async function handleSubmit (options, e) {
    try {
        const { checkoutSuccessRoute } = options

        e.preventDefault()

        document.querySelectorAll('input').forEach(input => input.value = input.value.trim())

        const form = document.querySelector('#payment-form')
        form.classList.add('was-validated')

        if (!form.checkValidity()) {
            e.stopPropagation()
            form.querySelectorAll('input').forEach(input => input.placeholder = '')
            if (!allowSubmitWithoutValidityCheck) {
                document.querySelector('#customerInfoSection').scrollIntoView()
                return
            }
        }

        setLoading(true, true)

        const formData = {
            email: form.querySelector('#email').value,
            name: form.querySelector('#name').value,
            phone: form.querySelector('#phone').value,
            city: form.querySelector('#city').value,
            line1: form.querySelector('#line1').value,
            line2: form.querySelector('#line2').value,
            postal_code: form.querySelector('#postalCode').value,
            state: form.querySelector('#state').value,
        }

        const { email, name, phone, city, line1, line2, postal_code, state } = formData

        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: checkoutSuccessRoute,
                shipping: {
                    address: { city, line1, line2, postal_code, state },
                    name, phone
                },
                payment_method_data: {
                    billing_details: {
                        address: { city, line1, line2, postal_code, state },
                        email, name, phone,
                    }
                },
            },
        })

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`.

        if (error.type === 'card_error' || error.type === 'validation_error') {
            showMessage(error.message)
        } else {
            showMessage('Что-то пошло не так.')
        }

        setLoading(false)
    } catch (e) {
        setLoading(false)
        showMessage(e.message)
    }
}

// ------- UI helpers -------
// Shows a message inside the red alert
function showMessage (messageText) {
    const messageAlert = document.createElement('div')
    messageAlert.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade', 'show')
    messageAlert.setAttribute('role', 'alert')

    const message = document.createElement('span')
    message.innerText = messageText

    const closeButton = document.createElement('button')
    closeButton.classList.add('btn-close')
    closeButton.type = 'button'
    closeButton.setAttribute('data-bs-dismiss', 'alert')

    messageAlert.append(message, closeButton)

    const messageContainer = document.querySelector('#stripeMessageContainer')
    const oldMessageAlert = messageContainer.querySelector('.alert')

    if (oldMessageAlert) {
        const alert = Alert.getOrCreateInstance(oldMessageAlert)
        oldMessageAlert.addEventListener('closed.bs.alert', () => {
            messageContainer.appendChild(messageAlert)
        })
        alert.close()
    } else {
        messageContainer.appendChild(messageAlert)
    }
}

// Shows the spinner, disables the submit button and all inputs
function setLoading (isLoading, isProcessing = false) {
    if (isLoading) {
        if (isProcessing) {
            document.querySelector('#buttonSpinner').classList.remove('visually-hidden')
            document.querySelectorAll('input').forEach(input => input.disabled = true)
        } else {
            document.querySelector('#spinner').classList.remove('visually-hidden')
        }
        document.querySelector('#submit').disabled = true
    } else {
        document.querySelector('#buttonSpinner').classList.add('visually-hidden')
        document.querySelectorAll('input').forEach(input => input.disabled = false)
        document.querySelector('#submit').disabled = false
        document.querySelector('#spinner').classList.add('visually-hidden')
    }
}

// Shows an error message and disables the submit button and all inputs
function showError (errorMessageTitle, errorMessageSubtitle) {
    document.querySelectorAll('input, #submit').forEach(input => input.disabled = true)

    const error = document.querySelector('#errorMessageTemplate').content.cloneNode(true)
    error.querySelector('#errorMessageTitle').innerText = errorMessageTitle ?? 'Произошла непредвиденная ошибка'
    error.querySelector('#errorMessageSubtitle').innerText = errorMessageSubtitle ?? 'Пожалуйста, попробуйте позже'

    document.querySelector('#errorMessageContainer').appendChild(error)
}

// Toggle if the user can confirm the payment without validating other inputs
function setSubmitWithoutValidityCheck (allow) {
    allowSubmitWithoutValidityCheck = allow
}

window.initializeStripe = async function (options) {
    const { stripeKey } = options
    stripe = Stripe(stripeKey)
    await initialize(options)
    document.querySelector('#payment-form').addEventListener('submit', _.curry(handleSubmit).bind(null, options))
}
