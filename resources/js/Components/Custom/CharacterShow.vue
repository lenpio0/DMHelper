<!-- CharacterShow.vue -->
<template>
    <div>
      <h1>{{ character.name }}</h1>
      <buff-list :buffs="character.buffs"></buff-list>
      <button @click="toggleUserBrMenu" class="w-full">menu</button>
    </div>
</template>
  
<script>
    import { ref } from 'vue';
    import BuffList from './BuffList.vue';

    export default {
        components: {
            BuffList 
        },
        props: {
            character: {
                default: () => []
            },
            toggleBrMenu: Function,
        },
        methods: {
            toggleUserBrMenu() {
                this.toggleBrMenu();
            },
        },
    }
</script>