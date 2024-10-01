<!-- TableList.vue -->  
<template>
    <div class="my-8">
        <h2 class='bg-soft-black-3 w-56 py-1 m-auto rounded-t-lg text-center text-xl font-bold'>Tables</h2>
        <ul>
            <li v-for="(table, index) in (authRole === 'player' ? tables : allTables)" :key="table.id" class="p-3 my-2 bg-soft-black-2">
                <div class="flex justify-between">
                    <div class="flex w-5/6 justify-between">
                        <span class="block text-xl w-3/4 border-b-2 border-soft-white-1/25 font-bold">{{ table.name }}</span>
                        <button v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" @click="openTableEdit(table)" class="text-white bg-gray-500 border-b-4 border-gray-700 font-medium rounded-lg text-sm w-8 h-8 justify-center px-1 text-center inline-flex relative bottom-1 items-center me-2">
                            <svg width="37px" height="27px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#FFFFFF"/>
                            </svg>
                        </button>
                    </div>
                    <button v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" @click="deleteTable(table.id)" class="text-white bg-red-600 border-b-4 border-red-800 font-medium rounded-lg text-sm w-8 h-8 justify-center px-1 text-center inline-flex relative bottom-1 items-center me-2">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
						</svg>
                        <span class="sr-only">Icon description</span>
                    </button>
                </div>

                <h3 class="bg-soft-black-3 border-b border-soft-black-1/75 block w-40 py-1 m-auto rounded-lg mt-4 mb-2 text-center font-bold">Characters</h3>
                <ul>
                    <li v-for="character in table.characters">
                        <span>{{ character.name }}</span>
                    </li>
                </ul>
                <h3 class="bg-soft-black-3 border-b border-soft-black-1/75 block w-40 py-1 m-auto rounded-lg mt-4 mb-2 text-center font-bold">Infos</h3>
                <ul v-for="glob_info in table.glob_infos">
                    <li class="flex justify-between pr-2 py-2">
                        <span>{{ glob_info.info }}</span>
                        <div class="flex">
                            <button v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" @click="openGlobInfoEdit(glob_info)" class="text-white bg-gray-500 border-b-4 border-gray-700 font-medium rounded-lg text-sm w-6 h-6 justify-center px-1 text-center inline-flex relative bottom-1 items-center me-2">
                                <svg width="37px" height="27px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#FFFFFF"/>
                                </svg>
                            </button>
                            <button v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" @click="deleteGlobInfo(glob_info.id)"  class="text-white bg-red-600 border-b-4 border-red-800 font-medium rounded-lg text-sm w-6 h-6 justify-center px-1 text-center inline-flex relative bottom-1 items-center">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
                                </svg>
                            </button>
                        </div>
                    </li>
                    <span class="border-b border-soft-white-1/25 w-5/6 mx-auto block"></span>
                </ul>
                <div v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" class="mt-2 text-black border-b-4 border-soft-white-3 bg-soft-white-1 rounded-lg w-32 m-auto font-medium text-sm py-1 text-center items-center justify-center flex">
                    <button @click="openGlobInfoAdd(table)">Add Table info</button>
                </div>
                <h3 v-if="authRole !== 'player'" class="bg-soft-black-3 border-b border-soft-black-1/75 block w-40 py-1 m-auto rounded-lg mt-4 mb-2 text-center font-bold">DM Infos</h3>
                <ul v-if="authRole !== 'player'" v-for="dm_info in table.dm_infos">
                    <li class="flex justify-between pr-2 py-2">
                        <span>{{ dm_info.info }}</span>
                        <div class="flex">
                            <button v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" @click="openDmInfoEdit(dm_info, table)" class="text-white bg-gray-500 border-b-4 border-gray-700 font-medium rounded-lg text-sm w-6 h-6 justify-center px-1 text-center inline-flex relative bottom-1 items-center me-2">
                                <svg width="37px" height="27px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#FFFFFF"/>
                                </svg>
                            </button>
                            <button v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" @click="deleteDmInfo(dm_info.id)" class="text-white bg-red-600 border-b-4 border-red-800 font-medium rounded-lg text-sm w-6 h-6 justify-center px-1 text-center inline-flex relative bottom-1 items-center">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
                                </svg>
                            </button>
                        </div>
                    </li>
                    <span class="border-b border-soft-white-1/25 w-5/6 mx-auto block"></span>
                </ul>
                <div v-if="(authRole === 'admin') || (authRole === 'dm' && table.user_id) === authId" class="mt-2 text-black border-b-4 border-soft-white-3 bg-soft-white-1 rounded-lg w-32 m-auto font-medium text-sm py-1 text-center items-center justify-center flex">
                    <button @click="openDmInfoAdd(table)">Add DM info</button>
                </div>
            </li>
        </ul>
        <button v-if="authRole !== 'player'" @click="openTableAdd" class="text-black border-b-4 border-soft-white-3 bg-soft-white-1 rounded-b-lg w-56 m-auto font-medium text-md py-1 text-center items-center justify-center flex">
            <svg class="relative top-[2px] right-1" width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill="#000000" fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"/>
			</svg>
            <span>Add Table</span>
        </button>
        <div class="">
            <form @submit.prevent="joinTable"  v-if="authRole === 'player'">
                <span class="bg-soft-black-3 block w-56 py-1 m-auto rounded-lg mt-4 mb-2 text-center text-xl font-bold">Join a Table</span>
                <select v-model="table_id" class="mx-auto block rounded-xl">
                    <option v-for="table in allTables" :key="table.id" :value="table.id">
                        {{ table.name }}
                    </option>
                </select>
                <button @click="openTableJoin" class="text-black mx-auto border-b-4 border-soft-white-3 bg-soft-white-1 rounded-b-lg w-56 m-auto font-medium text-md py-1 text-center block">Join Table</button>
            </form>
        </div>
    </div>
    <table-add v-if="tableAdd === true && authRole !== 'player'" :auth-id="authId" :table_id="table_id" :close-table-add="closeTableAdd"></table-add>
    <table-edit v-if="tableEdit === true && authRole !== 'player'" :table="selectedTable" :close-table-edit="closeTableEdit"></table-edit>
    
    <glob-info-add v-if="globInfoAdd === true && authRole !== 'player'" :table_id="selectedTable.id" :close-glob-info-add="closeGlobInfoAdd"></glob-info-add>
    <glob-info-edit v-if="globInfoEdit === true && authRole !== 'player'" :glob_info="selectedGlobInfo" :close-glob-info-edit="closeGlobInfoEdit"></glob-info-edit>
    
    <dm-info-add v-if="dmInfoAdd === true && authRole !== 'player'" :table_id="selectedTable.id" :close-dm-info-add="closeDmInfoAdd"></dm-info-add>
    <dm-info-edit v-if="dmInfoEdit === true && authRole !== 'player'" :dm_info="selectedDmInfo" :close-dm-info-edit="closeDmInfoEdit"></dm-info-edit>
