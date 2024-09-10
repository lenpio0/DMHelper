<!-- CharacterAdd.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div> {{ users }}
            <form @submit.prevent="addCharacter" class="bg-blue-400 flex flex-col p-2">
                <select v-model="user_id">
                    <option value="" disabled></option>
                    <option v-for="user in users" :key="user.id" :value="user.id">
                        {{ user.name }}
                    </option>
                </select> 
                <input v-model="name" placeholder="Enter your name..." required class="m-2">
                <input v-model="health" placeholder="Enter your health points..." required class="m-2">
                <div class="flex justify-between">
                    <button @click="closeCharacterAdd" class="bg-red-400">Close</button>
                    <button type="submit" class="bg-blue-200">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        closeCharacterAdd: Function,
    },
    methods: {
        closeCharacterAdd() {
            this.closeCharacterAdd();
        },
        addCharacter() {
            Inertia.post(route('action.handle'), {
                name: this.name,
                max_health: this.health,
                act_health: this.health,
                user_id: this.user_id,
                action: 'add-character'
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
            name: '',
            health: '',
            user_id: '',
            users: [],
        }
    },
    mounted() {
        this.fetchUsers();  // Fetch characters when component is mounted
    },  
}
</script>