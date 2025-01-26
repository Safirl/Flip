import 'swiper/css';
import Swiper from 'swiper';

const btnNext = document.querySelector('.polls-next');
const btnPrev = document.querySelector('.polls-previous');

const slides = document.querySelector('.pollsSwiper .swiper-wrapper')
const pollId = new URLSearchParams(window.location.search).get('poll-id');
const initialSlideIndex = Array.from(slides.children).findIndex(el => el.dataset.pollId === pollId)

const swiper = new Swiper(".pollsSwiper", {
    grabCursor: true,
    initialSlide: initialSlideIndex && initialSlideIndex > -1 ? initialSlideIndex : 0,
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


