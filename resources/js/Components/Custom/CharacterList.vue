<!-- CharacterList.vue -->
<template>
    <div class="p-8">
        <h2 class='bg-slate-500 w-36 m-auto'>Characters</h2>
        <ul>
            <li v-for="(character, index) in characters" :key="character.id" :class="{'bg-slate-700': index % 2 === 0,'bg-slate-800': index % 2 !== 0}" class="p-3">
                <a class="block" @click="goToChar(character.index, character.user_id)">{{ character.name }}</a>
                <span class="block underline mb-2">{{ character.max_health }} Max HP</span>
                <span class="block underline mb-2">{{ character.act_health }} HP</span>
                <span class="block underline mb-2" v-if="users[character.user_id]">{{ users[character.user_id].name }}</span>
                <button @click="openCharacterEdit(character)" class="border"> edit </button>
                <button @click="deleteCharacter(character.id)" class="border border-red-600 mx-2"> x </button>
            </li>
            <li class="bg-slate-600">
                <button @click="openCharacterAdd">Add Character</button>
            </li>
        </ul>
    </div>
    <character-add v-if="characterAdd === true" :close-character-add="closeCharacterAdd"></character-add>
    <character-edit v-if="characterEdit === true" :character="selectedCharacter" :close-character-edit="closeCharacterEdit"></character-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import CharacterAdd from './CharacterAdd.vue';
import CharacterEdit from './CharacterEdit.vue';

export default {
    setup() {
        const characterAdd = ref(false);

        const openCharacterAdd = () => {
            characterAdd.value = true;
        }
        const closeCharacterAdd = () => {
            characterAdd.value = false;
        }

        const characterEdit = ref(false);
        const selectedCharacter = ref(null);

        const openCharacterEdit = (character) => {
            characterEdit.value = true;
            selectedCharacter.value = character
        }
        const closeCharacterEdit = () => {
            characterEdit.value = false;
            selectedCharacter.value = null;
        }


        return {
            characterAdd,
            openCharacterAdd,
            closeCharacterAdd,
            characterEdit,
            selectedCharacter,
            openCharacterEdit,
            closeCharacterEdit,
        }
    },
    components: {
        CharacterAdd,
        CharacterEdit,
    },
    methods: {
        deleteCharacter(char_id) {
            Inertia.post(route('action.handle'), {
                char_id: char_id,
                action: 'del-character'
            });
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
        fetchUsers() {
        axios.get('/api/users')
            .then(response => {
                const usersArray = response.data;
                const allCharacters = [];

                // Process each user
                usersArray.forEach(user => {
                    // Assign index to each character and add to allCharacters
                    user.characters.forEach((character, index) => {
                        character.index = index; // Assign the index to each character
                        allCharacters.push(character);
                    });
                    // Map user by id
                    this.users[user.id] = user;
                });

                // Set all characters to the characters array
                this.characters = allCharacters;
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    },        
    goToChar(index, userId) {
        Inertia.get(`/go-to-char/${index}/${userId}`);
    },
},
    data() {
        return {
            characters: [],  // Initialize characters array
            users: [],
        };
    },
    mounted() {
        this.fetchCharacters();  // Fetch characters when component is mounted
        this.fetchUsers();  // Fetch characters when component is mounted 
    },  
}
</script>