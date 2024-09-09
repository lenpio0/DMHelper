<!-- TableList.vue -->  
<template>
    <div class="p-8">
        <h2 class='bg-slate-500 w-36 m-auto'>Tables</h2>
        <ul>
            <li v-for="(table, index) in tables" :key="table.id" :class="{'bg-slate-700': index % 2 === 0,'bg-slate-800': index % 2 !== 0}" class="p-3">
                <span class="block text-xl">{{ table.name }}</span>
                <h3 class="block underline mb-2">characters</h3>
                <ul>
                    <li v-for="character in table.characters">
                        <span>{{ character.name }}</span>
                    </li>
                </ul>
                <h3 class="block underline my-2">Infos</h3>
                <ul>
                    <li v-for="glob_info in table.glob_infos">
                        <span>{{ glob_info.info }}</span>
                        <button @click="openGlobInfoEdit(glob_info)" class="border"> edit </button>
                        <button @click="deleteGlobInfo(glob_info.id)" class="border border-red-600 mx-2 mt-2"> x </button>
                    </li>
                    <li class="bg-slate-600">
                        <button @click="openGlobInfoAdd(table)">Add Global info</button>
                    </li>
                </ul>
                <h3 class="block underline my-2">DM Infos</h3>
                <ul>
                    <li v-for="dm_info in table.dm_infos">
                        <span>{{ dm_info.info }}</span>
                        <button @click="openDmInfoEdit(dm_info, table)" class="border"> edit </button>
                        <button @click="deleteDmInfo(dm_info.id)" class="border border-red-600 mx-2 mt-2"> x </button>
                    </li>
                    <li class="bg-slate-600">
                        <button @click="openDmInfoAdd(table)">Add DM info</button>
                    </li>
                </ul>
                <button @click="openTableEdit(table)" class="border"> edit </button>
                <button @click="deleteTable(table.id)" class="border border-red-600 mx-2 mt-2"> x </button>
            </li>
            <li class="bg-slate-600">
                <button @click="openTableAdd">Add table</button>
            </li>
        </ul>
    </div>
    <table-add v-if="tableAdd === true" :table_id="table_id" :close-table-add="closeTableAdd"></table-add>
    <table-edit v-if="tableEdit === true" :table="selectedTable" :close-table-edit="closeTableEdit"></table-edit>
    
    <glob-info-add v-if="globInfoAdd === true" :table_id="selectedTable.id" :close-glob-info-add="closeGlobInfoAdd"></glob-info-add>
    <glob-info-edit v-if="globInfoEdit === true" :glob_info="selectedGlobInfo" :close-glob-info-edit="closeGlobInfoEdit"></glob-info-edit>
    
    <dm-info-add v-if="dmInfoAdd === true" :table_id="selectedTable.id" :close-dm-info-add="closeDmInfoAdd"></dm-info-add>
    <dm-info-edit v-if="dmInfoEdit === true" :dm_info="selectedDmInfo" :close-dm-info-edit="closeDmInfoEdit"></dm-info-edit>
</template>

<script>
import { ref } from 'vue';
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
            selectedDmInfo
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
        }
    }
}
</script>

