<!-- ItemEdit.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editItem">
                <input type="text" v-model="name" :placeholder=item.name required>
                <textarea v-model="desc" :placeholder=item.desc required></textarea>
                <button type="submit" class="">Edit</button>
            </form>
            <button @click="closeItemEdit">Close</button>
        </div>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: {
        item: {
            default: null
        },
        closeItemEdit: Function,
    },
    methods: {
        closeItemEdit() {
            this.closeItemEdit();
        },
        editItem() {
            Inertia.post(route('action.handle'), {
                item_id: this.item.id,
                name: this.name,
                desc: this.desc,
                action: 'edit-item'
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