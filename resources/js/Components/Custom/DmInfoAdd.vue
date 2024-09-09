<!-- DmInfoAdd.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="addInfo" class="bg-blue-400 flex flex-col p-2">
                <textarea v-model="info" placeholder="Enter your info..." required class="m-2"></textarea>
                <div class="flex justify-between">
                    <button @click="closeInfoAdd" class="bg-red-400">Close</button>
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
        table_id: {
            default: null
        },
        closeDmInfoAdd: Function,
    },
    methods: {
        closeInfoAdd() {
            this.closeDmInfoAdd();
        },
        addInfo() {
            Inertia.post(route('action.handle'), {
                info: this.info,
                table_id: this.table_id,
                action: 'add-dm-info'
            });
        }
    },
    data() {
        return {
            info: '',
        }
    }
}
</script>