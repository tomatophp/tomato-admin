<template>
  <div class="mt-6 mb-10">
    <div class="mb-6 text-3xl text-zinc-400 dark:text-zinc-200">
      {{ name }}
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-2">
      <command-card @select="$emit('select', command)" :command="command" v-for="command in commands" :key="command.name" />
    </div>

  </div>
</template>

<script>
import CommandCard from "./CommandCard.vue";

export default {
  components: {CommandCard},
  props: ['name', 'commands']
}
</script>
