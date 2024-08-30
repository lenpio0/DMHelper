<!-- CharacterShow.vue -->
<template>
    <div class="pt-8">
        <h1 class="bg-white w-36 m-auto">{{ character.name }}</h1>
        <item-list v-if="actualTab === 'items'" :items="character.items" :char_id="character.id"></item-list>
        <spell-list v-if="actualTab === 'items'" :spells="character.spells" :char_id="character.id"></spell-list>
        <buff-list v-if="actualTab === 'charinfos'" :buffs="character.buffs" :char_id="character.id"></buff-list>
        <char-info-list v-if="actualTab === 'charinfos'" :char_infos="character.char_infos" :char_id="character.id"></char-info-list>
        <char-note-list v-if="actualTab === 'charinfos'" :char_notes="character.char_notes" :char_id="character.id"></char-note-list>
        <table-list v-if="actualTab === 'tables'" :tables="character.tables"></table-list>
        <div class="fixed bottom-12 z-10 w-80 flex left-1/2 transform -translate-x-1/2 bg-slate-400">
            <button @click="toggleUserBrMenu" class="w-full border">menu</button>
            <button @click="goToItems" class="w-full border">Items Spells</button>
            <button @click="goToCharInfos" class="w-full border">Char Info</button>
            <button @click="goToTables" class="w-full border">Tables</button>
        </div>
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