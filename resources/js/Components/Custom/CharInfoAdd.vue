<!-- CharInfoAdd.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addInfo">
                <textarea v-model="info" placeholder="Enter your info..." required></textarea>
                <div>
                    <input type="checkbox" v-model="is_secret" name="secret">
                    <label for="secret"> Is secret ?</label>
                </div>
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
                is_secret: this.is_secret,
                char_id: this.char_id,
                action: 'add-char-info'
            });
        }
    },
    data() {
        return {
            info: '',
            is_secret: false
        }
    }
}
</script>