<template>
    <div class="my-8">
        <h2 class='bg-soft-black-3 w-56 py-1 m-auto rounded-t-lg text-center text-xl font-bold'>Characters</h2>
        <ul>
            <!-- Loop through the sorted characters -->
            <li v-for="(character, index) in characters" :key="character.id" class="p-3 pt-4 my-2 bg-soft-black-2">
				<div class="flex justify-between">
                    <div class="flex w-5/6 justify-between border-b border-soft-white-1/25">
                        <div class="flex">                            
                            <span class="block pr-2">{{ character.max_health }}</span>
                            <span class="block text-xl">{{  character.name }}</span>
                        </div>
                        <button v-if="checkTables(character.tables) || authRole == 'admin'" @click="goToChar(character.index, character.user_id)" class="text-white bg-gray-500 border-b-4 border-gray-700 w-8 h-8 flex justify-center items-center font-medium rounded-lg text-sm py-1 relative bottom-1 text-center me-2">
                        <svg class="" width="24px" height="23px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.30147 15.5771C4.77832 14.2684 3.6904 12.7726 3.18002 12C3.6904 11.2274 4.77832 9.73158 6.30147 8.42294C7.87402 7.07185 9.81574 6 12 6C14.1843 6 16.1261 7.07185 17.6986 8.42294C19.2218 9.73158 20.3097 11.2274 20.8201 12C20.3097 12.7726 19.2218 14.2684 17.6986 15.5771C16.1261 16.9282 14.1843 18 12 18C9.81574 18 7.87402 16.9282 6.30147 15.5771ZM12 4C9.14754 4 6.75717 5.39462 4.99812 6.90595C3.23268 8.42276 2.00757 10.1376 1.46387 10.9698C1.05306 11.5985 1.05306 12.4015 1.46387 13.0302C2.00757 13.8624 3.23268 15.5772 4.99812 17.0941C6.75717 18.6054 9.14754 20 12 20C14.8525 20 17.2429 18.6054 19.002 17.0941C20.7674 15.5772 21.9925 13.8624 22.5362 13.0302C22.947 12.4015 22.947 11.5985 22.5362 10.9698C21.9925 10.1376 20.7674 8.42276 19.002 6.90595C17.2429 5.39462 14.8525 4 12 4ZM10 12C10 10.8954 10.8955 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8955 14 10 13.1046 10 12ZM12 8C9.7909 8 8.00004 9.79086 8.00004 12C8.00004 14.2091 9.7909 16 12 16C14.2092 16 16 14.2091 16 12C16 9.79086 14.2092 8 12 8Z" fill="#ffffff"/>
                        </svg>
                    </button>
                    </div>
                    <button v-if="checkTables(character.tables) || authRole == 'admin'" @click="deleteCharacter(character.id)" class="text-white bg-red-600 border-b-4 border-red-800 font-medium rounded-lg text-sm w-8 h-8 justify-center px-1 text-center inline-flex relative bottom-1 items-center me-2">
						<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
						</svg>
                    </button>
                </div>
                <div class="flex">
                    <div class="w-1/2">
                        <span class="block font-bold w-1/4 pl-1 border-b border-soft-white-1/25">Tables</span>
                        <ul class="">
                            <li v-for="table in character.tables" :key="table.id" class="pr-2">
                                <span>{{ table.name }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="w-1/2">
                        <span class="block font-bold w-1/4 px-1 border-b border-soft-white-1/25">Owner</span>
                        <span class="">{{ users[character.user_id].name }}</span>
                    </div>
                </div>


                <div v-if="checkTables(character.tables) || authRole == 'admin'">
                    <button @click="openCharacterEdit(character)" class="text-white bg-gray-500 border-b-4 border-gray-700 font-medium rounded-lg text-sm py-1 text-center inline-flex items-center me-2 absolute right-2 -mt-8">
                        <svg width="37px" height="27px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#FFFFFF"/>
					</svg>
                    </button>
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
            return Array.isArray(tables) && tables.some(table => table.user_id === props.authId);
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
