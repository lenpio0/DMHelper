<!-- SpellList.vue -->
<template>
	<div>
		<h2>Spells</h2>
		<ul>
			<li v-for="spell in spells">
				<span>{{ spell.name }}</span>
				<span>{{ spell.desc }}</span>
				<button @click="openSpellEdit(spell)"> edit </button>
				<button @click="deleteSpell(spell.id)"> x </button>
			</li>
			<li>
				<button @click="openSpellAdd">Add spell</button>
			</li>
		</ul>
	</div>
	<spell-add v-if="spellAdd === true" :char_id="char_id" :close-spell-add="closeSpellAdd"></spell-add>
	<spell-edit v-if="spellEdit === true" :spell="selectedSpell" :close-spell-edit="closeSpellEdit"></spell-edit>
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
		}
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