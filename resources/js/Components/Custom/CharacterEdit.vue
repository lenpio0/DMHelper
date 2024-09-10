<!-- CharacterEdit.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editCharacter" class="bg-blue-400 flex flex-col p-2">
                <select v-model="user_id">
                    <option v-for="user in users" :key="user.id" :value="user.id">
                        {{ user.name }}
                    </option>
                </select> 
                <input v-model="name" :placeholder=character.name required class="m-2">
                <input v-model="health" :placeholder="character.max_health" required class="m-2">
                <div class="flex justify-between">
                    <button @click="closeCharacterEdit" class="bg-red-400">Close</button>
                    <button type="submit" class="bg-blue-200">Edit</button>
                </div>
            </form>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        character: {
            type: Object,
            default: () => ({})
        },
        closeCharacterEdit: Function,
    },
    methods: {
        closeCharacterEdit() {
            this.closeCharacterEdit();
        },
        editCharacter() {
            Inertia.post(route('action.handle'), {
                character_id: this.character.id,
                name: this.name,
                max_health: this.health,
                act_health: this.health,
                user_id: this.user_id,
                char_id: this.character.id,
                action: 'edit-character'
            });
        },
        fetchUsers() {
            axios.get('/api/users') 
                .then(response => {
                    this.users = response.data;  // Assuming response contains the list of users
                })
                .catch(error => {
                    console.error('Error fetching users:', error);
                });
        }
    },
    data() {
        return {
            name: this.character.name || '',
            health: this.character.max_health || '',
            user_id: this.character.user_id || '',
            users: [],

        }
    },
    mounted() {
        this.fetchUsers();  // Fetch characters when component is mounted
    },  
}
</script>