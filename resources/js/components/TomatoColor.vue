<template>
    <div ref="input">
        <slot name="prepend"/>
        <VSwatches
            v-model="value"
            show-fallback
            fallback-input-type="color"
            popover-x="left"
        />
        <slot name="append"/>
    </div>
</template>
<script>
import {VSwatches} from "vue3-swatches";
import 'vue3-swatches/dist/style.css'

export default {
    components: {
        VSwatches
    },
    props: {
        modelValue: {
            type: [Object, Array],
            required: false,
        }
    },
    emits: ["update:modelValue"],
    data() {
        return {
            disabled: false,
            element: null,
            observer: null,
            value: ""
        };
    },
    mounted() {
        if (this.modelValue !== null && this.modelValue !== undefined) {
            this.value = this.modelValue
        }
        else {
            if (this.default) {
                this.value = this.default
            }
        }

        if (this.modelValue !== null && this.modelValue !== undefined) {
            this.value = this.modelValue;
        }
    },
    watch: {
        value: function (val) {
            this.$emit("update:modelValue", val);
        },
        modelValue: function (val) {
            if (this.modelValue) {
                this.value = val;
            }
        },
    },

    render(){
        return this.$slots.default({
            disabled: this.disabled,
            element: this.element,
            observer: this.observer,
            value: this.value,
            VSwatches
        });
    }
};



</script>
