<!-- ItemAdd.vue -->
<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addItem">
                <input type="text" v-model="name" placeholder="Enter name...">
                <textarea v-model="desc" placeholder="Enter description..."></textarea>
                <button type="submit" class="">Add</button>
            </form>
            <button @click="closeItemAdd">Close</button>
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
        closeItemAdd: Function,
    },
    methods: {
        closeItemAdd() {
            this.closeItemAdd();
        },
        addItem() {
            Inertia.post(route('action.handle'), {
                name: this.name,
                desc: this.desc,
                char_id: this.char_id,
                action: 'add-item'
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