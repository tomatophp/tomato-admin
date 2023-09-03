
<script>
export default {
    props: {
        modelValue: {
            type: [Object, Array],
            required: false,
        },
        options: {
            type: [Object, Array],
            required: false,
        },
        name: {
            type: String,
            required: false
        },
        id: {
            type: String,
            required: false
        },
    },
    emits: ["update:modelValue"],
    data() {
        return {
            main: [],
            options: [],
        };
    },
    mounted() {
        this.main = this.modelValue;
    },
    computed:{
        formOptions(){
            let getOptions = [];
            let generateObject = {};
            for(let i=0; i<this.$props.options.length; i++){
                generateObject[this.$props.options[i]] = "";
            }
            return generateObject;
        }
    },
    methods: {
        addItem() {
            let JSONRows = JSON.stringify(this.formOptions);
            this.main.push(JSON.parse(JSONRows));
            this.$emit("update:modelValue", this.main);
        },
        removeItem(value) {
            this.main.splice(this.main.indexOf(value), 1);
            this.$emit("update:modelValue", this.main);
        },
    },
    render(){
        return this.$slots.default({
            main: this.main,
            addItem: this.addItem,
            removeItem: this.removeItem,
        });
    }
};



</script>
