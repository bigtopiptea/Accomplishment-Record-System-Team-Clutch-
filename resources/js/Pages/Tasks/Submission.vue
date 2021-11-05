<template>
    <Head title="Tasks Submissions" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tasks Submissions
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" >
                    <div class="p-6 border-b border-gray-200 grid gap-4 grid-cols-3" >
                        <div v-if="(typeof userUploads[0] === 'undefined')" >
                            No Submissions Yet
                        </div>
                        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-10" v-for="user in userUploads" :key="user.id">
                            <form >
                                <div>
                                    <div>
                                        <span v-if="user.task_status == 'To be Verified'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-500">
                                            {{user.task_status}}
                                        </span>
                                        <span v-else-if="user.task_status == 'Verified'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-500">
                                            {{user.task_status}}
                                        </span>
                                        <!-- <span v-else-if="(typeof user.task_status == 'undefined')" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-500">
                                            Unfinished
                                        </span> -->
                                    </div>
                                   
                                    <div class="flex justify-center md:justify-end -mt-16">
                                        <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
                                    </div>
                                    <div>
                                        <h2 class="text-gray-800 text-1xl font-semibold capitalize">{{user.submitted_by}}</h2>
                                        <p class="mt-2 text-gray-600">
                                            {{user.time_submitted}}
                                        </p>
                                        <p class="mt-2 text-gray-600">
                                            Submitted File(s):
                                        </p>
                                        <a :href="route('tasks.download1', user.storage_path)" class="text-blue-500"> {{user.storage_path}}</a>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-4 text-center" >
                                            Change Task Status
                                        </label>
                                        <div class="space-x-2" style="padding: 20px; padding-top:0px;">
                                            <Link v-on:click="destroy(user.id); updateStatus();">
                                                <button class="btn btn-danger mt-4 text-xs">
                                                    Unfinished
                                                </button>
                                            </Link>
                                            <Link :href="route('homework.update2', user.id)">
                                                <button  class="btn btn-warning mt-4 text-xs whitespace-nowrap">
                                                    To be Verified
                                                </button>
                                            </Link>
                                            <Link :href="route('homework.update3', user.id)">
                                                <button  class="btn btn-success mt-4 text-xs">
                                                    Verified
                                                </button>
                                            </Link>
                                        </div>
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
import BreezeButton from '@/Components/Button.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        BreezeButton
    },
    props: {
        userUploads: Object.userUploads,
        assignments: Object.assignments,
    },
    computed:{
        tobeVerified(){
            
        }
    },
    setup(props){
        const form = useForm({
            id: props.userUploads.id,
            status: props.userUploads.status,
        });
        return { form };
    },
    data(){
        return {
        taskArray: []

        }
    },
    methods: {
        destroy(id) {
            Inertia.delete(`/homework/${id}`);
        },
        updateStatus(){
            this.form.put(route("homework.update1", this.userUploads.id));
        }
    }
}
</script>
