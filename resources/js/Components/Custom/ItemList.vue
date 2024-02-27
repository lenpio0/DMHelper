<!-- ItemList.vue -->
<template>
	<div>
		<h2>Items</h2>
		<ul>
			<li v-for="item in items">
				<span>{{ item.name }}</span>
				<span>{{ item.desc }}</span>
				<button @click="openItemEdit(item)"> edit </button>
				<button @click="deleteItem(item.id)"> x </button>
			</li>
			<li>
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
		}
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