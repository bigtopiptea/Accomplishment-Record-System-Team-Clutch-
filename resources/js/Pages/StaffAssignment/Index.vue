<template>
    <Head title="Staff Assignment" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Assigned Tasks
            </h2>
        </template>
        <transition name="slide-fade">
                    <div v-if="$page.props.success && visible" class="absolute flex max-w-xs mt-4 mr-4 top-60 right-0 rounded shadow p-4 bg-green-500 text-white" >
                        <span class="inline-block align-middle mr-8 whitespace-normal	">
                            {{$page.props.success}}
                        </span>
                    </div>
        </transition>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table v-if="(typeof assignments[0] !== 'undefined')" class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Task ID
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Task Name
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Assigned By
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Task Due
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Task Status
                                                </th>
                                                 <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="homework in assignments" :key="homework.id" class="bg-white divide-y divide-gray-200text-transform:capitalize">

                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-center text-sm text-gray-900">
                                                        {{homework.task_id}}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-center text-sm text-gray-900">
                                                        {{homework.task_name}}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-center text-sm text-gray-900">
                                                        {{homework.assigned_by}}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-center text-sm text-gray-900">
                                                        {{homework.task_due}}
                                                    </div>
                                                </td>
                                                <td v-if="(typeof homework.upload_files[0] === 'undefined')" class="px-6 py-4 whitespace-nowraptext text-smfont-medium text-center">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-500">
                                                        Unfinished
                                                    </span>
                                                </td>
                                                <td v-else class="text-center px-6 py-4 whitespace-nowrap" v-for="test in homework.upload_files" :key="test.id" >
                                                     <span v-if="test.task_status == 'To be Verified'"  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-500">
                                                        {{test.task_status}}
                                                    </span>
                                                    <span v-if="test.task_status ==  'Verified'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-500">
                                                        {{test.task_status}}
                                                    </span>
                                                </td>
                                                <td class="px-6 cursor-pointer py-4 whitespace-nowraptext text-smfont-medium text-center">
                                                    <a :href="route('homework.edit', homework.id)" class="px-3 py-2 inline-flex text-sm text-white bg-blue-400 rounded hover:bg-blue-900">
                                                        View Task
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>

                                    <div v-else class="px-6 py-4" >
                                        No Tasks is Assigned Yet
                                    </div>
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
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link
    },
    props: {
        assignments: Object
    },
    data() {
       return{
            visible: false,

       }
    },
    mounted() {
        this.show();

    },
    methods: {
        show: function (){
           let v = this;
           v.visible = true;
           setTimeout(function (){
               return v.visible = false;
           }, 1500);
        },
      },
}
</script>