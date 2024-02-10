<!-- ItemList.vue -->
<template>
    <div>
      <h2>Items</h2>
      <ul>
        <li v-for="item in items">
          {{ item.name }} - {{ item.desc }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      items: {
        default: () => []
      }
    }
  }
  </script>