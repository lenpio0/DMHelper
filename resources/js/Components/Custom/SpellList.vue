<!-- SpellList.vue -->
<template>
    <div>
      <h2>Spells</h2>
      <ul>
        <li v-for="spell in spells">
          {{ spell.name }} - {{ spell.desc }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      spells: {
        default: () => []
      }
    }
  }
  </script>