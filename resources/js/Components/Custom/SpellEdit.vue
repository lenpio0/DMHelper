<!-- SpellEdit.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editSpell">
                <input type="text" v-model="name" :placeholder=spell.name>
                <textarea v-model="desc" :placeholder=spell.desc></textarea>
                <button type="submit" class="">Edit</button>
            </form>
            <button @click="closeSpellEdit">Close</button>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        spell: {
            default: null
        },
        closeSpellEdit: Function,
    },
    methods: {
        closeSpellEdit() {
            this.closeSpellEdit();
        },
        editSpell() {
            Inertia.post(route('action.handle'), {
                spell_id: this.spell.id,
                name: this.name,
                desc: this.desc,
                action: 'edit-spell'
            });
        }
    },
    data() {
        return {
            name: '',
            desc: '',
        }
    },
}
</script>