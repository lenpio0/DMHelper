<!-- ItemEdit.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editItem" class="bg-blue-400 flex flex-col p-2">
                <input type="text" v-model="name" :placeholder=item.name required class="m-2">
                <textarea v-model="desc" :placeholder=item.desc required class="m-2"></textarea>
                <div class="flex justify-between">
                    <button @click="closeItemEdit" class="bg-red-400">Close</button>
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