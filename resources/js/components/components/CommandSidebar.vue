<template>
  <form ref="form" @submit.prevent="onSubmit" class="relative flex flex-col h-full pt-16">


    <div class="sticky top-0 px-6 py-4 bg-white">

      <div class="flex items-center justify-between mb-2">

        <div class="text-2xl">
          {{ command.name }}
        </div>

        <button @click="$emit('close')"
                class="flex items-center justify-center w-10 h-10 text-gray-500 transition duration-200 ease-in-out bg-white rounded-full focus:outline-none hover:shadow-xl hover:text-gray-800 hover:bg-gray-100">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 h-4" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

      </div>

      <div class="text-xs text-gray-400 pt-4" :class="{'mb-6': command.arguments != null}">
        {{ command.description }}
      </div>

      <div v-if="command.arguments != null">
        <div v-for="argument in command.arguments" :key="argument.name" class="mt-4">
          <argument-input
              v-model="form[argument.name]"
              :old="old ? (old[argument.name] ? old[argument.name] : null) : null"
              :error="errors ? (errors[argument.name] ? errors[argument.name][0] : null) : null"
              :argument="argument"
              :command="command"
          />
        </div>
      </div>

    </div>

    <div class="flex-1 px-6 py-5 bg-gray-50">

      <div v-if="command.options != null" class="-my-6">

        <div v-for="option in command.options" :key="option.name" class="my-6">
          <option-input
              v-model="form[option.name]"
              :old="old ? (old[option.name] ? old[option.name] : null) : null"
              :error="errors ? (errors[option.name] ? errors[option.name][0] : null) : null"
              :command="command"
              :option="option"
          />
        </div>

      </div>

    </div>

      <button class="sticky bottom-0 flex items-center justify-end px-8 py-6 text-xl tracking-widest text-white transition duration-200 ease-in-out bg-primary-500 hover:bg-primary-600 focus:outline-none">
        <span class="block mr-3">
          Run
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 h-4 mt-1" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
      </button>

  </form>
</template>

<script>
import ArgumentInput from "./Sidebar/ArgumentInput.vue";
import OptionInput from "./Sidebar/OptionInput.vue";
export default {
  components: {OptionInput, ArgumentInput},
  props: ['command', 'errors', 'old'],
  data() {
    return {
        form: {
        }
    }
  },
  mounted() {

  },
  methods: {
    onSubmit() {
      let res = {};

      this.$emit('run', this.command, this.form);
      this.$emit('close');
    },
  }
}
</script>
