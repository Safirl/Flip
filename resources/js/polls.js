import 'swiper/css';
import Swiper from 'swiper';

const btnNext = document.querySelector('.polls-next');
const btnPrev = document.querySelector('.polls-previous');

const swiper = new Swiper(".pollsSwiper", {
    grabCursor: true,
    on: {
        init: (swiper) => {
            btnPrev.disabled = swiper.isBeginning
            btnNext.disabled = swiper.isEnd

            btnNext.addEventListener('click', () => {
                swiper.slideNext()
            })

            btnPrev.addEventListener('click', () => {
                swiper.slidePrev()
            })
        },
        slideChange: (swiper) => {
            btnPrev.disabled = swiper.isBeginning
            btnNext.disabled = swiper.isEnd
        }
    }
});


