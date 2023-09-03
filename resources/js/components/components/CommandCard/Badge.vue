<template>
<div class="flex items-center text-xs">

  <div class="px-2 py-1 transition duration-200 ease-in-out rounded-l-md" :class="{'bg-gray-100 text-gray-500': !active, 'bg-red-50 text-red-500': active}">
    {{ name }}
  </div>

  <div class="px-2 py-1 transition duration-200 ease-in-out rounded-r-md" :class="{'bg-gray-200 text-gray-600': !active, 'bg-red-100 text-red-600': active}">
    {{ count }}
  </div>

</div>
</template>

<script>
export default {
  props: ['name', 'count', 'active']
}
</script>

<style scoped>

</style>
