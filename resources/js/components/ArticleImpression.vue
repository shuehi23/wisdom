<template>
    <div>
        <textarea id="impression" type="text" class="form-control c-input--new-book" :class="{'is-invalid':error}"
                  name="impression" v-model="dataTextImpression" placeholder="255字以内"
                   maxlength="255" autocomplete="impression" autofocus>
        </textarea>
        <span class="c-counter">{{ dataTextImpression ? dataTextImpression.length : 0 }} / 255</span>
    </div>
</template>

<script>
export default {
    props: ['textImpression', 'error'],
    data() {
        return {
            dataTextImpression: this.textImpression, }
    }
}
</script>

<style scoped>

</style>