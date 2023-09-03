<template>
  <div class="w-full antialiased" :class="{'overflow-y-auto': selectedCommand == null, 'overflow-hidden': selectedCommand != null}">
    <div>

      <div class="container mx-auto">
        <top-bar @search="onSearch" :home="$attrs.route+'/admin/artisan'"/>

        <div v-for="(group, key) in filteredGroups" :key="group.name">
          <group @select="onSelect" :name="key" :commands="group"/>
        </div>

      </div>
    </div>

<!-- Overlay -->
    <transition
        enter-active-class="transition-all duration-300 ease-out-quad"
        leave-active-class="transition-all ease-in-quad duration-50"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
    >
      <div v-if="selectedCommand != null || loading" @click="selectedCommand = null" class="fixed top-0 left-0 w-full h-full" :class="{'cursor-pointer': selectedCommand != null}">
        <div class="w-full h-full bg-black opacity-20"></div>
      </div>
    </transition>
<!-- Sidebar  -->
    <transition
        enter-active-class="transition-all duration-300 ease-out-quad"
        leave-active-class="transition-all ease-in-quad duration-50"
        enter-class="transform translate-x-full"
        enter-to-class="transform translate-x-0"
        leave-class="transform translate-x-0"
        leave-to-class="transform translate-x-full"
    >
      <div v-if="selectedCommand != null" class="fixed top-0 right-0 w-full h-full max-w-lg overflow-x-hidden overflow-y-auto bg-white">
        <command-sidebar :old="old" :errors="errors" @run="runCommand" @close="selectedCommand = null" :command="selectedCommand" />
      </div>

    </transition>
<!-- Loading spinner -->
    <transition
        enter-active-class="transition-all duration-300 ease-out-quad"
        leave-active-class="transition-all ease-in-quad duration-50"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
    >
    <div v-if="loading" class="fixed top-0 left-0 flex items-center justify-center w-full h-full text-primary-500">
      <div class="w-8 h-8 text-primary-500 animate-spin">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-full h-full" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
      </div>
    </div>
    </transition>

    <transition
        enter-active-class="transition-all duration-300 ease-out-quad"
        leave-active-class="transition-all ease-in-quad duration-50"
        enter-class="transform translate-y-full"
        enter-to-class="transform translate-y-0"
        leave-class="transform translate-y-0"
        leave-to-class="transform translate-y-full"
    >
    <div v-if="output != null" class="fixed bottom-0 left-0 w-full mb-6">

      <div @click="output = null" class="container px-4 mx-auto overflow-hidden cursor-pointer rounded-2xl md:px-0">
        <command-output :command="output.command" :status="output.status" :output="output.output.replaceAll('\n', '<br />')" />
      </div>

    </div>
    </transition>

  </div>

</template>

<script>
import TopBar from "./components/TopBar.vue";
import Group from "./components/Group.vue";
import CommandSidebar from "./components/CommandSidebar.vue";
import Output from "./components/CommandOutput.vue";
import CommandOutput from "./components/CommandOutput.vue";

export default {
  components: {CommandOutput, CommandSidebar, Group, TopBar},
  data() {
    return {
      groups: [],
      loading: false,
      selectedCommand: null,
      search: '',
      errors: [],
      old: null,
      output: null
    }
  },
  created() {
    this.fetchGroups();
  },
  computed: {
    filteredGroups() {

      if (this.search === '')
        return this.groups;

      let res = {};

      for (let key of Object.keys(this.groups ?? {})) {
        let group = this.groups[key];

        if (key.toLowerCase().includes(this.search.toLowerCase())) {
          res[key] = group;
          continue;
        }

        let tmpGroup = [];

        for (let command of group) {

          if (command.name.toLowerCase().includes(this.search.toLowerCase())) {
            tmpGroup.push(command);
          }

        }

        if (tmpGroup.length > 0)
          res[key] = tmpGroup;

      }

      return res;
    },
    commands(){
        return this.$attrs.commands;
    }
  },
  methods: {
    reload(){
        this.$splade.get(this.$attrs.route+'/admin/artisan');
    },
    fetchGroups() {
        this.groups = this.commands;
    },
    onSelect(command) {
      this.errors = [];
      this.old = null;

      if (command.arguments == null && command.options == null)
        this.runCommand(command)
      else
        this.selectedCommand = command;

    },
    runCommand(command, formData) {
      this.loading = true;
      Object.assign(command, formData);
      axios.post(this.$attrs.route+'/admin/artisan/run',command).then(response => {
            this.output = response.data;
            this.loading = false;
      })

    },
    onSearch(search) {
      this.search = search
    }
  }
}
</script>
