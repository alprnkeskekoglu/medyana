<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="row w-100">
                <div class="col-md-4">
                    <select class="form-control" v-model="params.clinic_id">
                        <option value="">Please Select Clinic</option>
                        <option v-for="clinic in clinics" :value="clinic.id" v-html="clinic.name"></option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search..." v-model="params.search">
                </div>
                <div class="col-md-3">
                    <select class="form-control" v-model="params.sort">
                        <option value="">Sort By</option>
                        <option value="a-z">Name (A-Z)</option>
                        <option value="z-a">Name (Z-A)</option>
                        <option value="rhl">Usage Rate (High-Low)</option>
                        <option value="rlh">Usage Rate (Low-High)</option>
                        <option value="phl">Unit Price (High-Low)</option>
                        <option value="plh">Unit Price (Low-High)</option>
                    </select>
                </div>
                <div class="col-md-2 text-right">
                    <a href="/equipments/create" class="btn btn-sm btn-primary" data-toggle="click-ripple">
                        <i class="fa fa-fw fa-plus mr-1"></i>
                        Add New
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content">
            <table class="table table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Status</th>
                    <th>Clinic Name</th>
                    <th>Name</th>
                    <th>Unite Price</th>
                    <th>Usage Rate</th>
                    <th>Created At</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="equipment in equipments">
                    <th class="text-center" scope="row" v-html="equipment.id">1</th>
                    <th class="text-center">
                        <span :class="'badge ' + (equipment.status == 1 ? 'badge-success' : 'badge-danger')">{{ equipment.status == 1 ? 'Active' : 'Passive' }}</span>
                    </th>
                    <td class="font-w600">
                        <a :href="'/clinics/' + equipment.clinic.id + '/edit'" v-html="equipment.clinic.name"></a>
                    </td>
                    <td class="font-w600">
                        <a :href="'/equipments/' + equipment.id + '/edit'" v-html="equipment.name"></a>
                    </td>
                    <td class="d-none d-sm-table-cell" v-html="equipment.unit_price"></td>
                    <td class="d-none d-sm-table-cell" v-html="equipment.rate + '%'"></td>
                    <td class="d-none d-sm-table-cell" v-html="equipment.created_at"></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a :href="'/equipments/' + equipment.id + '/edit'" class="btn btn-sm btn-info js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" @click="deleteEquipment(equipment.id)">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="mt-5 mb-3">
                <div class="btn-group">
                    <button type="button" :class="'btn btn-sm btn-primary ' + (links.prev ? '' : 'disabled')" @click="params.page = links.first" data-toggle="tooltip" title="Prev">
                        <i class="fa fa-angle-double-left"></i>
                    </button>
                    <button type="button" :class="'btn btn-sm btn-primary ' + (links.prev ? '' : 'disabled')" @click="params.page = links.prev" data-toggle="tooltip" title="Prev">
                        <i class="fa fa-chevron-left"></i>
                    </button>

                    <button type="button" :class="'btn btn-sm btn-primary ' + (links.next ? '' : 'disabled')" @click="params.page = links.next" data-toggle="tooltip" title="Next">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                    <button type="button" :class="'btn btn-sm btn-primary ' + (links.next ? '' : 'disabled')" @click="params.page = links.last" data-toggle="tooltip" title="Next">
                        <i class="fa fa-angle-double-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    data() {
        return {
            clinics: {},
            equipments: {},
            links: {},
            params: {
                clinic_id: '',
                search: '',
                sort: '',
                page: 1,
            }
        }
    },
    watch: {
        params: {
            deep: true,
            handler: function () {
                this.getEquipments();
            }
        }
    },
    mounted() {
        this.getEquipments();
        this.getClinics();
    },
    methods: {
        getClinics: function () {
            axios.get('/getClinics').
            then(response => {
                this.clinics = response.data.clinics;
            })
        },
        getEquipments: function () {
            axios.get('/getEquipments', {
                params: this.params
            }).
            then(response => {
                this.equipments = response.data.equipments;
                this.links = response.data.links;
            })
        },
        deleteEquipment: function (id) {
            if(confirm('Are You Sure?')) {
                axios.delete('/equipments/' + id).
                then(response => {
                    this.$root.success = response.data.message;
                    this.getEquipments();
                }).catch(e => {
                    this.$root.success = null;
                    this.$root.errors = e.response.data.errors;
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
