<template>
    <Head title="Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Profile
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-rows-2 grid-flow-col">
                        <div class="row-span-3 mt-4 ml-5">
                            <div class="rounded-full w-40 flex items-center justify-center ml-10 p-4" style="margin: 0 auto;">
                                <div class="flex items-center">
                                    <img src="https://www.shareicon.net/data/512x512/2016/07/26/802043_man_512x512.png" />
                                </div>
                            </div>
                            <label class="mt-5 font-bold text-center">
                                Upload Profile Picture:
                            </label>
                            <br>
                            <input type="file" />
                        </div>
                        <div class="row-span-2 col-span-2 ...">
                            <form class="w-full p-5" style="margin: 0 auto;">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 font-bold">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            ID
                                        </label>
                                        {{users.id}}
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 capitalize font-bold">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                            Role
                                        </label>
                                        {{users.roles[0].name}}
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mt-4">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Name
                                        </label>
                                        <input v-model="form.name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" >
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mt-4">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                            Email
                                        </label>
                                        <input v-model="form.email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Password
                                        </label>
                                        <input  v-model="form.password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="password">
                                    </div>
                                </div>
                                <div class="md:flex md:items-center">
                                    <div class="md:w-1/3"></div>
                                    <div class="md:w-2/3">
                                        <Link class="float-right shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button" v-on:click="updateProfile()">
                                            Submit
                                        </Link>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';
import Input from '@/Components/Input.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Input
    },
    props: {
        users: Object,
    },
    setup(props){
        const form = useForm({
            id: props.users.id,
            name: props.users.name,
            password: props.users.password,
            email: props.users.email,
            role: props.users.roles[0].name,
        });
        return { form };
    },
    methods: {
        updateProfile(){
            this.form.put(route("roles.update", this.users.id));
        },
    }
}
</script>
