<!-- SpellList.vue -->
<template>
	<div class="py-8">
		<h2 class='bg-soft-black-3 w-56 py-1 m-auto rounded-t-lg text-center text-xl font-bold font-albert border-b-4 border-soft-black-2'>Spells</h2>
		<ul class="py-1">
			<li v-if="spells.length === 0" class="p-3 my-3 bg-soft-black-2 text-center text-sm font-albert border-b-4 border-soft-black-1/50">No Spells yet !</li> 
			<li v-if="spells.length !== 0" v-for="(spell, index) in spells" :key="spell.id" class="py-3 my-3 bg-soft-black-2 min-h-32 flex justify-between h-full px-6 sm:px-16 md:px-32 lg:px-56 xl:px-8 2xl:px-36 border-b-4 border-soft-black-1/50">
				<div class="flex flex-col w-4/5 overflow-scroll no-scrollbar">
					<span class="block text-xl font-medium w-3/4 border-b border-soft-white-1/25 font-albert mb-3">{{ spell.name }}</span>
					<span class="block font-albert pr-4 text-sm">{{ spell.desc }}</span>
				</div>
				<div class="flex flex-col justify-between py-1">
					<button @click="confirm(spell.id)" class="text-white bg-red-600 border-b-4 border-red-800 font-medium rounded-lg text-sm w-8 h-8 justify-center px-1 text-center inline-flex relative bottom-1 items-center me-2">
						<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
						</svg>
						<span class="sr-only">Icon description</span>
					</button>
					<button @click="openSpellEdit(spell)" class="text-white bg-gray-500 border-b-4 border-gray-700 font-medium w-8 h-8 rounded-lg text-sm py-1 text-center inline-flex items-center me-2">
						<svg width="32px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#FFFFFF"/>
						</svg>
						<span class="sr-only">Icon description</span>
					</button>
					<delete-confirmation :show="showConfirmation" @confirmed="deleteSpell(spellToDelete)" @cancelled="showConfirmation = false"/>
				</div>
			</li>
		</ul>
		<div class="w-56 m-auto">
			<button @click="openSpellAdd" class="text-black border-b-4 border-soft-white-3 bg-soft-white-1 rounded-b-lg w-56 m-auto font-medium text-md py-1 text-center items-center me-2 justify-center flex">
				<svg class="relative top-[2px] right-1" width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill="#000000" fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"/>
				</svg>
				<span>Add Spell</span>
			</button>
		</div>
	</div>
	<spell-add v-if="spellAdd === true" :char_id="char_id" :close-spell-add="closeSpellAdd"></spell-add>
	<spell-edit v-if="spellEdit === true" :spell="selectedSpell" :close-spell-edit="closeSpellEdit"></spell-edit>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import SpellAdd from './SpellAdd.vue';
import SpellEdit from './SpellEdit.vue';
import DeleteConfirmation from './DeleteConfirmation.vue';


export default {
	setup() {
		const showConfirmation = ref(false);
		const spellAdd = ref(false);
		const spellToDelete = ref(null);

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
		const confirm = (spellId) => {
			spellToDelete.value = spellId; // Set the spell to delete
			showConfirmation.value = true;
		}


		return {
			spellAdd,
			openSpellAdd,
			closeSpellAdd,
			spellEdit,
			selectedSpell,
			openSpellEdit,
			closeSpellEdit,
			showConfirmation,
			spellToDelete,
			confirm
		}
	},
	components: {
		SpellAdd,
		SpellEdit,
		DeleteConfirmation
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
			this.showConfirmation = false;
		},

	}
}
</script>