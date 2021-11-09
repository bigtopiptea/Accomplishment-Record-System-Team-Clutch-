<template>
    <Head title="Tasks" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tasks
            </h2>
            
            <Link v-if="$page.props.auth.user.roles[0].name == 'head of office'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full absolute" style="top: 82px; right: 50px" :href="route('tasks.create')">
                Create Tasks
            </Link>
        </template>
        <div class="py-5">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Tasks</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <BreezeValidationErrors class="mb-4" />
                            <form @submit="submitTasks" >
                                <div class="mb-3">
                                    <input type="text" name="taskIds" class="form-control border border-gray-200 rounded hidden" id="recipient-name" v-model="taskIds">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="taskName" class="form-control border border-gray-200 rounded hidden" id="recipient-name" v-model="taskName">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="taskDue" class="form-control border border-gray-200 rounded hidden" id="recipient-name" v-model="taskDue">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="taskAssignedBy" class="form-control border border-gray-200 rounded hidden" id="recipient-name" v-model="taskAssignedBy">
                                </div>
                                <div class="mb-3">
                                    <label for="staff-id" class="col-form-label">Select Staff:</label>
                                        <select name="selectedUserId" v-model="selectedUserId" class="appearance-none border border-gray-200 rounded w-full py-2 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                                <option v-for="user in users" :key="user.id" >
                                                    {{user.name}}
                                                </option>
                                        </select>
                                </div>
                                <!-- <div class="tag-input">
                                    <div v-for="(tag, index) in tags" :key="tag" class="tag-input__tag bg-green-200 text-green-700" >
                                        <span @click="removeTag(index)">x</span>
                                        {{tag.name}}
                                    </div>
                                </div>
                                <input @keydown="addTag" class="mt-4 appearance-none block w-full border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Enter Staff Name">
                                <div class="bg-white shadow p-2 flex border-b border-gray-200 sm:rounded-lg w-1/4 mb-2" >
                                    <span class="w-auto flex justify-end items-center text-gray-500 p-2">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input v-model="user" @keyup="searchUser" class="w-full rounded p-2 border-none" type="text" placeholder="Search">
                                </div>-->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <BreezeButton class="ml-0">
                                        Submit
                                    </BreezeButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: 20px;">
                <!-- search -->
                <div class="bg-white shadow p-2 flex border-b border-gray-200 sm:rounded-lg w-1/4 mb-2" >
                    <span class="w-auto flex justify-end items-center text-gray-500 p-2">
                        <i class="fas fa-search"></i>
                    </span>
                    <input v-model="task" @keyup="search" class="w-full rounded p-2 border-none" type="text" placeholder="Search">
                </div>
                <Pagination :links="tasks.links" class="float-right" style="margin-top: -56px; margin-right: 350px"></Pagination>
                <!-- end search -->
              
                <!-- assign task button -->
                <button style="margin-top: -50px;" type="button" :class="hasTaskSelected ? 'float-right btn btn-primary' : 'float-right btn btn-primary disabled'" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Assign Tasks</button>
               
                <button @click="destroy" style="margin-top: -50px; margin-right: 130px;" type="button" :class="hasTaskSelected ? 'float-right btn btn-danger' : 'float-right btn btn-danger disabled'">Delete Tasks</button>
                    
                    <transition name="slide-fade">
                        <div v-if="$page.props.error && visible"  class="absolute flex max-w-xs mt-4 mr-4 top-60 right-0 rounded shadow p-4 bg-red-500 text-white" >
                        
                            <span class="inline-block align-middle mr-8 whitespace-normal">
                                <b class="capitalize">Oopss! </b> {{$page.props.error}}
                            </span>
                        </div>
                    </transition>
                     <transition name="slide-fade">
                        <div v-if="$page.props.success && visible"  class="absolute flex max-w-xs mt-4 mr-4 top-60 right-0 rounded shadow p-4 bg-green-500 text-white" >
                        
                            <span class="inline-block align-middle mr-8 whitespace-normal	">
                                <b class="capitalize">Excellent! </b>{{$page.props.success}}
                            </span>
                        </div>
                    </transition>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table v-if="(typeof tasks.data[0] !== 'undefined')" class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <input type="checkbox" v-model="isCheckAll" @click="checkAll"/>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    ID
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tasks Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Assigned By
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tasks Start
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tasks Due
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Check Submissions
                                                </th>
                                                <th v-if="$page.props.auth.user.roles[0].name == 'head of office' || $page.props.auth.user.roles[0].name == 'staff' "  scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody  v-for="task in tasks.data" v-bind:key="task.id" class="bg-white divide-y divide-gray-200 text-transform:capitalize">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        <input type="checkbox" v-model="task.isSelected" />
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{task.id}}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 text-center">
                                                        {{ task.name }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 text-center">
                                                        {{ task.assigned_by }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 text-center">
                                                        {{ task.task_start }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 text-center">
                                                        {{ task.task_due }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 text-center">
                                                        <a :href="route('tasks.submission', task.id)" class="text-blue-500">Check Submission <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full no-underline">{{task.upload_files.length}}</span></a>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <Link type="button" :href="route('tasks.edit', task.id)" class="text-blue-500 p-2 underline cursor-pointer focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" aria-label="Edit Table" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                        Edit
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="px-6 py-4" v-else >
                                        No Tasks Created Yet
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-cloak class="h-full">
                <Toast :toast="$page.props.toast"></Toast>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link, useForm, computed } from "@inertiajs/inertia-vue3";
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { Inertia } from '@inertiajs/inertia'
import Pagination from '@/Components/Pagination.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Pagination,
        BreezeButton,
        BreezeValidationErrors
    },
    props: {
        tasks: Object,
        users: Object,
    },
    data(){
        return {
            task: "",
            user: '',
            tags: [],
            taskArray: [],
            isCheckAll: false,
            selectedUserId: "",
            visible: false,
        }
    },
    computed: {
        taskIds() {
            let ids = [];
            this.taskArray.map(task => {
                if(task.isSelected) {
                    ids.push(task.id)
                }
            });
            return ids;
        },
        taskName(){
            let name = [];
            this.taskArray.map(task => {
                if(task.isSelected){
                    name.push(task.name)
                }
            });
            return name;
        },
        taskDue(){
            let task_due = [];
            this.taskArray.map(task => {
                if(task.isSelected){
                    task_due.push(task.task_due)
                }
            });
            return task_due;
        },
        taskAssignedBy(){
            let assigned_by = [];
            this.taskArray.map(task => {
                if(task.isSelected){
                    assigned_by.push(task.assigned_by)
                }
            });
            return assigned_by;
        },
        hasTaskSelected() {
            this.taskId = this.taskIds;
            return this.taskIds.length >= 1;
        },
    },
    mounted() {
        this.taskArray = this.tasks.data;
        this.taskArray.map(task => {
            task.isSelected = false;
            return task;
        });
        this.tags = this.users;

        this.show();
    },

    methods: {
        addTag(event){
            if(event.code == 'Comma' || event.code == 'Enter'){
                event.preventDefault();
                var val = event.target.value.trim();

                if(val.length > 0){
                    this.tags.push(val);
                    event.target.value = '';
                }
            }
        },
        removeTag(index){
            this.tags.splice(index, 1);
        },
        show: function (){
           let v = this;
           v.visible = true;
           setTimeout(function (){
               return v.visible = false;
           }, 1500);
        },
        destroy() {
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
                    Inertia.delete('tasks/'+ this.taskIds);
                    window.location.reload();
                }
            });
        },
        search() {
            Inertia.replace(this.route('tasks.index', {task: this.task}));
        },
        searchuser(){
            Inertia.replace(this.route('tasks.index', {user: this.user}))
        },
        checkAll() {
            this.taskArray.map(task => {
                task.isSelected = !this.isCheckAll;
                return task;
            });
        },
        submitTasks() {
            Inertia.post('/assignment', {
                taskIds: this.taskIds,
                taskName: this.taskName,
                taskDue: this.taskDue,
                taskAssignedBy: this.taskAssignedBy,
                staff_name: this.selectedUserId,
            });
            // window.location.reload();
        },
    },
};
</script>

<style>
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
    transition: all .5s ease;
    }
    .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
    }

    .tag-input {
        width: 100%;
        border: 1px solid #eee;
        font-size: 0.9em;
        height: 100px;
        box-sizing: border-box;
        padding: 0 10px;
    }

    .tag-input__tag {
        height: 30px;
        float: left;
        margin-right: 10px;
        margin-top: 10px;
        line-height: 30px;
        padding: 0 5px;
        border-radius: 5px;
    }

    .tag-input__tag > span {
        cursor: pointer;
        opacity: 0.75;
    }

    .tag-input__text {
        outline: none;
        font-size: 0.9em;
        line-height: 35px;
        background: none;
    }
</style>
