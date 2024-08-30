<template>
    <div class="bg-gray-800 h-full">
        <div v-show="brMenu" class="fixed bg-gray-900 h-full w-1/3 max-w-80">
            <span class="bg-slate-300 w-40 block mx-auto my-4">{{ upUser.name }}</span>
            <li v-for="(character, index) in upUser.characters">
                <ul class="bg-slate-300 w-40 block mx-auto my-4"><button @click="updateActualChar(index)">{{ character.name }}</button></ul>
            </li>
            <div class="bg-slate-300 w-40 block mx-auto my-4">settings</div>
            <span class="bg-slate-300 w-40 block mx-auto my-4">disconnect</span>
        </div>
        <character-show :character="upUser.characters[actualChar]" :toggle-br-menu="toggleBrMenu"></character-show>

        <!-- <p>DUMP : {{ user }}</p> -->
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import CharacterShow from '../Components/Custom/CharacterShow.vue';
import axios from 'axios';

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
            updateActualChar
        };
    },
    
    components: {
        CharacterShow
    },
    props: {
        user: Object,
    },
}
</script>
