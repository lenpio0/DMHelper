<!-- CharNoteEdit.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editNote">
                <textarea v-model="note" :placeholder=char_note.note required></textarea>
                <button type="submit" class="">Edit</button>
            </form>
            <button @click="closeNoteEdit">Close</button>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        char_note: {
            default: null
        },
        closeCharNoteEdit: Function,
    },
    methods: {
        closeNoteEdit() {
            this.closeCharNoteEdit();
        },
        editNote() {
            Inertia.post(route('action.handle'), {
                note_id: this.char_note.id,
                note: this.note,
                action: 'edit-char-note'
            });        
        }
    },
    data() {
        return {
            note: ''
        }
    }
}
</script>