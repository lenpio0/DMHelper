<!-- CharInfoAdd.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addInfo">
                <textarea v-model="info" placeholder="Enter your info..."></textarea>
                <button type="submit" class="">Add</button>
            </form>
            <button @click="closeInfoAdd">Close</button>
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
        closeCharInfoAdd: Function,
    },
    methods: {
        closeInfoAdd() {
            this.closeCharInfoAdd();
        },
        addInfo() {
            Inertia.post(route('action.handle'), {
                info: this.info,
                char_id: this.char_id,
                action: 'add-char-info'
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