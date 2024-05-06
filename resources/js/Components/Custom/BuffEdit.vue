<!-- BuffEdit.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editBuff">
                <input type="text" v-model="name" :placeholder=buff.name  required>
                <textarea v-model="desc" :placeholder=buff.desc required></textarea>
                <div>
                    <input type="checkbox" v-model="is_debuff" :checked="is_debuff">
                    <label> Is debuff ?</label>
                </div>
                <button type="submit" class="">Edit</button>
            </form>
            <button @click="closeBuffEdit">Close</button>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        buff: {
            default: null
        },
        closeBuffEdit: Function,
    },
    methods: {
        closeBuffEdit() {
            this.closeBuffEdit();
        },
        editBuff() {
            Inertia.post(route('action.handle'), {
                buff_id: this.buff.id,
                name: this.name,
                desc: this.desc,
                is_debuff: this.is_debuff,
                action: 'edit-buff'
            });
        }
    },
    data() {
        return {
            name: '',
            desc: '',
            is_debuff: false,
        }
    },
    created() {
        if (this.buff && this.buff.is_debuff) {
            this.is_debuff = true;
        }
    }
}
</script>