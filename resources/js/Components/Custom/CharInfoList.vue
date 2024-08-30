<!-- CharInfoList.vue -->
<template>
    <div class="p-8">
        <h2 class='bg-slate-500 w-36 m-auto'>CharInfos</h2>
        <ul>
            <li v-for="(char_info, index) in char_infos" :key="char_info.id" :class="{'bg-slate-700': index % 2 === 0,'bg-slate-800': index % 2 !== 0}" class="p-3">
                <span class="block">{{ char_info.info }}</span>
                <span class="block underline mb-2">{{ char_info.is_secret ? "Secret" : "Not secret" }}</span>
                <button @click="openCharInfoEdit(char_info)" class="border"> edit </button>
                <button @click="deleteCharInfo(char_info.id)" class="border border-red-600 mx-2"> x </button>
            </li>
            <li class="bg-slate-600">
                <button @click="openCharInfoAdd">Add info</button>
            </li>
        </ul>
    </div>
    <char-info-add v-if="charInfoAdd === true" :char_id="char_id" :close-char-info-add="closeCharInfoAdd"></char-info-add>
    <char-info-edit v-if="charInfoEdit === true" :char_info="selectedCharInfo"
        :close-char-info-edit="closeCharInfoEdit"></char-info-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import CharInfoAdd from './CharInfoAdd.vue';
import CharInfoEdit from './CharInfoEdit.vue';

export default {
    setup() {
        const charInfoAdd = ref(false);

        const openCharInfoAdd = () => {
            charInfoAdd.value = true;
        }
        const closeCharInfoAdd = () => {
            charInfoAdd.value = false;
        }

        const charInfoEdit = ref(false);
        const selectedCharInfo = ref(null);

        const openCharInfoEdit = (char_info) => {
            charInfoEdit.value = true;
            selectedCharInfo.value = char_info
        }
        const closeCharInfoEdit = () => {
            charInfoEdit.value = false;
            selectedCharInfo.value = null;
        }


        return {
            charInfoAdd,
            openCharInfoAdd,
            closeCharInfoAdd,
            charInfoEdit,
            selectedCharInfo,
            openCharInfoEdit,
            closeCharInfoEdit,
        }
    },
    components: {
        CharInfoAdd,
        CharInfoEdit,
    },
    props: {
        char_infos: {
            default: () => []
        },
        char_id: {
            default: () => []
        }
    },
    methods: {
        deleteCharInfo(info_id) {
            Inertia.post(route('action.handle'), {
                info_id: info_id,
                action: 'del-char-info'
            });
        }
    }
}
</script>