<!-- BuffList.vue -->
<template>
	<div>
		<h2>Buffs</h2>
		<ul>
			<li v-for="buff in buffs">
				<span>{{ buff.name }}</span>
				<span>{{ buff.desc }}</span>
				<span>{{ buff.is_debuff }}</span>
				<button @click="openBuffEdit(buff)"> edit </button>
				<button @click="deleteBuff(buff.id)"> x </button>
			</li>
			<li>
				<button @click="openBuffAdd">Add buff</button>
			</li>
		</ul>
	</div>
	<buff-add v-if="buffAdd === true" :char_id="char_id" :close-buff-add="closeBuffAdd"></buff-add>
	<buff-edit v-if="buffEdit === true" :buff="selectedBuff" :close-buff-edit="closeBuffEdit"></buff-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BuffAdd from './BuffAdd.vue';
import BuffEdit from './BuffEdit.vue';

export default {
	setup() {
		const buffAdd = ref(false);

		const openBuffAdd = () => {
			buffAdd.value = true;
		}
		const closeBuffAdd = () => {
			buffAdd.value = false;
		}

		const buffEdit = ref(false);
		const selectedBuff = ref(null);

		const openBuffEdit = (buff) => {
			buffEdit.value = true;
			selectedBuff.value = buff
		}
		const closeBuffEdit = () => {
			buffEdit.value = false;
			selectedBuff.value = null;
		}


		return {
			buffAdd,
			openBuffAdd,
			closeBuffAdd,
			buffEdit,
			selectedBuff,
			openBuffEdit,
			closeBuffEdit,
		}
	},
	components: {
		BuffAdd,
		BuffEdit,
	},
	props: {
		buffs: {
			default: () => []
		},
		char_id: {
			default: () => []
		}
	},
	methods: {
		deleteBuff(buff_id) {
			Inertia.post(route('action.handle'), {
				buff_id: buff_id,
				action: 'del-buff'
			});
		}
	}
}
</script>