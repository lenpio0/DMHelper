<!-- BuffList.vue -->
<template>
  <div>
    <h2>Buffs</h2>
    <ul>
      <li v-for="buff in buffs">
        {{ buff.name }} - {{ buff.description }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    buffs: {
      default: () => []
    }
  }
}
</script>