<template>
    <div class="bg-soft-black-1 min-h-screen">
        <div v-show="brMenu" class="fixed z-40 h-full w-full bg-black/50"></div>
        <div v-show="brMenu" class="fixed z-50 bg-soft-black-1 h-full w-1/3 min-w-56 max-w-[500px] flex flex-col justify-between">
            <div class="pt-4 h-full flex flex-col">
                <span class="bg-soft-black-3 w-40 block font-bold p-2 px-4 text-center mx-auto my-3 rounded-t-2xl rounded-b border-b-4 border-soft-black-2 text-soft-white-1"><span v-if="authUser.role === 'admin'">Auth :</span>{{ authUser.name }}</span>
                <span class="bg-slate-300 w-40 block mx-auto my-4" v-if="authUser.role === 'admin'">Looking at : {{ upUser.name }}</span>
                <a :href="route('profile.show')" class="bg-soft-white-1 w-40 block text-center mx-auto font-bold py-2 px-4 border-b-4 border-soft-white-2 rounded mb-8">See profile</a>
                <li v-for="(character, index) in upUser.characters" v-if="authUser.role !== 'dm'">
                    <ul class="bg-soft-white-1 w-40 block mx-auto text-center font-bold py-2 px-4 border-b-4 border-soft-white-2 rounded my-2">
                        <button @click="updateActualChar(index)">{{ character.name }}</button>
                    </ul>
                </li>
                <button class="bg-soft-white-1 w-40 mx-auto font-bold py-2 px-4 border-b-4 border-soft-white-2 rounded mt-8 flex" @click="openCharacterAdd" v-if="authUser.role === 'player'">
                    <svg class="relative top-[3px] right-1" width="21px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill="#000000" fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"/>
					</svg>
                    Add Character</button>
            </div>
            <div class="pb-12 h-1/2 flex flex-col justify-end">
                <label class="flex w-40 items-center cursor-pointer bg-soft-black-3 rounded py-2 px-4 border-b-4 border-soft-black-2 mx-auto">
                    <input type="checkbox" v-model="isDmRole" @change="updateRole" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-800"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">DM Mode</span>
                </label>
                <button class="bg-soft-white-1 w-40 block mx-auto font-bold py-2 px-4 border-b-4 border-soft-white-2 rounded my-4" @click="logout">Disconnect</button>
                <button class="bg-red-600 w-40 block mx-auto font-bold py-2 px-4 border-b-4 border-red-800 rounded-t rounded-b-2xl my-4 text-soft-white-1" @click="toggleBrMenu">Close</button>
            </div>
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
                    if (newRole === 'player' && props.authUser.id !== upUser.id) {
                        Inertia.get(route('user.show', { id: props.authUser.id }));
                    }
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
