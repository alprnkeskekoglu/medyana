<template>
    <div class="">
        <div v-if="Object.keys($root.errors).length && $root.success == null" class="alert alert-danger">
            <div v-for="(v, k) in $root.errors" :key="k">
                <p v-for="error in v" :key="error" v-html="error"></p>
            </div>
        </div>
        <div v-if="$root.success" class="alert alert-success">
            <p v-html="$root.success"></p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Alert",
}
</script>

<style scoped>

</style>
