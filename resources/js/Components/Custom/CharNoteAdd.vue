<!-- CharNoteAdd.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addNote" class="bg-blue-400 flex flex-col p-2">
                <textarea v-model="note" placeholder="Enter your note..." required class="m-2"></textarea>
                <div class="flex justify-between">
                    <button @click="closeNoteAdd" class="bg-red-400">Close</button>
                    <button type="submit" class="bg-blue-200">Add</button>
                </div>
            </form>
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