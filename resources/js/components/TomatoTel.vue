<template>
    <div ref="input">
        <slot name="prepend"/>
        <VueTelInput
            :disabled="disabled"
            v-model="value"
            @input="updateData"
            class="mt-2"
            :inputOptions="{
                    name: name,
                    styleClasses: 'block my-2 w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 border-gray-300 dark:border-gray-600',
                }"
            :value="value"
        />
        <slot name="append"/>
    </div>
</template>
<script>

import { VueTelInput } from "vue3-tel-input";
import "vue3-tel-input/dist/vue3-tel-input.css";
export default {
    components: {
        VueTelInput
    },
    props: {
        modelValue: {
            type: [Object, Array],
            required: false,
        },
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
    methods: {
        updateData(number, phoneObject) {
            if (phoneObject) {
                this.value = phoneObject.number;
                this.$emit("update:modelValue", phoneObject.number);
            }
        },
        initTel(){
            import("vue3-tel-input").then((VueTelInput) => {
                this.VueTelInput = VueTelInput;
            });
        }
    },

    render(){
        return this.$slots.default({
            disabled: this.disabled,
            element: this.element,
            observer: this.observer,
            value: this.value,
            VueTelInput
        });
    }
};



</script>
