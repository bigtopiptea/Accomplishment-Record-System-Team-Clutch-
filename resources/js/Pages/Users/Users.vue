<template>
    <Head title="Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
            <!-- <Link v-if="$page.props.auth.user.roles[0].name == 'admin'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full absolute" style="top: 82px; right: 50px" :href="route('users.create')">
                Create User
            </Link> -->
        </template>
        <transition name="slide-fade">
            <div v-if="$page.props.success && visible" class="absolute flex max-w-xs mt-4 mr-4 top-60 right-0 rounded shadow p-4 bg-green-500 text-white" >
                <span class="inline-block align-middle mr-8 whitespace-nowrap	">
                    {{$page.props.success}}
                </span>
            </div>
        </transition>
        <!-- User List-->
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: 20px;">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">                  
                    <div class="mx-auto container bg-white dark:bg-gray-800 dark:bg-gray-800 shadow rounded">
                        <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
                            <div class="w-full lg:w-1/3 flex flex-col lg:flex-row items-start lg:items-center">
                                <div class="flex items-center">
                                    <button class="text-gray-600 dark:text-gray-400 p-2 border-transparent border bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 hover:bg-gray-200 cursor-pointer rounded focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="Edit Table" role="button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </button>
                                    <button class="text-gray-600 dark:text-gray-400 mx-2 p-2 border-transparent border bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 hover:bg-gray-200 cursor-pointer rounded focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="table settings" role="button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-settings" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                    <button class="text-gray-600 dark:text-gray-400 mr-2 p-2 border-transparent border bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 hover:bg-gray-200 cursor-pointer rounded focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="Bookmark" role="button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bookmark" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M9 4h6a2 2 0 0 1 2 2v14l-5-3l-5 3v-14a2 2 0 0 1 2 -2" />
                                        </svg>
                                    </button>
                                    <button class="text-gray-600 dark:text-gray-400 mr-2 p-2 border-transparent border bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 hover:bg-gray-200 cursor-pointer rounded focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="copy table" role="button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <rect x="8" y="8" width="12" height="12" rx="2" />
                                            <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" />
                                        </svg>
                                    </button>
                                    <button class="text-red-500 p-2 border-transparent border bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 hover:bg-gray-200 cursor-pointer rounded focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="delete table" role="button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-white shadow p-2 flex border-b border-gray-200 sm:rounded-lg" style="width: 30%;">
                                <span class="w-auto flex justify-end items-center text-gray-500 p-2">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input v-model="user" @keyup="search" class="w-full rounded p-2 border-none" type="text" placeholder="Search">
                            </div>

                            <Pagination :links="users.links"></Pagination>
                            <!-- pagination -->
                            <!-- <div class="w-full lg:w-2/3 flex flex-col lg:flex-row items-start lg:items-center justify-end">
                                <div class="flex items-center lg:border-l lg:border-r border-gray-300 py-3 lg:py-0 lg:px-6">
                                    <p class="text-base text-gray-600 dark:text-gray-400" id="page-view">Viewing 1 - 20 of 60</p>
                                    <button class="text-gray-600 dark:text-gray-400 ml-2 border-transparent border cursor-pointer rounded focus:outline-none focus:ring-2 focus:ring-gray-500 " onclick="pageView(false)" aria-label="Goto previous page " role="button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <polyline points="15 6 9 12 15 18" />
                                        </svg>
                                    </button>
                                    <button class="text-gray-600 dark:text-gray-400 border-transparent border rounded focus:outline-none focus:ring-2 focus:ring-gray-500 cursor-pointer" aria-label="goto next page" role="button" onclick="pageView(true)">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <polyline points="9 6 15 12 9 18" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="lg:ml-6 flex items-center">
                                    <button class="bg-gray-200 transition duration-150 ease-in-out focus:outline-none border border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 hover:bg-gray-300 rounded text-indigo-700 px-5 h-8 flex items-center text-sm">Download All</button>
                                    <button role="button" aria-label="add table" class="text-white ml-4 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 border border-transparent bg-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 w-8 h-8 rounded flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <line x1="12" y1="5" x2="12" y2="19" />
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                        </svg>
                                    </button>
                                </div>
                            </div> -->
                            <!-- end pagination -->
                        </div>
                        <div class="w-full overflow-x-scroll xl:overflow-x-hidden">
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr class="w-full h-16 border-gray-300 border-b py-8">
                                        <th class="pl-8 text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">
                                            <!-- <input placeholder="check box" type="checkbox" class="cursor-pointer relative w-5 h-5 border rounded border-gray-400 bg-white dark:bg-gray-800 focus:outline-none focus:outline-none focus:ring-2  focus:ring-gray-400"/> -->
                                            <input type="checkbox"/>
                                        </th>   
                                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">User ID</th>
                                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Name</th>
                                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Email</th>
                                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Position</th>
                                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Role</th>
                                        <th v-if="$page.props.auth.user.roles[0].name == 'admin'"  style="padding-left: 25px;" role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Actions</th>

                                    </tr>
                                </thead>
                                <tbody v-for="user in users.data" :key="user.id" >
                                    <tr class="h-24 border-gray-300 border-b">
                                        <td class="pl-8 pr-6 text-left whitespace-no-wrap text-sm text-gray-800 dark:text-gray-100 tracking-normal leading-4">
                                            <!-- <input placeholder="check box" type="checkbox" class="cursor-pointer relative w-5 h-5 border rounded border-gray-400 bg-white dark:bg-gray-800 focus:outline-none focus:outline-none focus:ring-2  focus:ring-gray-400" onclick="tableInteract(this)" /> -->
                                            <input type="checkbox" />
                                        </td>
                                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{user.id}}</td>
                                        <td class="pr-6 whitespace-no-wrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8">
                                                    <img src="https://tuk-cdn.s3.amazonaws.com/assets/components/advance_tables/at_1.png" alt="Display Avatar of Carrie Anthony" role="img" class="h-full w-full rounded-full overflow-hidden shadow" />
                                                </div>
                                                <p class="ml-2 text-gray-800 dark:text-gray-100 tracking-normal leading-4 text-sm">{{user.name}}</p>
                                            </div>
                                        </td>                                     
                                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{user.email}}</td>
                                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{user.position}}</td>
                                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{user.roles[0].name}}</td>
                                        <td v-if="$page.props.auth.user.roles[0].name == 'admin'"  class="flex space-x-4 px-2 py-4 whitespace-nowraptext text-smfont-medium" style="width: 5%;">
                                            <Link :href="route('users.edit', user.id)" class="text-blue-500 p-2 border-transparent cursor-pointer focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="Edit Table" role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                    <line x1="16" y1="5" x2="19" y2="8" />
                                                </svg>
                                            </Link>
                                            <Link v-on:click="destroy(user.id)" class="text-red-500 p-2 border-transparent cursor-pointer rounded focus:outline-none" aria-label="delete table" role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Button from "@/Components/Button.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'
import Swal, { swal } from 'sweetalert2/dist/sweetalert2.js'
import { Can } from '@casl/vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    props: {
        users: Object,
    },
    data(){
        return {
            visible: false,
            user: ""
        }
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Button,
        Link,
        Can,
        Pagination
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
        destroy(id){
            Swal.fire({
                title: 'Are you Sure?',
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if(result.isConfirmed){
                Inertia.delete(`/users/${id}`);
                window.location.reload();

                }
            });

        },
        search(){
            Inertia.replace(this.route('users.index', {user: this.user}));    
        }
    }
};
</script>
