<template>
    <multiselect
        class="leading-4"
        v-model="value"
        :options="options"
        :track-by="optionValue"
        :placeholder="placeholder"
        open-direction="bottom"
        :searchable="true"
        :loading="processing"
        :internal-search="false"
        :show-no-results="true"
        :clear-on-select="true"
        :close-on-select="true"
        @input="performRequest"
        @open="clearAll"
        @select="setModelValue"
    >
        <template #option="{ option, remove }">
            {{ local ?  option?.name[local] : option[optionLabel] }}
        </template>
        <template #singleLabel="{ option, remove }">
            {{ local ?  option?.name[local] : option[optionLabel] }}
        </template>
    </multiselect>
</template>

<script>

import {default as Axios} from "axios";
import Multiselect from "@suadelabs/vue3-multiselect";
import {clear} from "vue3-tel-input/dist/vue3-tel-input.common.js";


export default {
    components: {
        Multiselect
    },
    props: {
        remoteUrl: {
            type: String,
            default: ""
        },
        remoteRoot: {
            type: String,
            default: ""
        },
        acceptHeader: {
            type: String,
            required: false,
            default: "application/json",
        },
        request: {
            type: Object,
            default: {}
        },
        headers: {
            type: Object,
            required: false,
            default: () => {
                return {};
            },
        },

        debounce: {
            type: Number,
            default: 0
        },
        placeholder: {
            type: String,
            default: "Search"
        },
        method: {
            type: String,
            default: "POST"
        },
        disabled: {
            type: Boolean,
            default: false
        },
        modelValue: {
            type: String,
            default: ""
        },
        optionValue: {
            type: String,
            default: "object"
        },
        optionLabel: {
            type: String,
            default: "name"
        }
    },
    data(){
        return {
            value: "",
            processing: false,
            options: [],
            label: '',
            local: false
        }
    },
    watch:{
        modelValue: {
            immediate: true,
            handler(value){
                this.value = value
            }
        }
    },
    mounted() {
        this.value = this.modelValue;
        if(this.optionLabel.includes('.')){
            let labelOptions = this.optionLabel.split('.');
            this.label = labelOptions[0];
            this.local = labelOptions[1]
        }
        else {
            this.label = this.optionLabel;
        }

    },
    methods:{
        clear,
        clearAll(){
            this.options = [];
            this.value = "";
        },
        setModelValue(select){
            if(this.optionValue === 'object'){
                this.$emit("update:modelValue", select);
                this.$emit("change", select);
            }
            else {
                this.$emit("update:modelValue", select[this.optionValue]);
                this.$emit("change", select[this.optionValue]);
            }
        },
        performRequest(select, id) {
            let value = select.target.value;
            this.processing = true;

            const headers = {};

            if(this.acceptHeader) {
                headers.Accept = this.acceptHeader;
            }

            const config = {
                url: this.remoteUrl,
                method: this.method,
                headers: { ...headers, ...this.headers }
            };

            config.data = {search: value};

            if(Object.keys(this.request).length > 0) {
                config.data = config.data.concat(this.request);
            }

            Axios(config)
                .then((response) => {
                    this.options = response.data;
                    this.processing = false;
                    this.$emit("success", response.data);
                })
                .catch(() => {
                    this.processing = false;
                    this.$emit("error");
                });

            if (this.poll) {
                setTimeout(() => {
                    this.performRequest();
                }, this.poll);
            }
        },
    }
}
</script>
