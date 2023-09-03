<template>
  <div class="h-full">
    <div v-if="!command.error" @click="onClick"  class="flex flex-col h-full px-8 transition duration-200 ease-in-out bg-white border cursor-pointer hover:border-primary-600 py-7 rounded-xl">

      <div class="mb-4 text-xl transition duration-200 ease-in-out" :class="{'text-gray-700': !active, 'text-red-500': active}">
        {{ command.name }}
      </div>

      <div class="text-gray-500" :class="{'mb-7': command.arguments != null || command.options != null}">
        {{ command.description }}
      </div>

      <div  class="flex items-center justify-end mt-auto">

        <badge v-if="command.arguments != null" name="Arguments" :count="Object.keys(command.arguments).length" :active="active" />

        <div v-if="command.options != null" class="ml-2">
          <badge name="Options" :count="Object.keys(command.options).length" :active="active" />
        </div>

      </div>

    </div>

    <div v-else class="relative h-full px-8 overflow-hidden bg-gray-200 py-7 rounded-xl">

      <div class="absolute mb-6 text-gray-300 opacity-50 w-80 h-80 -top-20 -left-20">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>

      <div class="relative mb-4 text-xl">

        <div class="flex items-center mb-4">
          <div class="w-2 h-2 mt-1 mr-3 bg-red-500 rounded-full">
          </div>
          <div>
            {{ command.name }}
          </div>
        </div>

        <div class="text-gray-500">{{ command.error }}</div>

      </div>
    </div>

  </div>
</template>

<script>
import Badge from "./CommandCard/Badge.vue";
export default {
  components: {Badge},
  props: ['command'],
  data() {
    return {
      hover: false,
    }
  },
  computed: {
    active() {
      return this.hover;
    }
  },
  methods: {
    onClick() {
      this.$emit('select');
    }
  }
}
</script>

<style scoped>

</style>
