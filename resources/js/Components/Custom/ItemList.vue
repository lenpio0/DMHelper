<!-- ItemList.vue -->
<template>
	<div class="p-8">
		<h2 class='bg-slate-500 w-36 m-auto'>Items</h2>
		<ul>
			<li v-for="(item, index) in items" :key="item.id" :class="{'bg-slate-700': index % 2 === 0,'bg-slate-800': index % 2 !== 0}" class="p-3">
				<span class="block text-xl">{{ item.name }}</span>
				<span class="block">{{ item.desc }}</span>
				<button @click="openItemEdit(item)" class="border"> edit </button>
				<button @click="deleteItem(item.id)" class="border border-red-600 mx-2"> x </button>
			</li>
			<li class="bg-slate-600">
				<button @click="openItemAdd">Add item</button>
			</li>
		</ul>
	</div>
	<item-add v-if="itemAdd === true" :char_id="char_id" :close-item-add="closeItemAdd"></item-add>
	<item-edit v-if="itemEdit === true" :item="selectedItem" :close-item-edit="closeItemEdit"></item-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import ItemAdd from './ItemAdd.vue';
import ItemEdit from './ItemEdit.vue';

export default {
	setup() {
		const itemAdd = ref(false);

		const openItemAdd = () => {
			itemAdd.value = true;
		}
		const closeItemAdd = () => {
			itemAdd.value = false;
		}

		const itemEdit = ref(false);
		const selectedItem = ref(null);

		const openItemEdit = (item) => {
			itemEdit.value = true;
			selectedItem.value = item
		}
		const closeItemEdit = () => {
			itemEdit.value = false;
			selectedItem.value = null;
		}


		return {
			itemAdd,
			openItemAdd,
			closeItemAdd,
			itemEdit,
			selectedItem,
			openItemEdit,
			closeItemEdit,
		}
	},
	components: {
		ItemAdd,
		ItemEdit,
	},
	props: {
		items: {
			default: () => []
		},
		char_id: {
			default: () => []
		},
		authRole:{
             default: () => []
        },
	},
	methods: {
		deleteItem(item_id) {
			Inertia.post(route('action.handle'), {
				item_id: item_id,
				action: 'del-item'
			});
		}
	}
}
</script>