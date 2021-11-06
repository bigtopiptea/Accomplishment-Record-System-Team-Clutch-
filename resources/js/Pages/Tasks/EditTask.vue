<template>
   <Head title="Edit Tasks" />
      <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Edit Tasks
            </h2>
        </template>
        <div class="py-12">
            <div style="width: 70%;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <BreezeValidationErrors class="mb-4" />
                        <form style="margin: 0 auto" @submit.prevent="updateTasks">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                        Task ID
                                    </label>
                                    <input disabled v-model="form.id" class="font-bold appearance-none block w-full border-none py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Tasks Name">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Task Start
                                    </label>
                                    {{tasks.task_start}}
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                        Task Name
                                    </label>
                                    <input v-model="form.name" class="appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Tasks Name">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Task Due
                                    </label>
                                    {{tasks.task_due}}
                                    <input v-model="form.task_due" class="mt-3 appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="datetime-local" />
                                </div>
                                <div class="w-full md:w-1/2 px-3" style="margin-top: -40px;">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Task Requirements
                                    </label>
                                    <textarea v-model="form.requirements" style="height: 250px;" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                        Reference
                                    </label>
                                    <p v-if="tasks.reference == 'No Reference Uploaded'" class="text-black " >{{tasks.reference}}
                                    </p>
                                    <a v-else class="text-blue-600 cursor-pointer" >{{tasks.reference.substring(0, 15)+ ".." }}
                                    </a>
                                </div>
                                <div class="w-full md:w-1/2 px-3" style="margin-left:400px">
                                    <BreezeButton class="ml-0 float-right" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'
import BreezeButton from '@/Components/Button.vue';
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
        BreezeButton
    },
    setup(props){
        const form = useForm({
            id: props.tasks.id,
            name: props.tasks.name,
            requirements: props.tasks.requirements,
            task_start: props.tasks.task_start,
            task_due: props.tasks.task_due,
            isOverdue: props.isOverdue
        });
        return { form };
    },
    props: {
        tasks: Object,
    },
    methods: {
        updateTasks(){
            this.form.put(route("tasks.update", this.tasks.id));
        }
    },

};
</script>
