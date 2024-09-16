<template>
    <div class="bg-gray-800 h-full">
        <div v-show="brMenu" class="fixed bg-gray-900 h-full w-1/3 max-w-80">
            <a class="bg-slate-300 w-40 block mx-auto my-4" v-if="authUser.role !== 'player'" :href="route('profile.show')">Auth : {{ authUser.name }}</a>
            <span class="bg-slate-300 w-40 block mx-auto my-4">Looking at : {{ upUser.name }}</span>
            <li v-for="(character, index) in upUser.characters">
                <ul class="bg-slate-300 w-40 block mx-auto my-4"><button @click="updateActualChar(index)">{{ character.name }}</button></ul>
            </li>
            <button @click="openCharacterAdd" v-if="authUser.role === 'player'">Add Character</button>
            <button class="bg-slate-300 w-40 block mx-auto my-4" @click="logout">disconnect</button>
        </div>
        <character-show :character="upUser.characters[actualChar]" :toggle-br-menu="toggleBrMenu" :auth-role="authUser.role"></character-show>
        <character-add v-if="characterAdd === true && authUser.role === 'player'" :auth-role="authUser.role" :auth-id="authUser.id" :close-character-add="closeCharacterAdd"></character-add>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import CharacterShow from '../Components/Custom/CharacterShow.vue';
import CharacterAdd from '../Components/Custom/CharacterAdd.vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

export default {
    setup(props) {
        const brMenu = ref(false);
        const actualChar = ref(0);
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
