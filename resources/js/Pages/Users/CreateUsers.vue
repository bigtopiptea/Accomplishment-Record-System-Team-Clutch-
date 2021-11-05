<template>
    <Head title="Create Tasks" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <BreezeValidationErrors class="mb-4" />
                        <form class="w-full max-w-lg" style="margin: 0 auto;">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Name
                                </label>
                                <input v-model="form.name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="test" placeholder="Name">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Email
                                </label>
                                <input v-model="form.email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    Password
                                </label>
                                <input v-model="form.password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" placeholder="******************">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                        Role
                                    </label>
                                    <div class="relative">
                                        <select v-model="form.selectRole" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option v-for="role in roles" v-bind:key="role.id">
                                                {{ role.name }}
                                            </option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <box-icon name='chevron-down'></box-icon>
                                        </div>
                                    </div>
                                </div>
                                 <div class="md:flex md:items-center" style="margin-top: 23px;">
                                    <div class="md:w-1/3"></div>
                                    <div class="md:w-2/3">
                                        <button v-on:click="createUsers()" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                                            Submit
                                        </button>
                                    </div>
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


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
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
                selectRole: ""
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

            // const Toast = Swal.mixin({
            // toast: true,
            // position: 'top-end',
            // showConfirmButton: false,
            // timer: 700,
            // timerProgressBar: true,
            // didOpen: (toast) => {
            //     toast.addEventListener('mouseenter', Swal.stopTimer)
            //     toast.addEventListener('mouseleave', Swal.resumeTimer)
            //     }
            // })

            // Toast.fire({
            // icon: 'success',
            // title: 'Signed in successfully',
            // })

            Inertia.post('/users', data)
        },
    },
};
</script>