</template>

<script>
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import TableAdd from './TableAdd.vue';
import TableEdit from './TableEdit.vue';
import GlobInfoAdd from './GlobInfoAdd.vue';
import GlobInfoEdit from './GlobInfoEdit.vue';
import DmInfoAdd from './DmInfoAdd.vue';
import DmInfoEdit from './DmInfoEdit.vue';

export default {
    setup() {
        const tableAdd = ref(false);

        const openTableAdd = () => {
            tableAdd.value = true;
        }
        const closeTableAdd = () => {
            tableAdd.value = false;
        }

        const tableEdit = ref(false);
        const selectedTable = ref(null);

        const openTableEdit = (table) => {
            tableEdit.value = true;
            selectedTable.value = table
        }
        const closeTableEdit = () => {
            tableEdit.value = false;
            selectedTable.value = null;
        }

        const globInfoAdd = ref(false);

        const openGlobInfoAdd = (table) => {
            globInfoAdd.value = true;
            selectedTable.value = table;
        }
        const closeGlobInfoAdd = () => {
            globInfoAdd.value = false;
            selectedTable.value = null;
        }

        const globInfoEdit = ref(false);
        const selectedGlobInfo = ref(null);

        const openGlobInfoEdit = (glob_info) => {
            globInfoEdit.value = true;
            selectedGlobInfo.value = glob_info;
        }
        const closeGlobInfoEdit = () => {
            globInfoEdit.value = false;
            selectedGlobInfo.value = null;
        }

        const dmInfoAdd = ref(false);

        const openDmInfoAdd = (table) => {
            dmInfoAdd.value = true;
            selectedTable.value = table;
        }
        const closeDmInfoAdd = () => {
            dmInfoAdd.value = false;
            selectedTable.value = null;
        }

        const dmInfoEdit = ref(false);
        const selectedDmInfo = ref(null);

        const openDmInfoEdit = (dm_info) => {
            dmInfoEdit.value = true;
            selectedDmInfo.value = dm_info;
        }
        const closeDmInfoEdit = () => {
            dmInfoEdit.value = false;
            selectedDmInfo.value = null;
            selectedTable.value = null;
        }




        return {
            tableAdd,
            openTableAdd,
            closeTableAdd,
            tableEdit,
            selectedTable,
            openTableEdit,
            closeTableEdit,
            globInfoAdd,
            openGlobInfoAdd,
            closeGlobInfoAdd,
            globInfoEdit,
            openGlobInfoEdit,
            closeGlobInfoEdit,
            dmInfoAdd,
            openDmInfoAdd,
            closeDmInfoAdd,
            dmInfoEdit,
            openDmInfoEdit,
            closeDmInfoEdit,
            selectedGlobInfo,
            selectedDmInfo,
        }
    },
    components: {
        TableAdd,
        TableEdit,
        GlobInfoAdd,
        GlobInfoEdit,
        DmInfoAdd,
        DmInfoEdit
    },
    props: {
        tables: {
            default: () => []
        },
        char_id: {
            default: () => []
        },
        authRole: {
            default: () => []
        },
        authId: {
            default: () => []
        },
    },
    data() {
        return {
            allTables: [],
            table_id: '',
        }
    },
    methods: {
        deleteTable(table_id) {
            Inertia.post(route('action.handle'), {
                table_id: table_id,
                action: 'del-table'
            });
        },
        deleteGlobInfo(info_id) {
            Inertia.post(route('action.handle'), {
                info_id: info_id,
                action: 'del-glob-info'
            });
        },
        deleteDmInfo(info_id) {
            Inertia.post(route('action.handle'), {
                info_id: info_id,
                action: 'del-dm-info'
            });
        },
        joinTable() {
            Inertia.post(route('action.handle'), {
                table_id: this.table_id,
                char_id: this.char_id,
                action: 'join-table'
            });
        },
        fetchTables() {
            axios.get('/api/tables') 
                .then(response => {
                    this.allTables = response.data;  // Assuming response contains the list of tables

                    // Sort tables based on authId matching and then by descending user_id
                    this.allTables = this.allTables.sort((a, b) => {
                        if (a.user_id === this.authId) return -1;  // Place tables with authId first
                        if (b.user_id === this.authId) return 1;   // Ensure other tables are sorted lower
                    
                        // For tables where user_id doesn't match authId, sort by descending user_id
                        return a.user_id - b.user_id;
                    });                    
                    
                })
                .catch(error => {
                    console.error('Error fetching tables:', error);
                });

        },

    },
    mounted() {
        this.fetchTables();  // Fetch when component is mounted
    },  
}
</script>

