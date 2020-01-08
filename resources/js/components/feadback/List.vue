<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <button type="button" class="btn btn-success action-link" tabindex="-1" @click="showCreateFeadbackForm">
            Create New feacback
        </button>
        <div v-if="feadbacks.length> 0">
            <div class="card card-default" v-for="feadback in feadbacks" style="margin-top:10px;">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="starIcons">
                            <span v-for="n in feadback.not"> 
                                <font-awesome-icon :icon="['fas', 'star']" />
                            </span>
                        </div>
                        <span style="text-transform: uppercase;font-weight: bold;">{{feadback.title}}</span>
                        <span style="flot:right;" v-if="feadback.is_private">Private</span>
                        <span style="flot:right;" v-else>Public</span>
                    </div>
                </div>
                <div class="card-body">
                    <p style="vertical-align: middle;">{{feadback.commant}}</p>
                    <p style="vertical-align: middle;" v-if="feadback.comand_num ">Command numbre: {{feadback.comand_num}}</p>
                    <p>
                        <span style="vertical-align: middle;" v-if="feadback.exp_date_start ">Start Date: {{feadback.exp_date_start}}</span>
                        <span style="vertical-align: middle;" v-if="feadback.exp_date_fin "> | End Date: {{feadback.exp_date_fin}}</span>
                    </p>
                    <p style="vertical-align: middle;">
                        <!-- Edit Button -->
                        <!-- <button type="button" class="btn btn-primary action-link" tabindex="-1" @click="edit(feadback)">
                            Edit
                        </button> -->
                        <!-- Delete Button -->
                        <!-- <button type="button" class="action-link btn btn-danger" @click="destroy(feadback)">
                            Delete
                        </button> -->
                    </p>
                </div>
            </div>
        </div>
        <div class="mb-0" v-if="feadbacks.length === 0">
           <p> no feacback founds!.</p>
        </div>
        <!-- Create Client Modal -->
        <div class="modal fade" id="modal-create-feadback" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="text-transform: uppercase;font-weight: bold;">
                            Set your feadback
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in createForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Feadback Form -->
                        <form role="form">
                            <!-- Not -->
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">Give a general rating</label>
                                <div class="col-md-12">
                                    <span class="selectedStars" > 
                                        <font-awesome-icon v-for="n in 5" v-bind:key="createForm.not" class="selected" icon="star" size="lg" />
                                    </span>
                                    <input id="create-feadback-not" type="hidden" class="form-control" @keyup.enter="store" v-model="createForm.not">
                                    <span class="form-text text-muted " style="display:none">
                                        Give a general rating; by selecting starts.
                                    </span>
                                </div>
                            </div>
                            <!-- Commant -->
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">Your feadback</label>
                                <div class="col-md-12">
                                    <textarea rows="5" cols="15" class="form-control" name="commant" @keyup.enter="store" v-model="createForm.commant"/>
                                </div>
                                <span class="form-text text-danger text-valadation ">
                                    The input value must be between 10-10000 characters.
                                </span>
                            </div>

                            <!-- title -->
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">Feadback Title</label>
                                <div class="col-md-12">
                                    <input id="create-feadback-title" type="text" class="form-control form-control-lg" @keyup.enter="store" v-model="createForm.title"
                                    placeholder="Add a title to your feadback">
                                    <span class="form-text text-danger text-valadation " style="display:none">
                                        The input value must be between 10-255 characters.
                                    </span>
                                </div>
                            </div>

                            <!-- experionce date -->
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">Date of your experience <small style="color:#ccc">(Optional)</small></label>
                                <div class="col-md-12">
                                    <label for="create-feadback-exp_date_fin">
                                        with a duration (vacation, work):
                                        <a href="#" @click="add_exp_date_fin" class="small_link_event"> Add end date</a>
                                    </label>
                                    <input id="create-feadback-exp_date_fin" type="date" class="date-input form-control form-control-lg" style="display:none" @keyup.enter="store" v-model="createForm.exp_date_fin">
                                    <input id="create-feadback-exp_date_start" type="date" class="date-input form-control form-control-lg" @keyup.enter="store" v-model="createForm.exp_date_start">
                                </div>
                            </div>

                            <!-- command numbre -->
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">
                                    <a href="#" @click="add_comand_num" class="small_link_event">Put your order number</a>
                                    <small style="color:#ccc">(Optional)</small>
                                </label>
                                <div class="col-md-12">
                                    <input id="create-feadback-comand_num" type="date" class="date-input form-control form-control-lg" style="display:none" @keyup.enter="store" v-model="createForm.comand_num">
                                </div>
                            </div>
                            

                            <!-- accepting conditions -->
                            <div class="form-group row">
                                <label class="col-md-12">
                                    By clicking on Publish, I acknowledge having read and accept 
                                    <a href="#" @click="add_comand_num" class="small_link_conditions ">The Terms of Use</a>
                                </label>
                                <div class="col-md-12">
                                    <input id="create-feadback-comand_num" type="date" class="date-input form-control form-control-lg" style="display:none" @keyup.enter="store" v-model="createForm.comand_num">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <div class="is_private">
                            <label class="public_label">Public</label>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <button type="button" class="btn btn-supre" @click="store">
                            Publish your feadback
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Client Modal -->
        <div class="modal fade" id="modal-edit-feadback" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Feadback
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in editForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="update">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   

    export default {
        /*
         * The component's data.
         myDate : new Date().toISOString().slice(0,10)
         */
        data() {
            return {
                feadbacks: [],

                createForm: {
                    errors: [],
                    name: '',
                    redirect: '',
                    confidential: true
                },

                editForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getFeadbacks();

                $('#modal-create-feadback').on('shown.bs.modal', () => {
                    $('#create-feadback-name').focus();
                });

                $('#modal-edit-feadback').on('shown.bs.modal', () => {
                    $('#edit-feadback-name').focus();
                });
            },

            /**
             * Get all of the Feadbacks.
             */
            getFeadbacks() {
                axios.get('/api/feadback')
                        .then(response => {
                            this.feadbacks = response.data.data;
                            // console.log(response.data.data);
                            // console.log(this.feadbacks.data.length);
                            // this.length = this.feadbacks.data.length;
                        });
            },

            /**
             * Show the form for creating new Feadback.
             */
            showCreateFeadbackForm() {
                $('#modal-create-feadback').modal('show');
            },

            /**
             * Create a new feadback for the user.
             */
            store() {
                this.persistClient(
                    'post', '/api/feadback',
                    this.createForm, '#modal-create-feadback'
                );
            },

            /**
             * Edit the given feadback.
             */
            edit(feadback) {
                this.editForm.id = feadback.id;
                this.editForm.name = feadback.name;
                this.editForm.redirect = feadback.redirect;

                $('#modal-edit-feadback').modal('show');
            },

            /**
             * Update the feadback being edited.
             */
            update() {
                this.persistFeadback(
                    'put', '/api/feadback/' + this.editForm.id,
                    this.editForm, '#modal-edit-feadback'
                );
            },

            /**
             * Persist the feadback to storage using the given form.
             */
            persistFeadback(method, uri, form, modal) {
                form.errors = [];
                axios[method](uri, form)
                    .then(response => {
                        this.getFeadbacks();
                        form.name = '';
                        form.redirect = '';
                        form.errors = [];
                        $(modal).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Destroy the given feadback.
             */
            destroy(feadback) {
                axios.delete('/api/feadback/' + feadback.id)
                        .then(response => {
                            this.getFeadbacks();
                        });
            }
        }
    }
</script>
