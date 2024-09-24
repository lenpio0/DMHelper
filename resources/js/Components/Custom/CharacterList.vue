<template>
    <div class="p-8">
        <h2 class='bg-slate-500 w-36 m-auto'>Characters</h2>
        <ul>
            <!-- Loop through the sorted characters -->
            <li v-for="(character, index) in characters" :key="character.id" :class="{'bg-slate-700': index % 2 === 0,'bg-slate-800': index % 2 !== 0}" class="p-3">
                <span>{{ character.name }}</span>
                <span class="block underline mb-2">{{ character.max_health }} Max HP</span>
                <span class="block underline mb-2">{{ character.act_health }} HP</span>
                <span class="block underline mb-2" v-if="users[character.user_id]">{{ users[character.user_id].name }}</span>
                
                <!-- Conditionally display buttons based on table check -->
                <div v-if="checkTables(character.tables) || authRole == 'admin'">
                    <button @click="openCharacterEdit(character)" class="border"> edit </button>
                    <button @click="deleteCharacter(character.id)" class="border border-red-600 mx-2"> x </button>
                    <button @click="goToChar(character.index, character.user_id)">Go to char</button>
                </div>
            </li>
        </ul>
    </div>

    <!-- Character Edit Modal -->
    <character-edit v-if="characterEdit === true" :character="selectedCharacter" :close-character-edit="closeCharacterEdit"></character-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import CharacterEdit from './CharacterEdit.vue';

export default {
    props: {
        authId: {
            type: Number, // Ensure authId is a number
            required: true,
        },
        authRole: {}
    },
    setup(props) {
        const characterEdit = ref(false);
        const selectedCharacter = ref(null);

        const openCharacterEdit = (character) => {
            characterEdit.value = true;
            selectedCharacter.value = character;
        };

        const closeCharacterEdit = () => {
            characterEdit.value = false;
            selectedCharacter.value = null;
        };

        // Function to check if any table's user_id matches the authId
        const checkTables = (tables) => {
            return tables.some(table => table.user_id === props.authId);
        };

        return {
            characterEdit,
            selectedCharacter,
            openCharacterEdit,
            closeCharacterEdit,
            checkTables,
        };
    },
    components: {
        CharacterEdit,
    },
    methods: {
        deleteCharacter(char_id) {
            Inertia.post(route('action.handle'), {
                char_id: char_id,
                action: 'del-character',
            });
        },
        fetchCharacters() {
            axios.get('/api/characters')
                .then((response) => {
                    this.characters = response.data; // Assuming response contains the list of characters
                    this.sortCharacters(); // Call the sorting method after fetching characters
                })
                .catch((error) => {
                    console.error('Error fetching characters:', error);
                });
        },
        fetchUsers() {
            axios.get('/api/users')
                .then((response) => {
                    const usersArray = response.data;
                    const allCharacters = [];

                    // Process each user
                    usersArray.forEach((user) => {
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
                    this.sortCharacters(); // Call the sorting method after fetching users and characters
                })
                .catch((error) => {
                    console.error('Error fetching users:', error);
                });
        },
        sortCharacters() {
            // Sort characters based on whether they can be edited by the authenticated user
            this.characters.sort((a, b) => {
                const aEditable = this.checkTables(a.tables);
                const bEditable = this.checkTables(b.tables);

                // Editable characters should come first
                if (aEditable && !bEditable) return -1;
                if (!aEditable && bEditable) return 1;
                return 0;
            });
        },
        goToChar(index, userId) {
            Inertia.get(`/go-to-char/${index}/${userId}`);
        },
    },
    data() {
        return {
            characters: [], // Initialize characters array
            users: [], // Initialize users array
        };
    },
    mounted() {
        this.fetchCharacters(); // Fetch characters when component is mounted
        this.fetchUsers(); // Fetch users when component is mounted
    },
};
</script>
