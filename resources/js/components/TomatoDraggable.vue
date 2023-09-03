<template>
    <VueDraggableNext
        :list="main"
        :order-by="orderBy"
        group="drag"
        @change="log"
    >
        <div v-for="(item,key) in main" class="flex flex-col h-full">
            <slot v-bind="{item, key}"></slot>
            <VueDraggableNext class="w-full h-full py-4 pl-4 flex flex-col justify-center space-y-4" @change="log" group="drag" :list="item.children" :order-by="orderBy">
                <template #default>
                    <div v-for="(item, key) in item.children">
                        <slot v-bind="{item, key}"></slot>
                        <TomatoDraggable class="w-full h-full  py-4 pl-4 flex flex-col justify-center space-y-4" @change="log" :options="item.children" :order-by="orderBy">
                            <template #default="{item, key}">
                                <slot v-bind="{item, key}"></slot>
                            </template>
                        </TomatoDraggable>
                    </div>
                </template>
            </VueDraggableNext>
        </div>
    </VueDraggableNext>
</template>
<script>
import {VueDraggableNext} from 'vue-draggable-next'

export default {
    name: "TomatoDraggable",
    components: {
        VueDraggableNext
    },
    props: {
        options: {
            type: [Object, Array],
            required: false,
        },
        url: {
            type: [String],
            required: false,
        },
        orderBy: {
            type: [String],
            required: true,
        },
        levels: {
            default: 0,
            required: true,
        }
    },
    data() {
        return {
            main: [],
            ch: [],
            event: null,
        };
    },
    mounted() {
      this.main = this.options;
      if(this.main){
          this.main.map(function (item){
              if(!item.children){
                  item.children = [];
              }

              return item;
          });
      }

    },
    methods: {
        log(event) {
            this.event = event;
            if(this.url){
                this.$splade.request(this.url, 'post', {
                    all: this.main,
                    orderBy: this.orderBy
                }, {
                    'x-splade-preserve-scroll': true
                })
            }
        },
    },
    render(){
        return this.$slots.default({
            options: this.options,
            main: this.main,
            event: this.event,
            log: this.log,
        });
    }
};



</script>
