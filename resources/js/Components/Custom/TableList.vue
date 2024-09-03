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
                    </li>
                </ul>
                <h3 class="block underline my-2">DM Infos</h3>
                <ul>
                    <li v-for="dm_info in table.dm_infos">
                        <span>{{ dm_info.info }}</span>
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
    <table-edit v-if="tableEdit === true" :table="selectedTable"
        :close-table-edit="closeTableEdit"></table-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import TableAdd from './TableAdd.vue';
import TableEdit from './TableEdit.vue';

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


        return {
            tableAdd,
            openTableAdd,
            closeTableAdd,
            tableEdit,
            selectedTable,
            openTableEdit,
            closeTableEdit,
        }
    },
    components: {
        TableAdd,
        TableEdit,
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
        }
    }
}
</script>

