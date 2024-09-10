<!-- TableEdit.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editTable" class="bg-blue-400 flex flex-col p-2">
                <input v-model="name" required class="m-2"></input>
  <!-- Iterate over the selectedCharacters array to render multiple selects -->
  <div v-for="(selectedCharacter, index) in selectedCharacters" :key="index" class="mb-2">
                    <select v-model="selectedCharacters[index]" @change="handleCharacterChange(index)">
                        <option value=""></option>
                        <option v-for="character in characters" :key="character.id" :value="character.id">
                            {{ character.name }}
                        </option>
                    </select>
                </div>
                <div class="flex justify-between">
                    <button @click="closeTableEdit" class="bg-red-400">Close</button>
                    <button type="submit" class="bg-blue-200">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    props: {
        table: {
            default: null
        },
        closeTableEdit: Function,
    },
    data() {
        return {
            name: this.table.name || '',
            selectedCharacters: [''], // Initialize with one empty selection
            characters: [],  // Initialize characters array
        };
    },
    methods: {
        closeTableEdit() {
            this.closeTableEdit();
        },
        editTable() {
            const uniqueCharIds = [...new Set(this.selectedCharacters.filter(char => char !== ''))];
            Inertia.post(route('action.handle'), {
                table_id: this.table.id,
                name: this.name,
                char_ids: uniqueCharIds,
                action: 'edit-table'
            });
        },
        handleCharacterChange(index) {
            
            // If the current dropdown is not empty and it's the last one, add a new one
            if (this.selectedCharacters[index] !== '' && index === this.selectedCharacters.length - 1 && this.selectedCharacters.length < 6) {
                this.selectedCharacters.push('');
            }

            // If the current dropdown is empty, remove all subsequent dropdowns
            if (this.selectedCharacters[index] === '' && index !== this.selectedCharacters.length - 1) {
                this.selectedCharacters = this.selectedCharacters.slice(0, index + 1);
            }
        },
        fetchCharacters() {
            axios.get('/api/characters') 
                .then(response => {
                    this.characters = response.data;  // Assuming response contains the list of characters
                })
                .catch(error => {
                    console.error('Error fetching characters:', error);
                });
        },
        fillCharacters() {
            // Populate selectedCharacters with the characters already assigned to the table
            this.selectedCharacters = this.table.characters.map(character => character.id);
            if (this.selectedCharacters.length < 6) {
                // Ensure there is at least one empty dropdown for additional selections
                this.selectedCharacters.push('');
            }
        }
    },
    mounted() {
        this.fetchCharacters();  // Fetch characters when component is mounted
        this.fillCharacters();
    },  
}
</script>