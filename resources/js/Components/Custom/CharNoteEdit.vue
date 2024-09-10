<!-- CharNoteEdit.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editNote" class="bg-blue-400 flex flex-col p-2">
                <textarea v-model="note" required class="m-2"></textarea>
                <div class="flex justify-between">
                    <button @click="closeNoteEdit" class="bg-red-400">Close</button>
                    <button type="submit" class="bg-blue-200">Edit</button>
                </div>
            </form>
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
            note: this.char_note.note || ''
        }
    }
}
</script>