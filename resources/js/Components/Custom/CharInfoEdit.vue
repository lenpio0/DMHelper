<!-- CharInfoEdit.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editInfo">
                <textarea v-model="info" :placeholder=char_info.info></textarea>
                <button type="submit" class="">Edit</button>
            </form>
            <button @click="closeInfoEdit">Close</button>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        char_info: {
            default: null
        },
        closeCharInfoEdit: Function,
    },
    methods: {
        closeInfoEdit() {
            this.closeCharInfoEdit();
        },
        editInfo() {
            Inertia.post(route('action.handle'), {
                info_id: this.char_info.id,
                info: this.info,
                action: 'edit-char-info'
            });        
        }
    },
    data() {
        return {
            info: ''
        }
    }
}
</script>