<template>
    <div class="bg-gray-800 h-full">
        <div v-show="brMenu" class="fixed bg-gray-900 h-full">
            <span>{{ user.name }}</span>
            <li v-for="(character, index) in user.characters">
                <ul><button @click="updateActualChar(index)">{{ character.name }}</button></ul>
            </li>
            <span>settings</span>
            <span>disconnect</span>
        </div>
        <character-show :character="user.characters[actualChar]" :toggle-br-menu="toggleBrMenu"></character-show>

        <!-- <p>DUMP : {{ user }}</p> -->
    </div>
</template>

<script>
    import { ref } from 'vue';
    import CharacterShow from '../Components/Custom/CharacterShow.vue';

    export default {
        setup() {
            const brMenu = ref(false);
            
            const toggleBrMenu = () => {
                brMenu.value = !brMenu.value;
            };

            const actualChar = ref(0);

            const updateActualChar = (index) => {
                actualChar.value = index;
                brMenu.value = false;
            }
            
            return {
                brMenu,
                toggleBrMenu,
                actualChar,
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
