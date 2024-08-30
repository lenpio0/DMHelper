<!-- CharInfoEdit.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editInfo" class="bg-blue-400 flex flex-col p-2">
                <textarea v-model="info" :placeholder=char_info.info required class="m-2"></textarea>
                <div>
                    <input type="checkbox" v-model="is_secret" :checked="is_secret">
                    <label>Is secret ?</label>
                </div>
                <div class="flex justify-between">
                    <button @click="closeInfoEdit" class="bg-red-400">Close</button>
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
                is_secret: this.is_secret,
                action: 'edit-char-info'
            });
        }
    },
    data() {
        return {
            info: '',
            is_secret: false,
        }
    }
}
</script>