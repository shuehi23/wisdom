<template>
    <div>
        <textarea id="phrase" type="text" class="form-control c-input--new-book" :class="{'is-invalid':error}"
                  name="phrase" v-model="dataTextPhrase" placeholder="100字以内"
                  required maxlength="100" autocomplete="phrase" autofocus>
        </textarea>
        <span class="c-counter">{{ dataTextPhrase ? dataTextPhrase.length : 0 }} / 100</span>
    </div>
</template>

<script>
export default {
    props: ['textPhrase', 'error'],
    data() {
        return {
            dataTextPhrase: this.textPhrase, }
    }
}

</script>

<style scoped>

</style>