<template>
    <Head title="Roles" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles
                <div class="-mt-2 relative text-gray-700 w-1/4 float-right">
                    <input v-model="form.role_name" required class="w-full h-10 pl-3 pr-8 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text"/>
                    <Link @click="createRole()"
                        class="text-sm
                        absolute
                        inset-y-0
                        right-0
                        flex items-center
                        px-4
                        font-bold
                        text-white
                        bg-blue-500
                        rounded-r-lg
                        hover:bg-indigo-500
                        focus:bg-indigo-700">
                        Add New Role</Link>
                </div>
                <div v-if="$page.props.error" class="alert alert-danger mr-5" role="alert" 
                style=
                "float: right;
                width: 20%;
                margin-top: -15px;
                font-size: 15px;">
                   {{$page.props.error}}
                </div>
                <div v-if="$page.props.success" class="alert alert-success mr-5" role="alert" 
                style=
                "float: right;
                width: 20%;
                margin-top: -15px;
                font-size: 15px;">
                   {{$page.props.success}}
                </div>
            </h2>
        </template>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50 capitalize">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                                    ID
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                                    Role
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="role in roles" v-bind:key="role.id" class="capitalize">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ role.id }}
                                                    </div>
                                                </td> <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ role.name }}
                                                    </div>
                                                </td>
                                                <td class="flex space-x-4 px-2 py-4 whitespace-nowraptext text-smfont-medium" style="width: 5%;">
                                                    <Link type="button" :href="route('roles.edit', role.id)" class="text-yellow-500 p-2 border-transparent cursor-pointer focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="Edit Table" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" />
                                                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                            <line x1="16" y1="5" x2="19" y2="8" />
                                                        </svg>
                                                    </Link>

                                                    <Link type="button" v-on:click="deleteRole(role.id)" class="text-red-500 p-2 border-transparent cursor-pointer rounded focus:outline-none" aria-label="delete table" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" >
                                                            <path stroke="none" d="M0 0h24v24H0z" />
                                                            <line x1="4" y1="7" x2="20" y2="7" />
                                                            <line x1="10" y1="11" x2="10" y2="17" />
                                                            <line x1="14" y1="11" x2="14" y2="17" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2/dist/sweetalert2.js';
import { Inertia } from '@inertiajs/inertia';
import Input from '@/Components/Input.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Input,
        BreezeValidationErrors,
        Pagination
    },
    props: {
        roles: Object,
    },
    data() {
       return{
            form: {
                role_name: ""
            }
       }
    },
    methods: {
        createRole(){
            let data = new FormData();
            data.append("role_name", this.form.role_name);
            Inertia.post('/roles', data)
            this.form.role_name = "";
        },
        deleteRole(id)
        {
            Swal.fire({
                title: 'Are you Sure?',
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if(result.isConfirmed){
                    Inertia.delete(`/roles/${id}`);
                }
            });
        }
    },
}
</script>