<!-- SpellAdd.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addSpell">
                <input type="text" v-model="name" placeholder="Enter name..." required>
                <textarea v-model="desc" placeholder="Enter description..." required></textarea>
                <button type="submit" class="">Add</button>
            </form>
            <button @click="closeSpellAdd">Close</button>
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
        closeSpellAdd: Function,
    },
    methods: {
        closeSpellAdd() {
            this.closeSpellAdd();
        },
        addSpell() {
            Inertia.post(route('action.handle'), {
                name: this.name,
                desc: this.desc,
                char_id: this.char_id,
                action: 'add-spell'
            });
        }
    },
    data() {
        return {
            name: '',
            desc: '',
        }
    }
}
</script>