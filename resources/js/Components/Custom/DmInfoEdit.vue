<!-- DmInfoEdit.vue -->
<template>
    <div class="z-20 fixed top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div>
            <form @submit.prevent="editInfo" class="bg-blue-400 flex flex-col p-2">
                <textarea v-model="info" required class="m-2"></textarea>
                <div class="flex justify-between">
                    <button @click="closeInfoEdit" class="bg-red-400">Close</button>
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
        dm_info: {
            default: null
        },
        closeDmInfoEdit: Function,
    },
    methods: {
        closeInfoEdit() {
            this.closeDmInfoEdit();
        },
        editInfo() {
            Inertia.post(route('action.handle'), {
                info_id: this.dm_info.id,
                info: this.info,
                action: 'edit-dm-info'
            });
        }
    },
    data() {
        return {
            info: this.dm_info.info || '',
        }
    }
}
</script>