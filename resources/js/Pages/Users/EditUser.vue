<template>
    <Head title="Edit User" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
        </template>
        <div class="py-12">
            <div style="width: 70%;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <BreezeValidationErrors class="mb-4" />
                        <form style="margin: 0 auto" >
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                        User ID
                                    </label>
                                    <input v-model="form.id" disabled class="font-bold appearance-none block w-full border-none border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Name
                                    </label>
                                    <input v-model="form.name"  style="width: 50%;" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                        Email
                                    </label>
                                    <input v-model="form.email"  style="width: 50%;" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="email">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Current Position
                                    </label>
                                    {{users.position}}
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <div class="md:w-1/3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                            Role
                                        </label>
                                    </div>
                                    <div class="md:w-2/3">
                                        <select selected v-model="form.role" class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option v-for="role in $page.props.allRoles.role" :key="role.id" >
                                                {{ role.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Change Position
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
                                <div class="w-full md:w-1/2 px-3 mt-4" >
                              
                                </div>
                                <div @click="updateUser" class="w-full md:w-1/2 px-3 mt-4" >
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
import BreezeButton from '@/Components/Button.vue';

import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'
import { Link } from "@inertiajs/inertia-vue3";


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
        Link,
        BreezeButton
    },
    setup(props){
        const form = useForm({
            id: props.users.id,
            name: props.users.name,
            email: props.users.email,
            position: props.users.position,
            role: props.users.roles[0].name,
        });
        return { form };
    },
    props: {
        users: Object,
    },
    methods: {
        updateUser(){
            this.form.put(route("users.update", this.users.id));
        },
    },
};
</script>
