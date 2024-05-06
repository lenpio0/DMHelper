<!-- BuffAdd.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addBuff">
                <input type="text" v-model="name" placeholder="Enter name..." required>
                <textarea v-model="desc" placeholder="Enter description..." required></textarea>
                <div>
                    <input type="checkbox" v-model="is_debuff" name="debuff">
                    <label for="debuff"> Is debuff ?</label>
                </div>
                <button type="submit" class="">Add</button>
            </form>
            <button @click="closeBuffAdd">Close</button>
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