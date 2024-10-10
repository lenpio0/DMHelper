<!-- TableAdd.vue -->
<template>
    <div class="z-50 fixed backdrop-blur-sm top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div class="w-80 sm:w-[24rem]">
            <h2 class='text-white bg-soft-black-3 w-56 pt-2 pb-1.5 m-auto rounded-t-lg text-center text-xl font-bold font-albert'>Add Table</h2>
            <form @submit.prevent="addTable" class="bg-soft-black-2 flex flex-col px-2 py-4 rounded-3xl">
                <input v-model="name" placeholder="Table name..." required class="m-3 rounded-3xl text-black">
                <span class="font-bold ml-3 mt-3 mb-2 text-lg w-1/2">Characters</span>
                <div class="grid grid-cols-2">
                    <!-- Iterate over the selectedCharacters array to render multiple selects -->
                    <div v-for="(selectedCharacter, index) in selectedCharacters" :key="index" class="mb-2 mx-auto w-full">
                        <select v-model="selectedCharacters[index]" @change="handleCharacterChange(index)" class="rounded-3xl text-black text-sm block mx-auto my-1">
                            <option value=""></option>
                            <option v-for="character in characters" :key="character.id" :value="character.id">
                                {{ character.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-around pb-2 pt-4">
                    <button @click="closeTableAdd" class="bg-red-600 box-content border-b-4 border-red-800 font-medium rounded-lg text-sm w-14 h-9 justify-center px-1 text-center inline-flex left-[2.1rem] items-center">
						<svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
						</svg>
                    </button>
                    <button type="submit" class="text-black border-soft-white-3 bg-soft-white-1 border-b-4 box-content font-medium rounded-lg text-sm w-16 h-9 justify-center px-1 text-center inline-flex items-center">
                        Add
                    </button>
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
        closeTableAdd: Function,
        authId: {
            default: () => []
        },
    },
    data() {
        return {
            name: '',
            selectedCharacters: [''], // Initialize with one empty selection
            characters: [],  // Initialize characters array
        };
    },
    methods: {
        closeTableAdd() {
            this.closeTableAdd();
        },
        addTable() {
            const uniqueCharIds = [...new Set(this.selectedCharacters.filter(char => char !== ''))];
            Inertia.post(route('action.handle'), {
                name: this.name,
                char_ids: uniqueCharIds,
                user_id: this.authId,
                action: 'add-table'
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
        }
    },
    mounted() {
        this.fetchCharacters();  // Fetch characters when component is mounted
    },  
}
</script>