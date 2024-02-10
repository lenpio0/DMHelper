<template>
    <div class="bg-gray-800 h-full">
        <div v-show="brMenu" class="fixed bg-gray-900 h-full">
            <span>{{ user.name }}</span>
            <li v-for="character in user.characters">
                <ul>{{  character.name }}</ul>
            </li>
            <span>settings</span>
            <span>disconnect</span>
        </div>
        <character-show :character="user.characters[1]" :toggle-br-menu="toggleBrMenu"></character-show>

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
            
            return {
                brMenu,
                toggleBrMenu,
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
