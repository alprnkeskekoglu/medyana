<template>
    <div>
        <alert></alert>
        <form>
            <div class="block block-rounded">
                <div class="block-header block-header-default block-header-rtl">
                    <div class="block-options">
                        <a href="/equipments" class="btn btn-sm btn-outline-secondary">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="d-block">Status</label>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-success custom-control-lg">
                                            <input type="radio" class="custom-control-input" id="status_active" v-model="data.status" value="1" >
                                            <label class="custom-control-label" for="status_active">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-danger custom-control-lg">
                                            <input type="radio" class="custom-control-input" id="status_passive" v-model="data.status" value="2">
                                            <label class="custom-control-label" for="status_passive">Passive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Clinic Name</label>
                                        <select class="form-control" v-model="data.clinic_id">
                                            <option value="">Please select</option>
                                            <option v-for="clinic in clinics" :value="clinic.id" v-html="clinic.name"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" v-model="data.name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Supply Date</label>
                                        <input type="date" class="form-control" v-model="data.supply_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Stock Number</label>
                                        <input type="number" class="form-control" v-model="data.stock">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Price</label>
                                        <input type="number" class="form-control" v-model="data.unit_price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usage Rate</label>
                                        <input type="number" class="form-control" v-model="data.rate">
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
            clinics: {},
            data: {
                _token: window.token,
                status: 1,
                clinic_id: '',
                name: null,
                supply_date: null,
                stock: null,
                unit_price: 0.01,
                rate: 0.00,
            },
        }
    },
    mounted() {
        this.getClinics();
    },
    methods: {
        getClinics: function () {
            axios.get('/getClinics').
            then(response => {
                this.clinics = response.data.clinics;
            })
        },
        sendForm: function () {
            axios.post('/equipments', this.data).
            then(response => {
                this.$root.success = response.data.message;
                setTimeout(function () {
                   window.location.href = '/equipments';
                }, 750)
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
