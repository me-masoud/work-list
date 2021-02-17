<template>
<div>
      <header>

        <div class="logo">
            <img src="images/logo.png" title="loogo" alt="logo" width="40" height="40"/>

        <div class="text-logo">
            <h4>برنامه روزانه من</h4>
        </div>

    </div>

        <div class="date">
            <h5>امروز <span>{{m().format('dddd jD jMMMM')}}</span></h5>
        </div>
        <div class="hoshdar">
            <img src="images/alarm.png" width="40" height="40" alt="alarm" title="alarm"/>
        </div>
        <div class="home">
            <a href="/home">
            <img src="images/home.png" width="40" height="40" alt="home" title="home"/>
            </a>
        </div>
    </header>
    <div id="sidebar">

        <div class="menu">
            <ul>
            <li>برنامه های امروز</li>
            <li>کلیه برنامه ها</li>
            <li>برنامه های ویژه</li>
            <li>پروفایل من</li>
            <li><button @click="logout()">خروج از حساب کاربری</button></li>
        </ul>
        </div>

        <div class="today-worklist">

            <div class="twl-block">

                <div class="twlb-head">
                    <h4>لیست کار امروز</h4>
                </div>
                <div class="twl-body">
                    <input type="text" v-on:keyup.enter="saveTask()" name="title" v-model="myTask.title" placeholder="تسک مورد نظر را وارد کنید">
                    <button @click="saveTask()" id="Button">ثبت</button>
                    <ul style="display:inline-grid">
                        <li v-for="task in tasks" :key="task.id">
                            {{task.title}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="bodyfull">


        <div class="dayblock" v-for="(task , index) in allTasks" :key="task.id">
            <div class="db-head">
                <div class="db-date-name"><h4>{{m(index , 'YYYY-MM-DD').format('jMMMM jDD - dddd')}}</h4></div>
            </div>
            <div class="db-body">
                <ul>
                    <li v-for="item in task" :key="item.id">{{item.title}}({{item.status}})</li>
                </ul>
            </div>
        </div>
        <div class="today-ico">
            <a href="#" title="برنامه کاری امروز" ><img src="images/todayico.png" alt="برنامه کاری امروز" title="برنامه کاری امروز" width="70" height="70" /></a>
        </div>


    </div>
</div>
</template>
<script>
import moment from 'moment-jalaali';
export default {
    data() {
        return {
            m:moment,
            myTask:{
                title:null,
            },
            tasks:null,
            allTasks:null,
        }
    },
    methods: {
        moment(){return moment()},
        saveTask(){
            let that = this
            axios.post('/postmytask' , this.myTask).then(function(response){
                that.myTask.title = null
                that.getTodayTasks()
            })
        },
        getTodayTasks(){
            let that = this
            axios.get('/gettodaytasks').then(function(response){
                that.tasks = response.data
            })
        },
        getTasks(){
            let that = this
            axios.get('/gettasks/2021-02-13/2021-02-19').then(function(response){
               if(response.status == 200 && response.statusText == 'OK'){
                   that.allTasks = response.data
               }
            })
        },
        logout(){
            axios.post('/logout');
            location.reload()
        }
    },
    created() {
        this.getTodayTasks()
        this.getTasks()
    },
    mounted() {
        moment.updateLocale("fa", {
        });
    },

}
</script>
