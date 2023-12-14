<script>
import TomatoSearch from "./TomatoSearch.vue";

export default {
    components: {TomatoSearch},
    props: {
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
        options: {
            type: [Object, Array],
            required: false,
        },
        location: {
            type: String,
            default: "en-US"
        },
        currency: {
            type: String,
            default: "USD"
        }
    },
    emits: ["update:modelValue"],
    data() {
        return {
            main: [],
            switchInput: false
        };
    },
    watch: {
        modelValue: {
            handler() {
                this.main = this.modelValue;
            },
            deep: true
        },
        main: {
            handler() {
                this.$emit("update:modelValue", this.main);
            },
            deep: true
        }
    },
    mounted() {
        this.main = this.modelValue;
    },
    computed:{
        tax(){
            let tax = 0;
            for(let i=0; i<this.main.length; i++){
                tax += this.main[i].tax * this.main[i].qty;
            }
            return new Intl.NumberFormat(this.location, { style: 'currency', currency: this.currency}).format(
                tax,
            )
        },
        discount(){
            let discount = 0;
            for(let i=0; i<this.main.length; i++){
                discount += this.main[i].discount * this.main[i].qty;
            }
            return new Intl.NumberFormat(this.location, { style: 'currency', currency: this.currency}).format(
                discount,
            )
        },
        price(){
            let price = 0;
            for(let i=0; i<this.main.length; i++){
                price += this.main[i].price * this.main[i].qty;
            }
            return new Intl.NumberFormat(this.location, { style: 'currency', currency: this.currency}).format(
                price,
            )
        },
        total(){
            let total = 0;
            for(let i=0; i<this.main.length; i++){
                total += this.main[i].total;
            }
            return new Intl.NumberFormat(this.location, { style: 'currency', currency: this.currency}).format(
                total,
            )
        }
    },
    methods: {
        addItem() {
            let JSONRows = JSON.stringify(this.$props.options);
            this.main.push(JSON.parse(JSONRows));
            this.$emit("update:modelValue", this.main);
        },
        removeItem(value) {
            if(this.main.length > 1){
                this.main.splice(this.main.indexOf(value), 1);
                this.$emit("update:modelValue", this.main);
            }
        },
        updateTotal(key){
            let price = this.main[key].price;
            let discount = this.main[key].discount;
            let tax = this.main[key].tax;
            let qty = this.main[key].qty;
            let total = (price - discount) + tax;
            this.main[key].total = total * qty;
        }
    },
    render(){
        return this.$slots.default({
            main: this.main,
            addItem: this.addItem,
            removeItem: this.removeItem,
            updateTotal: this.updateTotal,
            switchInput: this.switchInput,
            total: this.total,
            price: this.price,
            discount: this.discount,
            tax: this.tax,
        });
    }
};

</script>

