<template>
     <Head title="Create Tasks" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Tasks
            </h2>
        </template>
        <div class="py-12">
            <div style="width: 70%;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <BreezeValidationErrors class="mb-4" />
                            <form style="margin: 0 auto"
                                  @submit.prevent="createTasks"
                                  method="post"
                                  enctype="multipart/form-data"
                            >
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                        Task Name
                                    </label>
                                    <input v-model="task_name" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Tasks Name">
                                </div>

                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Task Due
                                    </label>
                                    <input v-model="task_due" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="datetime-local" />
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Task Requirements
                                    </label>
                                    <textarea v-model="task_requirements" style="height: 250px;" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Reference
                                    </label>
                                    <input v-on:change="reference" type="file" name="file[]" multiple/>
                                </div>

                                <div class="w-full md:w-1/2 px-3" style="margin-top:20px;">
                                    <BreezeButton class="ml-0">
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
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import { Link } from "@inertiajs/inertia-vue3";
import BreezeButton from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
        Link,
        BreezeButton,
        Input
    },
    props: {
        users: Array,
    },
    data() {
        return {
            staffArray: [],
            file: null,
            selectedValue: null,
        }
    },
    computed: {
        staff_id(){
            let ids = [];
            this.staffArray.map(user => {
                ids.push(user);
            });
        }
    },
    mounted() {
        this.staffArray = this.users;
    },
    methods: {
        reference(event){
            this.file = event.target.files[0];
        },
        createTasks() {
            Inertia.post('/tasks', {
                    task_name: this.task_name,
                    task_requirements: this.task_requirements,
                    task_due: this.task_due,
                    file: this.file,
            });
            
        },
},
};
</script>
