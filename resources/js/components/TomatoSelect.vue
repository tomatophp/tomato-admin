<template>
    <div ref="input">
        <slot name="prepend"/>
        <multiselect
            v-if="hasMediaOrDescription"
            v-model="value"
            :options="options"
            :multiple="multiple"
            :track-by="optionValue"
            :label="optionLabel"
            :disabled="disabled"
        >
            <template #singleLabel="props">
                <div class="flex justify-start space-x-2">
                    <img class="option__image w-8" v-if="props.option.media" :src="props.option.media" alt="No Man’s Sky">
                    <span class="option__desc">
                        <span class="option__title">
                            {{ props.option.name }}
                        </span>
                        <br>
                        <span class="option__small text-sm text-gray-400" v-if="props.option.description">
                            {{ props.option.description }}
                        </span>
                    </span>
                </div>
            </template>
            <template #option="props">
                <div class="flex justify-start space-x-2">
                    <img class="option__image w-8" v-if="props.option.media" :src="props.option.media" :alt="props.option.name">
                    <div class="option__desc">
                        <span class="option__title">
                            {{ props.option.name }}
                        </span>
                        <br>
                        <span class="option__small text-sm text-gray-400" v-if="props.option.description">
                            {{ props.option.description }}
                        </span>
                    </div>
                </div>
            </template>
        </multiselect>
        <multiselect
            v-else-if="getType==='select-value' || getType === 'relation'"
            v-model="value"
            :options="getType === 'relation' ? options.data:options"
            :multiple="multiple"
            :track-by="optionValue"
            :label="optionLabel"
            :disabled="disabled"
        >
        </multiselect>
        <multiselect
            v-else-if="getType==='select'"
            v-model="value"
            :options="options"
            :multiple="multiple"
            :disabled="disabled"
        >
        </multiselect>
        <slot name="append"/>
    </div>
</template>
<script>

import Multiselect from "@suadelabs/vue3-multiselect";
import "@suadelabs/vue3-multiselect/dist/vue3-multiselect.css";

export default {
    components: {
        Multiselect
    },
    props: {
        getType: {
            type: String,
            required: false,
            default: "select"
        },

        multiple: {
            type: Boolean,
            required: false,
            default: false
        },

        model: {
            type: String,
            required: false,
            default: ''
        },

        options: {
            type: Array,
            required: false,
            default: []
        },

        modelValue: {
            type: [String, Number, Array],
            required: false,
        },

        placeholder: {
            type: [Boolean, Object],
            required: false,
            default: false,
        },

        dusk: {
            type: String,
            required: false,
            default: null,
        },

        remoteUrl: {
            type: String,
            required: false,
            default: null,
        },

        optionValue: {
            type: String,
            required: false,
            default: null,
        },

        optionLabel: {
            type: String,
            required: false,
            default: null,
        },

        remoteRoot: {
            type: String,
            required: false,
            default: null,
        },

        query: {
            type: Array,
            required: false,
            default: null,
        },
    },
    emits: ["update:modelValue"],
    computed:{
        hasMediaOrDescription(){
            if(this.options.length){
                return this.options.some(option => option.media || option.description);
            }
        },
        /*
         * Returns a boolean whether a selection has been made.
         */
        hasSelection() {
            if (this.multiple) {
                return Array.isArray(this.modelValue) ? this.modelValue.length > 0 : false;
            }

            if (this.modelValue === null || this.modelValue === "" || this.modelValue === undefined) {
                return false;
            }

            return true;
        },
    },
    data() {
        return {
            element: null,
            placeholderText: null,
            headlessListener: null,
            selectChangeListener: null,
            selectShowDropdownListener: null,
            loading: false,
            disabled: false,
            value: ""
        };
    },
    mounted() {
        if (this.modelValue !== null && this.modelValue !== undefined) {
            if(typeof this.modelValue === 'object'){
                this.value = this.modelValue
            }
            else {
                if(this.options.data.length){
                    this.value = this.options.data.find(option => option[this.optionValue] === this.modelValue)
                }
            }
        }
        else {
            if (this.default) {
                this.value = this.default
            }
        }
    },
    watch: {
        value: function (val) {
            this.$emit("update:modelValue", typeof val === 'object' ? val[this.optionValue] : val);
            this.$emit("change");
        },
        modelValue: function (val) {
            if(typeof val === 'object'){
                this.value = val;
            }
            else {
                this.value = this.options.data.find(option => option[this.optionValue] === val);
            }
        },
    },
    methods: {
        updateData(number, phoneObject) {
            if (phoneObject) {
                this.value = phoneObject.number;
                this.$emit("update:modelValue", phoneObject.number);
            }
        }
    },

    render(){
        return this.$slots.default({
            element: this.element,
            placeholderText: this.placeholderText,
            headlessListener: this.headlessListener,
            selectChangeListener: this.selectChangeListener,
            selectShowDropdownListener: this.selectShowDropdownListener,
            loading: this.loading,
            disabled: this.disabled,
            value: this.value
        });
    }
};



</script>
