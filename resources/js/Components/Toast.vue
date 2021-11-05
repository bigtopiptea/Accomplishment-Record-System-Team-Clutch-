<template>
    <transition name="slide-fade">
        <div v-if="toast && visible" class="absolute flex max-w-xs  mt-4 mr-4 top-60 right-0 rounded shadow p-4" style="background-color: #47d78a;">
            <div class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
                <div class="flex-1 text-grey-800 text-white">
                    {{toast.message}}
                </div>
        </div>
    </transition>
</template>

<script>
export default {
   props: {
       toast: Object,
   },
   data() {
       return{
           visible: false,
       }
   },
   methods:{
       show: function (){
           let v = this;
           v.visible = true;
           setTimeout(function (){
               return v.visible = false;
           }, 1500);
       }
   },
   mounted(){
       this.show();
   }

}
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

</style>