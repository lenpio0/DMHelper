<!-- CharInfoList.vue -->
<template>
    <div>
      <h2>CharInfos</h2>
      <ul>
        <li v-for="char_info in char_infos">
          {{ char_info.info }} - {{ char_info.is_secret }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      char_infos: {
        default: () => []
      }
    }
  }
  </script>