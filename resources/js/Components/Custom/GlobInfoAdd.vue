<!-- GlobInfoAdd.vue -->
<template>
    <div class="z-50 fixed backdrop-blur-sm top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div class="w-80 sm:w-[24rem]">
            <h2 class='text-white bg-soft-black-3 w-56 pt-2 pb-1.5 m-auto rounded-t-lg text-center text-xl font-bold font-albert'>Add Table Info</h2>
            <form @submit.prevent="addInfo" class="bg-soft-black-2 flex flex-col px-2 py-4 rounded-3xl">
                <textarea v-model="info" placeholder="Enter your info..." required rows="3" class="m-3 rounded-2xl text-black"></textarea>
                <div class="flex justify-around py-2">
                    <button @click="closeInfoAdd" class="bg-red-600 box-content border-b-4 border-red-800 font-medium rounded-lg text-sm w-14 h-9 justify-center px-1 text-center inline-flex left-[2.1rem] items-center">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
						</svg>
                    </button>
                    <button type="submit" class="text-black border-soft-white-3 bg-soft-white-1 border-b-4 box-content font-medium rounded-lg text-sm w-16 h-9 justify-center px-1 text-center inline-flex items-center">
                        Add
                    </button>
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
        closeGlobInfoAdd: Function,
    },
    methods: {
        closeInfoAdd() {
            this.closeGlobInfoAdd();
        },
        addInfo() {
            Inertia.post(route('action.handle'), {
                info: this.info,
                table_id: this.table_id,
                action: 'add-glob-info'
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