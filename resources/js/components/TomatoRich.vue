<template>
    <div ref="input">
        <slot name="prepend"/>
        <VueEditor :disabled="disabled" v-model="value" class="bg-white" />
        <slot name="append"/>
    </div>
</template>
<script>

import { VueEditor } from "vue3-editor";
export default {
    components: {
        VueEditor
    },
    props: {
        modelValue: {
            type: [String, Number],
            required: false,
        },
    },
    data() {
        return {
            disabled: false,
            element: null,
            observer: null,
            value: ""
        };
    },
    emits: ["update:modelValue"],
    watch: {
        value(updatedValue) {
            this.$emit("update:modelValue", updatedValue);
        },
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
    },

    render(){
        return this.$slots.default({
            disabled: this.disabled,
            element: this.element,
            observer: this.observer,
            value: this.value,
            VueEditor
        });
    }

};

</script>
