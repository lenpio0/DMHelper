<!-- BuffList.vue -->
<template>
	<div class="p-8">
		<h2 class='bg-slate-500 w-36 m-auto'>Buffs</h2>
		<ul>
			<li v-for="(buff, index) in buffs" :key="buff.id" :class="{'bg-slate-700': index % 2 === 0,'bg-slate-800': index % 2 !== 0}" class="p-3">
				<span class="block text-xl">{{ buff.name }}</span>
				<span class="block">{{ buff.desc }}</span>
				<span class="block underline mb-2">{{ buff.is_debuff ? "Debuff" : "Buff" }}</span>
				<button v-if="authRole !== 'player'" @click="openBuffEdit(buff)" class="border"> edit </button>
				<button v-if="authRole !== 'player'" @click="deleteBuff(buff.id)" class="border border-red-600 mx-2"> x </button>
			</li>
			<li class="bg-slate-600">
				<button v-if="authRole !== 'player'" @click="openBuffAdd">Add buff</button>
			</li>
		</ul>
	</div>
	<buff-add v-if="buffAdd === true && authRole !== 'player'" :char_id="char_id" :close-buff-add="closeBuffAdd"></buff-add>
	<buff-edit v-if="buffEdit === true && authRole !== 'player'" :buff="selectedBuff" :close-buff-edit="closeBuffEdit"></buff-edit>
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
		},
		authRole:{
             default: () => []
        },

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