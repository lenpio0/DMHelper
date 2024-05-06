<!-- CharNoteAdd.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addNote">
                <textarea v-model="note" placeholder="Enter your note..." required></textarea>
                <button type="submit" class="">Add</button>
            </form>
            <button @click="closeNoteAdd">Close</button>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        char_id: {
            default: null
        },
        closeCharNoteAdd: Function,
    },
    methods: {
        closeNoteAdd() {
            this.closeCharNoteAdd();
        },
        addNote() {
            Inertia.post(route('action.handle'), {
                note: this.note,
                char_id: this.char_id,
                action: 'add-char-note'
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