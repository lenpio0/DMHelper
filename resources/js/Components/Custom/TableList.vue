<!-- TableList.vue -->
<template>
    <div>
        <h2>Tables</h2>
        <ul>
            <li v-for="table in tables">
                <ul>{{ table.name }}</ul>
                <ul>characters</ul>
                <ul>
                    <li v-for="character in table.characters">
                        <ul>{{ character.name }}</ul>
                    </li>
                </ul>
                <ul>Infos</ul>
                <ul>
                    <li v-for="glob_info in table.glob_infos">
                        <ul>{{ glob_info.info }}</ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>
  
<script>
    export default {
        props: {
            tables: {
                default: () => []
            }
        }
    }
</script>