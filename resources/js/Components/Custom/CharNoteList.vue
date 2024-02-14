<!-- CharNoteList.vue -->
<template>
    <div>
        <h2>CharNotes</h2>
        <ul>
            <li v-for="char_note in char_notes">
                {{ char_note.note }}
            </li>
            <li>
                <button @click="openCharNoteAdd">Add note</button>
            </li>
        </ul>
    </div>
    <char-note-add v-if="charNoteAdd === true" :char_id="char_id" :close-char-note-add="closeCharNoteAdd"></char-note-add>
</template>
  
<script>
import { ref } from 'vue';
import CharNoteAdd from './CharNoteAdd.vue';
export default {
    setup() {
        const charNoteAdd = ref(false);

        const openCharNoteAdd = () => {
            charNoteAdd.value = true;
        }
        const closeCharNoteAdd = () => {
            charNoteAdd.value = false;
        }


        return {
            charNoteAdd,
            openCharNoteAdd,
            closeCharNoteAdd
        }
    },
    components: {
        CharNoteAdd,
    },
    props: {
        char_notes: {
            default: () => []
        },
        char_id: {
            default: () => []
        }
    },
}
</script>