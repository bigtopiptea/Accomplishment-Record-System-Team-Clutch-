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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" v-for="task in tasks" :key="task.id">
                        <div class="float-right">
                             <span v-if="task.status == 'To be Verified'" class="px-2 py-2 inline-flex text-1xl leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                {{ task.status }}
                            </span>
                            <span v-if="task.status == 'Unfinished'" class="px-2 py-2inline-flex text-1xl leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                {{ task.status }}
                            </span>
                            <span v-if="task.status == 'Verified'" class="px-2 py-2 inline-flex text-1xl leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ task.status }}
                            </span>
                        </div>
                        <h1 class="text-4xl font-bold">{{task.name}}</h1>
                            <div>
                                <p class="font-bold">Task Due: {{task.task_due}} 12:AM</p>
                            </div>
                        <br>
                        <div><p class="font-bold">Requirements:</p>
                            {{task.description}}
                        </div>
                        <br>
                        <br>

                        <input type="file" />

                        <button v-if="task.status != 'Verified'" class="float-right px-3 py-2 inline-flex text-sm text-white bg-blue-400 rounded hover:bg-blue-900">
                            Submit
                        </button>
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
    props:{
        tasks: Object,
    }
}
</script>
