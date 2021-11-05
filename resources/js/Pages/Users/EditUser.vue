<template>
    <Head title="Edit User" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <BreezeValidationErrors class="mb-4" />
                        <form class="w-full max-w-sm" style="margin: 0 auto">
                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="tasks-status">
                                            ID
                                        </label>
                                    </div>
                                    <div class="md:w-2/3">
                                        <input disabled v-model="form.id" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full  py-2 px-4  text-gray-700 leading-tight  focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" />
                                    </div>
                                 </div>
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="tasks-status">
                                        Name
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input v-model="form.name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full  py-2 px-4  text-gray-700 leading-tight  focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" />
                                </div>
                            </div>
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="tasks-body">
                                        Email
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input v-model="form.email" class=" bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text"/>
                                </div>
                            </div>
                             <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="tasks-status">
                                        Role
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <select selected v-model="form.role" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                        <option v-for="role in $page.props.allRoles.role" :key="role.id" >
                                            {{ role.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="md:flex md:items-center">
                                <div class="md:w-1/3"></div>
                                <div class="md:w-2/3">
                                    <Link class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button" v-on:click="updateUser()">
                                        Submit
                                    </Link>
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
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'
import { Link } from "@inertiajs/inertia-vue3";


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
        Link
    },
    setup(props){
        const form = useForm({
            id: props.users.id,
            name: props.users.name,
            email: props.users.email,
            role: props.users.roles[0].name,
        });
        return { form };
    },
    props: {
        users: Object,
        roles: Object,
    },
    methods: {
        updateUser(){
            this.form.put(route("users.update", this.users.id));
        },
    },
};
</script>
