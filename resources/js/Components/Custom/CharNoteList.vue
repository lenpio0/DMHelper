<!-- CharNoteList.vue -->
<template>
    <div>
      <h2>CharNotes</h2>
      <ul>
        <li v-for="char_note in char_notes">
          {{ char_note.note }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      char_notes: {
        default: () => []
      }
    }
  }
  </script>