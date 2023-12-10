<template>
    <div class="w-full h-full" :class="{'flex justify-between gap-4': position !== 'horizontal'}">
        <swiper
            v-if="images.length && position !== 'horizontal'"
            watch-slides-progress
            class="mySwiper"
            ref="swiperSlideRef"
            @swiper="setThumbsSwiper"
            :spaceBetween="10"
            :slidesPerView="4"
            :direction="position"
            :freeMode="true"
            :modules="modules"
            style="height: 300px; width: 350px;"
        >
            <swiper-slide v-for="image in images" class="border rounded-lg overflow-hidden">
                <img :src="image" />
            </swiper-slide>
        </swiper>
        <swiper
            class="swiper-main"
            :navigation="navigation"
            :pagination="true"
            :modules="modules"
            slidesPerView="auto"
            :spaceBetween="14"
            :zoom="{
                maxRatio: 3,
            }"
            :thumbs="{ swiper: thumbsSwiper }"
        >
            <slot />
        </swiper>
        <swiper
            v-if="images.length && position === 'horizontal'"
            watch-slides-progress
            class="mySwiper"
            ref="swiperSlideRef"
            @swiper="setThumbsSwiper"
            :spaceBetween="10"
            :slidesPerView="4"
            :direction="position"
            :freeMode="true"
            :modules="modules"
            style="height: 80px; width: 350px;"
        >
            <swiper-slide v-for="image in images" class="border rounded-lg overflow-hidden">
                <img :src="image" />
            </swiper-slide>
        </swiper>
    </div>
</template>
<script setup>
// import Swiper core and required modules
import {Navigation, Pagination, Zoom, Thumbs, FreeMode} from 'swiper/modules';
import {onMounted, ref} from 'vue';


// Import Swiper styles
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/zoom';
import 'swiper/css/thumbs';


onMounted(()=>{
    const swiper = document.querySelector('.swiper-main').swiper;
    var swiperSlide = document.querySelectorAll('.swiper-main .swiper-slide')
    for(var index = 0; index< swiperSlide.length; index++) {
        swiperSlide[index].addEventListener('mouseover', function (e) {
            swiper.zoom.in();
        });

        swiperSlide[index].addEventListener('mouseout', function (e) {
            swiper.zoom.out();
        });
    }
});

const thumbsSwiper = ref(null);

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper;
};

const modules = ref([Navigation, Zoom, Thumbs, Pagination, FreeMode]);

const props = defineProps({
    navigation: {
        type: Boolean,
        default: false
    },
    images: {
        type: Array,
        default: []
    },
    position: {
        type: String,
        default: 'horizontal'
    }
})
</script>

<style scoped>
.mySwiper {
    box-sizing: border-box;
}

.mySwiper .swiper-slide {
    opacity: 0.4;
}

.mySwiper .swiper-slide-thumb-active {
    opacity: 1;
}
</style>
