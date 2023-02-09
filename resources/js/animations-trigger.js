const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const animationClass = entry.target.dataset.animation ?? 'animate__slideInDown'
            entry.target.classList.add(animationClass)
            entry.target.classList.remove('opacity-0')
        }
    })
})

document.querySelectorAll('.animate__animated').forEach(node => observer.observe(node))
