<!-- CharNoteAdd.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addNote">
                <textarea v-model="note" placeholder="Enter your note..."></textarea>
                <button type="submit" class="">Add</button>
            </form>
            <button @click="closeNoteAdd">Close</button>
        </div>
    </div>
</template>
  
<script>
export default {
    props: {
        char_id: {
            default: () => []
        },
        closeCharNoteAdd: Function,
    },
    methods: {
        closeNoteAdd() {
            this.closeCharNoteAdd();
        },
        addNote() {
            this.note.post(route('char-note.store', char_id));
        }
    },
    data() {
        return {
            note: ''
        }
    }
}
</script>