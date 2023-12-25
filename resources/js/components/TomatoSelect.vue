<template>
    <div ref="input">
        <slot name="prepend"/>
        <multiselect
            v-if="hasMediaOrDescription"
            v-model="value"
            :options="options"
            :multiple="multiple"
            track-by="id"
            label="name"
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
            :options="getType === 'relation' ? relation : []"
            @search-change="queryThis"
            @select="selectThis"
            :multiple="multiple"
            track-by="id"
            label="name"
            :loading="loading"
            :hide-selected="true"
            :show-no-results="false"
            :internal-search="false"
            :disabled="disabled"
        >
            <template #afterList>
                <li @click.prevent="loadMore()" class="text-center py-2 text-primary-500" v-if="this.currentPage">
                    <button>{{ loadMoreLabel }}</button>
                </li>
            </template>
        </multiselect>
        <multiselect
            v-else-if="getType==='icon'"
            v-model="value"
            :options="options"
            :multiple="multiple"
            :disabled="disabled"
        >
            <template #singleLabel="props">
                <div class="flex justify-start gap-2">
                    <div class="flex flex-col items-center justify-center text-primary-500">
                        <i class="bx" :class="props.option"></i>
                    </div>
                    <span class="option__desc">
                        <span class="option__title font-bold">
                            {{ props.option }}
                        </span>
                    </span>
                </div>
            </template>
            <template #option="props">
                <div class="flex justify-start gap-2">
                    <div class="flex flex-col items-center justify-center text-primary-500">
                        <i class="bx" :class="props.option"></i>
                    </div>
                    <div class="option__desc">
                        <span class="option__title">
                            {{ props.option }}
                        </span>
                    </div>
                </div>
            </template>
        </multiselect>
        <multiselect
            v-else-if="getType==='select'"
            v-model="value"
            :options="options"
            :track-by="optionValue??'id'"
            :label="optionLabel??'name'"
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

        queryBy: {
            type: String,
            required: false,
            default: null,
        },

        paginated: {
            required: false,
            default: false,
        },

        loadMoreLabel: {
            type: String,
            required: false,
            default: null,
        }
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
            value: "",
            relation: [],
            searchQuery: "",
            currentPage: 0
        };
    },
    mounted() {
        if(this.remoteUrl){
            this.loading = true;
            axios.get(this.remoteUrl).then(response => {
                if(this.paginated){
                    this.currentPage = parseInt(response.data.data.current_page) === parseInt(response.data.data.last_page) ? 0 : parseInt(response.data.data.current_page);
                    this.relation = response.data.data[this.remoteRoot];
                }
                else {
                    this.relation = response.data.data;
                }
                this.relation = this.relation.map(option => {
                    if(this.optionLabel.includes('.')){
                        let optionsArray = this.optionLabel.split('.');
                        return {
                            name: option[optionsArray[0]][optionsArray[1]],
                            id: option[this.optionValue]
                        }
                    }
                    else {
                        let optionsArray = this.optionLabel.split('.');
                        return {
                            name: option[this.optionLabel],
                            id: option[this.optionValue]
                        }
                    }

                })
                if (this.modelValue !== null && this.modelValue !== undefined) {
                    let currentValue = this.modelValue;
                    this.value = this.relation.find(option => option[this.optionValue] === this.modelValue)
                    if(typeof this.value === "undefined"){
                        let searchURL = this.remoteUrl.includes('?') ?  this.remoteUrl + '&id=' + currentValue : this.remoteUrl + '?id=' + currentValue;
                        axios.get(searchURL).then(response => {
                            let responseData = null;
                            if(this.paginated){
                                responseData = response.data.data[this.remoteRoot];
                            }
                            else {
                                responseData = response.data.data;
                            }
                            let newData = responseData.map(option => {
                                if(this.optionLabel.includes('.')){
                                    let optionsArray = this.optionLabel.split('.');
                                    return {
                                        name: option[optionsArray[0]][optionsArray[1]],
                                        id: option[this.optionValue]
                                    }
                                }
                                else {
                                    let optionsArray = this.optionLabel.split('.');
                                    return {
                                        name: option[this.optionLabel],
                                        id: option[this.optionValue]
                                    }
                                }
                            })
                            newData.forEach((item) => {
                                this.value = item
                            });
                        });
                    }
                }
                this.loading = false;
            });
        }
        if (this.modelValue !== null && this.modelValue !== undefined) {
            if(this.getType === 'icon'){
                this.value = this.modelValue
            }
            else {
                if(typeof this.modelValue === 'object'){
                    this.value = this.modelValue
                }
                else if(typeof this.modelValue !== "undefined"){
                    if(this.options.length){
                        this.value = this.options.find(option => option.id === this.modelValue)
                    }
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
            if(this.getType === 'icon'){
                this.$emit("update:modelValue",  val);
            }
            else {
                this.$emit("update:modelValue", typeof val === 'object' ? this.optionValue ? val.id : null : val);
            }
        },
        modelValue: function (val) {
            if(this.getType === 'icon'){
                this.value = val;
            }
            else {
                if(typeof val === 'object'){
                    this.value = val;
                }
                else if(typeof val !== "undefined"){
                    if(this.options.length){
                        this.value = this.options.find(option => option.id === val)
                    }
                }
            }
        },
    },
    methods: {
        selectThis(val){
            this.$emit('select', typeof val === 'object' ? this.optionValue ? val.id : null : val)
        },
        loadMore(){
            this.loading = true;
            let searchURL = "";
            if(this.searchQuery){
                searchURL = this.remoteUrl.includes('?') ?  this.remoteUrl + '&'+this.queryBy+'=' + this.searchQuery : this.remoteUrl + '?'+this.queryBy+'=' + this.searchQuery;
            }
            else {
                searchURL = this.remoteUrl;
            }
            this.currentPage +=1;
            searchURL = searchURL.includes('?') ? searchURL + '&page=' + this.currentPage :  searchURL + '?page=' + this.currentPage;
            axios.get(searchURL).then(response => {
                let responseData = [];
                if(this.paginated){
                    this.currentPage = parseInt(response.data.data.current_page) === parseInt(response.data.data.last_page) ? 0 : parseInt(response.data.data.current_page);
                    responseData = response.data.data[this.remoteRoot];
                }
                let newData = responseData.map(option => {
                    if(this.optionLabel.includes('.')){
                        let optionsArray = this.optionLabel.split('.');
                        return {
                            name: option[optionsArray[0]][optionsArray[1]],
                            id: option[this.optionValue]
                        }
                    }
                    else {
                        let optionsArray = this.optionLabel.split('.');
                        return {
                            name: option[this.optionLabel],
                            id: option[this.optionValue]
                        }
                    }
                })
                newData.forEach((item) => {
                    this.relation.push(item);
                });
                this.loading = false;
            });
        },
        queryThis(value){
            this.$emit("update:change", value);
            this.loading = true;
            this.searchQuery = value;
            let searchURL = this.remoteUrl.includes('?') ?  this.remoteUrl + '&'+this.queryBy+'=' + value : this.remoteUrl + '?'+this.queryBy+'=' + value;
            axios.get(searchURL).then(response => {
                if(this.paginated){
                    this.currentPage = parseInt(response.data.data.current_page) === parseInt(response.data.data.last_page) ? 0 : parseInt(response.data.data.current_page);
                    this.relation = response.data.data[this.remoteRoot];
                }
                else {
                    this.relation = response.data.data;
                }
                this.relation = this.relation.map(option => {
                    if(this.optionLabel.includes('.')){
                        let optionsArray = this.optionLabel.split('.');
                        return {
                            name: option[optionsArray[0]][optionsArray[1]],
                            id: option[this.optionValue]
                        }
                    }
                    else {
                        let optionsArray = this.optionLabel.split('.');
                        return {
                            name: option[this.optionLabel],
                            id: option[this.optionValue]
                        }
                    }
                })
                this.loading = false;
            });
        },
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
<style>
.multiselect__tags{
    border-radius: 0.375rem;
    --tw-border-opacity: 1;
    border-color: rgb(209 213 219 / var(--tw-border-opacity));
    font-weight: 500 !important;
}
</style>
