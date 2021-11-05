<template>
    <Head title="Create Tasks" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
        </template>

    <div class="py-12">
            <div style="width: 70%;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <BreezeValidationErrors class="mb-4" />
                            <form style="margin: 0 auto"
                                  @submit.prevent="createUsers"
                                 
                            >
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                       Name
                                    </label>
                                    <input v-model="form.name" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Name">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                       password
                                    </label>
                                    <input v-model="form.password" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="password" placeholder="Password">
                                </div>


                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Position
                                    </label>
                                    <select v-model="form.position" style="height: 55px;" class="appearance-none border border-gray-200 rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                        <option disabled value="">Please select one</option>
                                            <option>UNDERSECRETARIES</option>
                                            <option>ASSISTANT SECRETARIES</option>
                                            <option>DEPUTY CHIEF OF STAFF</option>
                                            <option>HEAD EXECUTIVE ASSISTANT</option>
                                            <option>SERVICE DIRECTORS</option>
                                            <option>BANNER PROGRAM COORDINATORS</option>
                                            <option>SPECIAL ASSISTANTS TO THE SECRETARY</option>
                                            <option>SECRETARY'S ADVISERS</option>
                                            <option>HEAD EXECUTIVE ASSISTANT</option>
                                            <option>SERVICE DIRECTORS</option>
                                    </select>      
                                </div>
                                 <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                       Email
                                    </label>
                                    <input v-model="form.email" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="email" placeholder="Email">
                                </div>
                              <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Role
                                    </label>
                                    <select v-model="form.selectRole" style="height: 55px;" class="appearance-none border border-gray-200 rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                        <option disabled value="">Please select one</option>
                                            <option>Admin</option>
                                            <option>Head of Office</option>
                                            <option>Staff</option>
                                    </select>      
                                </div>
                                <div class="w-full md:w-1/2 px-3" style="margin-top:20px;">
                                </div>
                                <div class="w-full md:w-1/2 px-3" style="margin-top:20px;">
                                </div>
                                <div class="w-full md:w-1/2 px-3" style="margin-top:20px;">
                                    <BreezeButton class="ml-0 float-right">
                                        Submit
                                    </BreezeButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { computed } from '@vue/reactivity';
import BreezeButton from '@/Components/Button.vue';


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
        BreezeButton

    },
    props: {
        roles: Array,
    },
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                selectRole: "",
                position: ""
            },
        };
    },
    methods: {
        createUsers() {

            let data = new FormData();
            data.append("name", this.form.name);
            data.append("email", this.form.email);
            data.append("password", this.form.password);
            data.append("selectRole", this.form.selectRole);
            data.append("position", this.form.position);


            Inertia.post('/users', data)
        },
    },
};
</script>
