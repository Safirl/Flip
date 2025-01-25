import 'swiper/css';
import 'swiper/css/effect-cards';
import Swiper from 'swiper';
import {EffectCards} from 'swiper/modules';

const swiper = new Swiper(".pollsSwiper", {
    modules: [EffectCards],
    effect: "cards",
    grabCursor: true,
});
