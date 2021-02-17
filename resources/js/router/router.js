import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

/* ===================== Register Documents Components Route ===========================*/
import mainTodo from '../components/mainTodoComponent.vue' ;


/* ===================== Register Forms Components Route ===========================*/

const routes = [
    {
        path : '/todo' ,
        component : mainTodo
    },
    // {
    //     path : '/registration' ,
    //     component : Registration ,
    //     children:[
    //         { path :'/registration/contact' , component : Contact_Registration},
    //         { path :'/registration/reservation/:fileNumber/:consultant_id' , component : Reservation },
    //     ] ,
    // },

    // {
    //     path:'/admin/config',
    //     name:'configtime',
    //     component:ConfigTime,
    // },
];

const router= new VueRouter({
    routes ,
    hashbang : false,
    mode:'history'
}) ;

export default router ;
