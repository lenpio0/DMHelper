<!-- CharacterShow.vue -->
<template>
    <div>
      <h1>{{ character.name }}</h1>
      <buff-list v-if="actualTab === 'charinfos'" :buffs="character.buffs"></buff-list>
      <button @click="toggleUserBrMenu" class="w-full">menu</button>
      <button @click="goToItems" class="w-full">Items Spells</button>
      <button @click="goToCharInfos" class="w-full">Char Info</button>
      <button @click="goToTables" class="w-full">Tables</button>
    </div>
</template>
  
<script>
    import { ref } from 'vue';
    import BuffList from './BuffList.vue';

    export default {
        setup() {
            const actualTab = ref('items');

            const goToItems = () => {
                actualTab.value = 'items';
            };
            const goToCharInfos = () => {
                actualTab.value = 'charinfos';
            };
            const goToTables = () => {
                actualTab.value = 'tables';
            };
            
            return {
                actualTab,
                goToItems,
                goToCharInfos,
                goToTables
            };
        },
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