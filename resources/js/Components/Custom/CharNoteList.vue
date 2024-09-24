<!-- CharNoteList.vue -->
<template>
    <div class="py-8">
        <h2 class='bg-soft-black-3 w-36 m-auto'>CharNotes</h2>
        <ul>
            <li v-for="(char_note, index) in char_notes" :key="char_note.id" :class="{'bg-soft-black-2': index % 2 === 0,'bg-soft-black-1': index % 2 !== 0}" class="p-3">
                <span class="block mb-2">{{ char_note.note }}</span>
                <button @click="openCharNoteEdit(char_note)" class="border"> edit </button>
                <button @click="deleteCharNote(char_note.id)" class="border border-red-600 mx-2"> x </button>
            </li>
            <li class="bg-soft-black-3">
                <button @click="openCharNoteAdd">Add note</button>
            </li>
        </ul>
    </div>
    <char-note-add v-if="charNoteAdd === true" :char_id="char_id" :close-char-note-add="closeCharNoteAdd"></char-note-add>
    <char-note-edit v-if="charNoteEdit === true" :char_note="selectedCharNote" :close-char-note-edit="closeCharNoteEdit"></char-note-edit>

</template>
  
<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import CharNoteAdd from './CharNoteAdd.vue';
import CharNoteEdit from './CharNoteEdit.vue';

export default {
    setup() {
        const charNoteAdd = ref(false);

        const openCharNoteAdd = () => {
            charNoteAdd.value = true;
        }
        const closeCharNoteAdd = () => {
            charNoteAdd.value = false;
        }

        const charNoteEdit = ref(false);
        const selectedCharNote = ref(null);

        const openCharNoteEdit = (char_note) => {
            charNoteEdit.value = true;
            selectedCharNote.value = char_note
        }
        const closeCharNoteEdit = () => {
            charNoteEdit.value = false;
            selectedCharNote.value = null;
        }


        return {
            charNoteAdd,
            openCharNoteAdd,
            closeCharNoteAdd,
            charNoteEdit,
            selectedCharNote,
            openCharNoteEdit,
            closeCharNoteEdit,
        }
    },
    components: {
        CharNoteAdd,
        CharNoteEdit,
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