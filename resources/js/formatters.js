// Format all currencies
document.querySelectorAll('[data-type=currency]').forEach(node => {
    const value = +node.innerText

    node.innerText = new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: 'RUB',
    }).format(value)

    node.style.opacity = 1
})
