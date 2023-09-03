<template>
  <div class="flex items-center py-6">
    <div class="w-full relative">
      <input type="text" class="focus:outline-none ring-primary-500 focus:ring-2 focus:ring-opacity-50 focus:bg-white w-full bg-gray-200 px-5 pr-12 py-3 rounded-lg transition ease-in-out duration-200" placeholder="Search..." @input="$emit('search', search)" v-model="search">

      <button v-if="search !== ''" class="absolute top-0 right-0 flex items-center justify-center h-full px-4 cursor-pointer" @click="clear">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 h-4" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

    </div>
  </div>
</template>

<script>
export default {
  props: ['home'],
  data() {
    return {
      search: ''
    }
  },
  methods: {
    clear() {
      this.search = '';
      this.$emit('search', '')
    }
  }
}
</script>

<style scoped>

</style>
