<template>
    <Head title="Head Of Office List" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Head Of Office List
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                         <!-- v-if="(typeof assignments[0] !== 'undefined')"  -->
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Head of Office ID
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="user in users" :key="user.id" class="bg-white divide-y divide-gray-200text-transform:capitalize">
                                            <tr>

                                                <td class="text-center px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{user.id}}
                                                    </div>
                                                </td>
                                                <td class="text-center px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{user.name}}
                                                    </div>
                                                </td>
                                                 <td class="text-center px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{user.email}}
                                                    </div>
                                                </td>
                                                <td class="px-6 cursor-pointer py-4 whitespace-nowraptext text-smfont-medium text-center">
                                                    <a :href="route('hoh.check', user.id)" class="px-3 py-2 inline-flex text-sm text-white bg-blue-400 rounded hover:bg-blue-900">
                                                        View Tasks
                                                    </a>
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
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        users: Object,
    }
}
</script>
