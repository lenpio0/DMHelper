<!-- BuffEdit.vue -->
<template>
    <div class="z-50 fixed backdrop-blur-sm top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/50">
        <div class="w-80 sm:w-[24rem]">
            <h2 class='font-albert bg-soft-black-3 w-56 pt-2 pb-1.5 m-auto rounded-t-lg text-center text-xl font-bold'>Edit Buff</h2>
            <form @submit.prevent="editBuff" class="bg-soft-black-2 flex flex-col px-2 py-4 rounded-3xl">
                <input type="text" v-model="name" required class="m-3 rounded-3xl text-black">
                <textarea v-model="desc" required rows="4" class="m-3 rounded-2xl text-black"></textarea>
                <div class="my-2 mx-auto">
                    <label class="flex items-center cursor-pointer rounded py-2 border-b-4 border-soft-black-2 mx-auto">
                    <input type="checkbox" v-model="is_debuff" :checked="is_debuff" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-800"></div>
                    <span class="px-2">Is it a Debuff ?</span>
                    </label>
                </div>
                <div class="flex justify-around py-2">
                    <button @click="closeBuffEdit" class=" bg-red-600 box-content border-b-4 border-red-800 font-medium rounded-lg text-sm w-14 h-9 justify-center px-1 text-center inline-flex left-[2.1rem] items-center">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
						</svg>
                    </button>
                    <button type="submit" class="text-black border-soft-white-3 bg-soft-white-1 border-b-4 box-content font-medium rounded-lg text-sm w-16 h-9 justify-center px-1 text-center inline-flex items-center">
                        Edit
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
            name: this.buff.name ||'',
            desc: this.buff.desc || '',
            is_debuff: this.buff.is_debuff || false,
        }
    },
    created() {
        if (this.buff && this.buff.is_debuff) {
            this.is_debuff = true;
        }
    }
}
</script>