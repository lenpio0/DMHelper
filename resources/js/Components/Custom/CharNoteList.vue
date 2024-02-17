<!-- CharNoteList.vue -->
<template>
    <div>
        <h2>CharNotes</h2>
        <ul>
            <li v-for="char_note in char_notes">
                <span>{{ char_note.note }}</span>
                <button @click="deleteCharNote(char_note.id)">x</button>
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
import { Inertia } from '@inertiajs/inertia';
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
    methods: {
        deleteCharNote(note_id) {
            Inertia.post(route('action.handle'), {
                note_id: note_id,
                action: 'del-char-note'
            });        
        }
    }
}
</script>