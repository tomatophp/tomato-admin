<template>
    <div :id="'tippy'+id">
        <slot />
    </div>
</template>
<script setup>
import tippy from "tippy.js";
import {onMounted} from "vue";

const props = defineProps({
   text: {
       required: true,
       type: String,
   },
    id: {
        required: true,
        type: String,
    },
    position: {
        required: false,
        type: String,
        default: 'top',
    },
});



onMounted(()=>{
    $('#tippy'+props.id).ready(function() {
        setTimeout(()=>{
            tippy('#tippy'+props.id, {
                content: props.text,
                animation: 'fade',
                placement: props.position,
            });
        }, 2000);
    });
});

</script>
