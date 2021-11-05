<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12 w-2/4" style="margin:0 auto;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" >
                    <form class="p-10">
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                    Role ID
                                </label>
                            </div>
                            <div class="md:w-2/3 ml-6 font-bold">
                                    {{roles.role_id}}
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                    Role Name
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input v-model="form.role_name" style="border-top: 1px; border-left: none; border-right: none;" class="text-black appearance-none py-2 px-4 leading-tight" id="inline-full-name" type="text">
                            </div>
                        </div>
                        <div class="md:flex md:items-center">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-2/3">
                            <Link v-on:click="updateRole" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                                Confirm
                            </Link>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, useForm, Link  } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link
    },
    props: {
        roles: Object.roles
    },
    setup(props){
        const form = useForm({
            role_id: props.roles.role_id,    
            role_name: props.roles.role_name,    
        });
        return { form };
    },
    methods: {
        updateRole(){
            this.form.put(route('roles.updates', this.roles.role_id));
        }
    }
}
</script>
