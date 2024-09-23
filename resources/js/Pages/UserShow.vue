<template>
    <div class="bg-gray-800 h-full">
        <div v-show="brMenu" class="fixed bg-gray-900 h-full w-1/3 max-w-80">
            <div class="bg-slate-300 w-40 block mx-auto my-4"><span v-if="authUser.role !== 'player'">Auth :</span><a :href="route('profile.show')">{{ authUser.name }}</a></div>
            <span class="bg-slate-300 w-40 block mx-auto my-4" v-if="authUser.role !== 'player'">Looking at : {{ actualChar }}</span>
            <li v-for="(character, index) in upUser.characters">
                <ul class="bg-slate-300 w-40 block mx-auto my-4"><button @click="updateActualChar(index)">{{ character.name }}</button></ul>
            </li>
            <button class="bg-slate-300 w-40 block mx-auto my-4" @click="openCharacterAdd" v-if="authUser.role === 'player'">Add Character</button>
            <button class="bg-slate-300 w-40 block mx-auto my-4" @click="logout">disconnect</button>
            <input type="checkbox" v-model="isDmRole" @change="updateRole">
        </div>
        <character-show :character="upUser.characters[actualChar]" :toggle-br-menu="toggleBrMenu" :auth-role="authUser.role" :auth-id="authUser.id" :initial-tab="flash.tab"></character-show>
        <character-add v-if="characterAdd === true && authUser.role === 'player'" :auth-role="authUser.role" :auth-id="authUser.id" :close-character-add="closeCharacterAdd"></character-add>
    </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import CharacterShow from '../Components/Custom/CharacterShow.vue';
import CharacterAdd from '../Components/Custom/CharacterAdd.vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/vue3';

export default {
    setup(props) {
        const flash = usePage().props.flash ||  {};

        const brMenu = ref(false);
        const actualChar = ref(typeof flash.tab === 'number' ? flash.tab : 0);
        let upUser = props.user;

        const toggleBrMenu = () => {
            brMenu.value = !brMenu.value;
        };

        const updateActualChar = (index) => {
            actualChar.value = index;
            brMenu.value = false;
        }

        const characterAdd = ref(false);

        const openCharacterAdd = () => {
            characterAdd.value = true;
        }
        const closeCharacterAdd = () => {
            characterAdd.value = false;
        }

        // Use a data property instead of computed for role handling
        const isDmRole = ref(props.authUser.role === 'dm');

        // Watch for changes in the checkbox and update the role
        watch(isDmRole, (newValue) => {
            const newRole = newValue ? 'dm' : 'player';  // toggle between 'dm' and 'player'

            axios.patch(`/users/${props.authUser.id}/role`, { role: newRole })
                .then(response => {
                    // Update the authUser role after successful change
                    props.authUser.role = newRole;
                })
                .catch(error => {
                    console.error('Error updating role:', error);
                });
        });

        const checkUpdate = () => {
            axios.get('/check/' + upUser.id)
                .then(response => {
                    console.dir(response.data.upuser);
                    Object.assign(upUser, response.data.upuser);
                    console.dir(upUser);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        };

        onMounted(() => {
            setInterval(checkUpdate, 5000);
        });

        return {
            brMenu,
            actualChar,
            upUser,
            toggleBrMenu,
            updateActualChar,
            characterAdd,
            openCharacterAdd,
            closeCharacterAdd,
            flash,
            isDmRole
        };
    },
    
    components: {
        CharacterShow,
        CharacterAdd,
    },
    props: {
        user: Object,
        authUser: Object,
    },
    methods: {
        logout() {
          Inertia.post(route('logout'), {}, {
            onFinish: () => {
                return redirect('/')
            }
          });
        },
    }
}
</script>
