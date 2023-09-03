<template>
    <div ref="input">
        <slot name="prepend"/>
        <Codemirror
            v-model:value="value"
            ref="cmEditor"
            width="100%"
            :options="cmOptions"
            border
        />
        <slot name="append"/>
    </div>
</template>
<script>

import "codemirror/lib/codemirror.css";
import "codemirror/mode/php/php.js";
import "codemirror/mode/javascript/javascript.js";
import "codemirror/mode/css/css.js";
import "codemirror/mode/htmlmixed/htmlmixed.js";
import "codemirror/addon/edit/matchbrackets";
import "codemirror/mode/xml/xml.js";
import "codemirror/theme/base16-dark.css";
import "codemirror/mode/clike/clike.js";
import Codemirror from "codemirror-editor-vue3";

export default {
    components: {
        Codemirror
    },
    props: {
        modelValue: {
            type: [String, Number],
            required: false,
        },
        ex: {
            type: [String, Number],
            required: false,
            default: "txt"
        }
    },
    data() {
        return {
            disabled: false,
            element: null,
            observer: null,
            value: "",
            cmOptions: {
                tabSize: 4,
                mode: "application/x-httpd-php",
                theme: "base16-dark",
                lineNumbers: true,
                line: true,
                matchBrackets: true,
                indentUnit: 4,
                indentWithTabs: true,
                lineWrapping: true,
            }
        };
    },
    emits: ["update:modelValue"],
    watch: {
        value(updatedValue) {
            this.$emit("update:modelValue", updatedValue);
        },
        ex(newValue){
            if (this.ex == "php") {
                this.cmOptions.mode = "application/x-httpd-php";
            } else if (
                this.ex == "js" ||
                this.ex == "json" ||
                this.ex == "lock"
            ) {
                this.cmOptions.mode = {
                    name: "javascript",
                    json: true,
                };
            } else if (this.ex == "css") {
                this.cmOptions.mode = "text/css";
            } else if (
                this.ex == "webp" ||
                this.ex == "svg" ||
                this.ex == "png" ||
                this.ex == "jpg" ||
                this.ex == "jpeg" ||
                this.ex == "tif" ||
                this.ex == "gif" ||
                this.ex == "ico"
            ) {
            }
        }
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
            cmOptions: {
                tabSize: 4,
                mode: "application/x-httpd-php",
                theme: "base16-dark",
                lineNumbers: true,
                line: true,
                matchBrackets: true,
                indentUnit: 4,
                indentWithTabs: true,
                lineWrapping: true,
            },
            Codemirror
        });
    }

};

</script>
