<!-- SpellList.vue -->
<template>
	<div class="p-8">
		<h2 class='bg-slate-500 w-36 m-auto'>Spells</h2>
		<ul>
			<li v-for="(spell, index) in spells" :key="spell.id" :class="{'bg-slate-700': index % 2 === 0,'bg-slate-800': index % 2 !== 0}" class="p-3">
				<span class="block text-xl">{{ spell.name }}</span>
				<span class="block">{{ spell.desc }}</span>
				<button v-if="authRole !== 'player'" @click="openSpellEdit(spell)" class="border"> edit </button>
				<button @click="deleteSpell(spell.id)" class="border border-red-600 mx-2"> x </button>
			</li>
			<li class="bg-slate-600">
				<button @click="openSpellAdd">Add spell</button>
			</li>
		</ul>
	</div>
	<spell-add v-if="spellAdd === true" :char_id="char_id" :close-spell-add="closeSpellAdd"></spell-add>
	<spell-edit v-if="spellEdit === true && authRole !== 'player'" :spell="selectedSpell" :close-spell-edit="closeSpellEdit"></spell-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import SpellAdd from './SpellAdd.vue';
import SpellEdit from './SpellEdit.vue';

export default {
	setup() {
		const spellAdd = ref(false);

		const openSpellAdd = () => {
			spellAdd.value = true;
		}
		const closeSpellAdd = () => {
			spellAdd.value = false;
		}

		const spellEdit = ref(false);
		const selectedSpell = ref(null);

		const openSpellEdit = (spell) => {
			spellEdit.value = true;
			selectedSpell.value = spell
		}
		const closeSpellEdit = () => {
			spellEdit.value = false;
			selectedSpell.value = null;
		}


		return {
			spellAdd,
			openSpellAdd,
			closeSpellAdd,
			spellEdit,
			selectedSpell,
			openSpellEdit,
			closeSpellEdit,
		}
	},
	components: {
		SpellAdd,
		SpellEdit,
	},
	props: {
		spells: {
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
		deleteSpell(spell_id) {
			Inertia.post(route('action.handle'), {
				spell_id: spell_id,
				action: 'del-spell'
			});
		}
	}
}
</script>