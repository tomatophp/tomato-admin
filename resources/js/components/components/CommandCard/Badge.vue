<template>
<div class="flex items-center text-xs">

  <div class="px-2 py-1 transition duration-200 ease-in-out ltr:rounded-l-md rtl:rounded-r-md" :class="{'bg-zinc-100 text-zinc-500 dark:bg-zinc-700 dark:text-zinc-100': !active, 'bg-red-50 text-red-500': active}">
    {{ name }}
  </div>

  <div class="px-2 py-1 transition duration-200 ease-in-out ltr:rounded-r-md rtl:rounded-l-md" :class="{'bg-zinc-200 text-zinc-600 dark:bg-zinc-600 dark:text-zinc-200': !active, 'bg-red-100 text-red-600': active}">
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
