<!-- BuffAdd.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addBuff" class="bg-blue-400 flex flex-col p-2">
                <input type="text" v-model="name" placeholder="Enter name..." required class="m-2">
                <textarea v-model="desc" placeholder="Enter description..." required class="m-2"></textarea>
                <div>
                    <input type="checkbox" v-model="is_debuff" name="debuff">
                    <label for="debuff"> Is debuff ?</label>
                </div>
                <div class="flex justify-between">
                    <button @click="closeBuffAdd" class="bg-red-400">Close</button>
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
        closeBuffAdd: Function,
    },
    methods: {
        closeBuffAdd() {
            this.closeBuffAdd();
        },
        addBuff() {
            Inertia.post(route('action.handle'), {
                name: this.name,
                desc: this.desc,
                is_debuff: this.is_debuff,
                char_id: this.char_id,
                action: 'add-buff'
            });
        }
    },
    data() {
        return {
            name: '',
            desc: '',
            is_debuff: false
        }
    }
}
</script>