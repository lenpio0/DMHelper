<!-- CharacterShow.vue -->
<template>
    <div class="pt-8">
        <h1 class="bg-white w-36 m-auto">{{ character.name }}</h1>
        <item-list v-if="actualTab === 'items'" :auth-role="authRole" :items="character.items" :char_id="character.id"></item-list>
        <spell-list v-if="actualTab === 'items'" :auth-role="authRole" :spells="character.spells" :char_id="character.id"></spell-list>
        <buff-list v-if="actualTab === 'charinfos'" :auth-role="authRole" :buffs="character.buffs" :char_id="character.id"></buff-list>
        <char-info-list v-if="actualTab === 'charinfos'" :auth-role="authRole" :char_infos="character.char_infos" :char_id="character.id"></char-info-list>
        <char-note-list v-if="actualTab === 'charinfos'" :char_notes="character.char_notes" :char_id="character.id"></char-note-list>
        <table-list v-if="actualTab === 'tables'" :auth-role="authRole" :auth-id="authId" :tables="character.tables" :char_id="character.id"></table-list>
        <character-list v-if="actualTab === 'chars' && authRole !== 'player'"></character-list>
        <div class="fixed bottom-12 z-10 w-80 flex left-1/2 transform -translate-x-1/2 bg-slate-400">
            <button @click="toggleUserBrMenu" class="w-full border">menu</button>
            <button @click="goToItems" class="w-full border">Items Spells</button>
            <button @click="goToCharInfos" class="w-full border">Char Info</button>
            <button @click="goToTables" class="w-full border">Tables</button>
            <button v-if="authRole !== 'player'" @click="goToChars" class="w-full border">Characters</button>
            <div>
                <button @click="minusHp">-</button>
                <span>{{ character.act_health }}/{{ character.max_health }}</span>
                <button @click="plusHp">+</button>
            </div>
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
import CharacterList from './CharacterList.vue';

export default {
    setup(props) {
        const actualTab = ref(['charinfos', 'tables', 'chars'].includes(props.initialTab) ? props.initialTab : 'items');
    
        const goToItems = () => {
            actualTab.value = 'items';
        };
        const goToCharInfos = () => {
            actualTab.value = 'charinfos';
        };
        const goToTables = () => {
            actualTab.value = 'tables';
        };
        const goToChars = () => {
            actualTab.value = 'chars';
        };

        return {
            actualTab,
            goToItems,
            goToCharInfos,
            goToTables,
            goToChars
        };
    },
    components: {
        ItemList,
        SpellList,
        BuffList,
        CharInfoList,
        CharNoteList,
        TableList,
        CharacterList
    },
    props: {
        character: {
            default: () => []
        },
        authRole:{
             default: () => []
        },
        authId:{
             default: () => []
        },
        toggleBrMenu: Function,
        initialTab: String,
    },
    methods: {
        toggleUserBrMenu() {
            this.toggleBrMenu();
        },
        minusHp() {
            if (this.character.act_health > 0) {
                this.character.act_health--;
                this.updateHealth();
            }
        },
        plusHp() {
            if (this.character.act_health < this.character.max_health) {
                this.character.act_health++;
                this.updateHealth();
            }
        },
        updateHealth() {
        const character = this.character;
        axios.patch(`/characters/${character.id}/update-health`, {
            act_health: character.act_health,
            max_health: character.max_health
        })
        .then(response => {
            console.log(response.data.message);
        })
        .catch(error => {
            console.error('Error updating health:', error);
        });
    },
    },
}
</script>