<template>
    <div>
        <p>{{ user }}</p>
    </div>
</template>

<script>
    export default {
        props: { 
            user: Object,
        },
    }
</script>
