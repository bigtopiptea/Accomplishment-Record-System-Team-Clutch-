<template>
    <transition name="slide-fade">
        <div v-if="toast && visible" class="absolute flex max-w-xs mt-4 mr-4 top-60 right-0 rounded shadow p-4 bg-green-500 text-white" >
            <span class="inline-block align-middle mr-8 whitespace-nowrap	">
                <b class="capitalize">Excellent! </b>{{toast.message}}

            </span>
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