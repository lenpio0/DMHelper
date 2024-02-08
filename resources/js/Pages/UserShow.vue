<template>
    <div>
        <p>user.id {{ user.id }}</p>
        <p>user.name {{ user.name }}</p>
        <p>user.email {{ user.email }}</p>
        <p>user.is_dm {{ user.is_dm }}</p>
        <li v-for="character in user.characters" class="py-4">
            <ul>character.id {{ character.id }}</ul>
            <ul>character.name {{ character.name }}</ul>
            <ul>character.health {{ character.health }}</ul>
            <li v-for="buff in character.buffs">
                <ul>buff.id {{ buff.id }}</ul>
                <ul>buff.name {{ buff.name }}</ul>
                <ul>buff.desc {{ buff.desc }}</ul>
                <ul>buff.is_debuff {{ buff.is_debuff }}</ul>
            </li>
        </li>
        <p>DUMP : {{ user }}</p>
    </div>
</template>

<script>
    export default {
        props: { 
            user: Object,
        },
    }
</script>
