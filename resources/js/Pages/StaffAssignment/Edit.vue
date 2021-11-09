<template>
    <Head title="Submit Assignment" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Submit Assignment
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 30px;">
                    <div v-if="(typeof assignment.upload_files[0] === 'undefined')">
                        <span class="float-right px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-500">
                            Unfinished
                        </span>
                    </div>
                    <div v-else>
                        <span v-if="assignment.upload_files[0].task_status == 'To be Verified'" class="float-right px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-500">
                            {{assignment.upload_files[0].task_status}}
                        </span>
                        <span v-if="assignment.upload_files[0].task_status == 'Unfinished'" class="float-right px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-500">
                            {{assignment.upload_files[0].task_status}}
                        </span>
                        <span v-if="assignment.upload_files[0].task_status == 'Verified'" class="float-right px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-500">
                            {{assignment.upload_files[0].task_status}}
                        </span>
                    </div>
                    <div class="p-6 bg-white border-gray-200" >
                          <form
                            @submit="updateStatus"
                            style="margin: 0 auto"
                            enctype="multipart/form-data"
                            method="post"
                            :action="route_slug"
                          >
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <input type="hidden" name="_token" :value="token" />

                                    <input v-model="assignment.id" name="task_id" type="text" class="hidden"/>

                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2">
                                            Task Name
                                        </label>
                                        {{assignment.name}}

                                    </div>
                                    <div v-if="assignment.isOverdue === true" class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-red-700 text-xl font-bold mb-2" for="grid-last-name">
                                            Task Due:
                                        </label>
                                        <p class="text-red-700">{{assignment.task_due}}</p>
                                    </div>
                                    <div v-else class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2" for="grid-last-name">
                                            Task Due:
                                        </label>
                                        {{assignment.task_due}}
                                    </div>
                                    <div v-if="assignment.reference === 'No Reference Uploaded'" class="w-full md:w-1/2 px-3"  style="margin-top: 10px;">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2" for="grid-last-name">
                                            Reference
                                        </label>
                                        {{assignment.reference}}
                                    </div>
                                    <div v-else class="w-full md:w-1/2 px-3" style="margin-top: 10px;">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2" for="grid-last-name">
                                            Reference
                                        </label>
                                        <a :href="route('tasks.download3', assignment.reference)" class="text-blue-600">{{assignment.reference}}</a>
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0" style="margin-top: 10px;">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2">
                                            Assigned By
                                        </label>
                                        {{assignment.assigned_by}}
                                    </div>
                                    <div class="w-full md:w-1/2 px-3" style="margin-top: 20px;">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2" for="grid-last-name">
                                            Requirements:
                                        </label>
                                        {{assignment.requirements}}
                                    </div>
                                    <div class="md:w-1/2 px-3" style="margin-top: 20px;" >
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Attachment
                                        </label>
                                        <input name="attachments[]" multiple required  type="file" style="color:transparent;" onchange="this.style.color = 'black';"/>
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-3">
                                            Recent Upload:
                                        </label>
                                        <a v-if="(typeof assignment.upload_files[0] != 'undefined')" :href="route('tasks.download2', assignment.upload_files[0].storage_path)" class="text-blue-500"> {{assignment.upload_files[0].storage_path}}</a>
                                    </div>
                                    <div class="w-full" style="margin-top:20px; margin-right: 20px;">
                                        <BreezeButton  class="ml-0 float-right" >
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
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
    },
    props:{
        assignment: Object,
        route_slug: Object.route_slug,
        token: Object.token
    },
    setup(props){
        const form = useForm({
            task_id: props.assignment.id,
        });
        return { form };
    },
    methods: {
        updateStatus(){
            this.form.put(route('status.update', this.assignment.id));
        }
    },
    ready() {
        updateStatus();
    }
}
</script>

<style>
.form-control:disabled, .form-control[readonly] {
    background-color: white !important;
}
</style>
