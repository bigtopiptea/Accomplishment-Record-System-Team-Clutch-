<template>
    <Head title="Submit Task" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Submit Task
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
                                     <label class="block text-gray-500 font-bold md:text-rightmb-1 md:mb-0 pr-4" for="tasks-name">
                                        Import File:
                                     </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input v-model="form.name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full  py-2 px-4  text-gray-700 leading-tight  focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" />
                                </div>
                            <div class="md:flex md:items-center">
                                <div class="md:w-1/3"></div>
                                <div class="md:w-2/3">
                                    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button" v-on:click="createTasks()">
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
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
    },
    props: {},
    data() {
        return {
            form: {
                name: "",
                description: "",
            },
        };
    },
    methods: {
        createTasks() {
            let data = new FormData();
            data.append("name", this.form.name);
            data.append("description", this.form.description);

            Inertia.post('/tasks', data)

            console.log(BreezeValidationErrors);
        },
    },
};
</script>