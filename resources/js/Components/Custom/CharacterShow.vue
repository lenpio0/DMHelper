<!-- CharacterShow.vue -->
<template>
    <div>
        <h1>{{ character.name }}</h1>
        <item-list v-if="actualTab === 'items'" :items="character.items"></item-list>
        <spell-list v-if="actualTab === 'items'" :spells="character.spells"></spell-list>
        <buff-list v-if="actualTab === 'charinfos'" :buffs="character.buffs"></buff-list>
        <char-info-list v-if="actualTab === 'charinfos'" :char_infos="character.char_infos" :char_id="character.id"></char-info-list>
        <char-note-list v-if="actualTab === 'charinfos'" :char_notes="character.char_notes" :char_id="character.id"></char-note-list>
        <table-list v-if="actualTab === 'tables'" :tables="character.tables"></table-list>
        <button @click="toggleUserBrMenu" class="w-full">menu</button>
        <button @click="goToItems" class="w-full">Items Spells</button>
        <button @click="goToCharInfos" class="w-full">Char Info</button>
        <button @click="goToTables" class="w-full">Tables</button>
    </div>
</template>
  
<script>
import { ref } from 'vue';
import ItemList from './ItemList.vue';
import SpellList from './SpellList.vue';
import BuffList from './BuffList.vue';
import CharInfoList from './CharInfoList.vue';
import CharNoteList from './CharNoteList.vue';
import TableList from './TableList.vue';

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
        ItemList,
        SpellList,
        BuffList,
        CharInfoList,
        CharNoteList,
        TableList
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