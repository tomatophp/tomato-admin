<template>
    <swiper
        v-if="type === 'slider'"
        :loop="true"
        :slides-per-view="items"
        :space-between="50"
        navigation
    >
        <swiper-slide v-for="(item, key) in images">
            <img :src="item" alt="">
        </swiper-slide>
    </swiper>
    <div v-if="type === 'gallery'">
        <div v-if="position === 'vertical'">
            <div clas="flex flex-col justify-center">
                <div class="flex justify-center">
                    <div class=" w-80 h-80 rounded-lg border overflow-hidden">
                        <img :src="activeSlider" @click.prevent="isOpen=!isOpen"  class="object-contain" />
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="grid grid-cols-6 gap-4 w-80 h-12 my-4 cursor-pointer">
                        <div v-for="(item, key) in images" @mouseover="activeSlider = item" :class="{'ring ring-primary-500 ring-2': activeSlider === item}" class="bg-cover bg-center w-12 h-12 rounded-lg p-1" :style="'background-image: url('+item+')'">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="flex justify-center gap-4 px-4">
                <div class="flex justify-center col-span-1">
                    <div class="flex flex-col gap-4 cursor-pointer">
                        <div v-for="(item, key) in images" @mouseover="activeSlider = item" :class="{'ring ring-primary-500 ring-2': activeSlider === item}" class="bg-cover bg-center w-12 h-12 rounded-lg p-1" :style="'background-image: url('+item+')'">

                        </div>
                        <div class="relative" v-if="sliderOver">
                            <img :src="sliderOver" width="100%" height="100%" />

                        </div>
                    </div>
                </div>
                <div class="flex justify-center col-span-11 w-80 h-80 rounded-lg border overflow-hidden">
                    <img :src="activeSlider" class="object-contain" @mouseover="sliderOver = activeSlider" @mouseleave="sliderOver = ''" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import Swiper core and required modules
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules';

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';

// Import Swiper styles
export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    data(){
        return {
            activeSlider: "",
            sliderOver: "",
            isOpen: false
        }
    },
    mounted(){
        this.activeSlider = this.images[0];
    },
    props: {
        type: {
            type: String,
            default: () => "gallery",
        },
        position: {
            type: String,
            default: () => "vertical",
        },
        images: {
            type: Array,
            default: () => [],
        },
        items: {
            type: Number,
            default: () => 1,
        }
    },
    setup() {
        const onSwiper = (swiper) => {
            console.log(swiper);
        };
        const onSlideChange = () => {
            console.log('slide change');
        };
        return {
            onSwiper,
            onSlideChange,
            modules: [Navigation, Pagination, Scrollbar, A11y],
        };
    },
};

</script>
