<template>
    <div>
        <alert></alert>
        <form>
            <div class="block block-rounded">
                <div class="block-header block-header-default block-header-rtl">
                    <div class="block-options">
                        <a href="/clinics" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-arrow-left"></i>
                            Go Back
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-primary" @click="sendForm">
                            <i class="fa fa-check"></i>
                            Submit
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center py-sm-3 py-md-5">
                        <div class="col-sm-10 col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Status</label>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-success custom-control-lg">
                                            <input type="radio" class="custom-control-input" id="status_active" v-model="data.status" value="1" >
                                            <label class="custom-control-label" for="status_active">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-danger custom-control-lg">
                                            <input type="radio" class="custom-control-input" id="status_passive" v-model="data.status" value="3" >
                                            <label class="custom-control-label" for="status_passive">Passive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" v-model="data.name" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Create",
    data() {
        return {
            data: {
                _token: window.token,
                status: 1,
                name: null,
            },
        }
    },
    methods: {
        sendForm: function () {
            axios.post('/clinics', this.data).
            then(response => {
                this.$root.success = response.data.message;
                setTimeout(function () {
                    window.location.href = '/clinics';
                }, 1250)
            }).catch(e => {
                this.$root.success = null;
                this.$root.errors = e.response.data.errors;
            })
        }
    }
}
</script>

<style scoped>

</style>
