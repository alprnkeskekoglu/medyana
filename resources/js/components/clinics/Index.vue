<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="row w-100">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search..." v-model="params.search">
                </div>
                <div class="col-md-4">
                    <select class="form-control" v-model="params.sort">
                        <option value="">Sort By</option>
                        <option value="a-z">Name (A-Z)</option>
                        <option value="z-a">Name (Z-A)</option>
                        <option value="h-l">Equipment (High-Low)</option>
                        <option value="l-h">Equipment (Low-High)</option>
                    </select>
                </div>
                <div class="col-md-2 offset-md-2 text-right">
                    <a href="/clinics/create" class="btn btn-sm btn-primary" data-toggle="click-ripple">
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
                    <th>Name</th>
                    <th class="text-center">Equipment Count</th>
                    <th>Created At</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="clinic in clinics">
                    <th class="text-center" scope="row" v-html="clinic.id"></th>
                    <th class="text-center">
                        <span :class="'badge ' + (clinic.status == 1 ? 'badge-success' : 'badge-danger')">{{ clinic.status == 1 ? 'Active' : 'Passive' }}</span>
                    </th>
                    <td class="font-w600">
                        <a :href="'/clinics/' + clinic.id + '/edit'" v-html="clinic.name"></a>
                    </td>
                    <td class="text-center" v-html="clinic.equipment_count"></td>
                    <td class="d-none d-sm-table-cell" v-html="clinic.created_at"></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a :href="'/clinics/' + clinic.id + '/edit'" class="btn btn-sm btn-info js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" @click="deleteClinic(clinic.id)">
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
            links: {},
            params: {
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
                this.getClinics();
            }
        }
    },
    mounted() {
        this.getClinics();

    },
    methods: {
        getClinics: function () {
            axios.get('/getClinicByParams', {
                params: this.params
            }).
            then(response => {
                this.clinics = response.data.clinics;
                this.links = response.data.links;

                console.log(this.clinics);
            })
        },
        deleteClinic: function (id) {
            if(confirm('Are You Sure?')) {
                axios.delete('/clinics/' + id).
                then(response => {
                    this.$root.success = response.data.message;
                    this.getClinics();
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
