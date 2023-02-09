import { Swiper } from 'swiper/bundle'
import 'swiper/css/bundle'

const thumbnailSwiper = new Swiper('.thumbnail-swiper', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    on: {
        init () {
            document.querySelectorAll('.swiper-slide img').forEach(image => {
                image.classList.add('animate__animated', 'animate__fadeIn')
                image.classList.remove('opacity-0')
            })
        }
    }
})

const mainSwiper = new Swiper('.main-swiper', {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 1,
    navigation: false,
    keyboard: {
        enabled: true
    },
    thumbs: {
        swiper: thumbnailSwiper,
    },
    breakpoints: {
        768: {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        }
    }
})
