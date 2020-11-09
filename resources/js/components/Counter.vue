<template>
    
    <p>{{strCount}}/100</p>
</template>

<script>
export default {
    data() {

        return {
            strLength: "",
        }
    },
    computed: {
        srtCount: function() {
            return this.strLength.length;
        }
    }
}
</script>