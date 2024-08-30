<!-- BuffEdit.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editBuff" class="bg-blue-400 flex flex-col p-2">
                <input type="text" v-model="name" :placeholder=buff.name required class="m-2">
                <textarea v-model="desc" :placeholder=buff.desc required class="m-2"></textarea>
                <div>
                    <input type="checkbox" v-model="is_debuff" :checked="is_debuff">
                    <label> Is debuff ?</label>
                </div>
                <div class="flex justify-between">
                    <button @click="closeBuffEdit" class="bg-red-400">Close</button>
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