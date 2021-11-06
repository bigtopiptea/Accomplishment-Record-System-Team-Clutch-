<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in! Staff Dashboard!
                        <transition name="slide-fade">
                            <div v-if="$page.props.success && visible" class="absolute flex max-w-xs mt-4 mr-4 top-60 right-0 rounded shadow p-4 bg-green-500 text-white" >
                                <span class="inline-block align-middle mr-8 whitespace-nowrap	">
                                    {{$page.props.success}}
                                </span>
                            </div>
                        </transition>
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
    data() {
       return{
            visible: false,
       }
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
    mounted() {
        this.show();

    },
}
</script>
