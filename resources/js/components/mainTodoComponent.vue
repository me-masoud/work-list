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
            <li><form action="/logout" method="post"><button type="submit">خروج از حساب کاربری</button></form></li>
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
<!--                    <ul style="display:inline-grid">-->
<!--                        <li v-for="task in tasks" :key="task.id">-->
<!--                            <input type="text" v-model="task.title" @blur="updateTask(task.title,task.description ,task.id)">-->
<!--                        </li>-->
<!--                    </ul>-->
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
                <ul style="list-style: none">
                    <li v-for="item in task" :key="item.id">
                        <span @click="deleteTask(item.id)" style="color: red">حذف</span>
                        <span v-if="item.status == 'active'">
                           <span class="ActiveDot" @click="updateTask(item.title, item.description , item.id , 'done')"></span>
                        </span>
                        <span v-else>
                           <span class="DoneDot" @click="updateTask(item.title, item.descripiton , item.id , 'active')"></span>
                        </span>
                        <textarea  v-if="edit == item.id" type="text" v-model="item.title" @blur="updateTask(item.title,item.description,item.id , item.status)"></textarea>
                        <span v-else @click="setEdit(item.id)">{{item.title}} </span>

                        </li>
                </ul>
            </div>
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
            edit:0,
        }
    },
    methods: {
        moment(){return moment()},
        saveTask(){
            let that = this
            axios.post('/postmytask' , this.myTask).then(function(response){
                that.myTask.title = null
                that.getTodayTasks()
                that.getTasks(moment().lang("en").startOf('month').format('YYYY-MM-DD') , moment().lang("en").format('YYYY-MM-DD'))
            })
        },
        getTodayTasks(){
            let that = this
            axios.get('/gettodaytasks').then(function(response){
                that.tasks = response.data
            })
        },
        getTasks(start , end){
            let that = this
            axios.get('/gettasks/'+ start +'/'+end).then(function(response){
               if(response.status == 200 && response.statusText == 'OK'){
                   that.allTasks = response.data
               }
            })
        },
        updateTask(title, description , id,status){
            let stagedTask = {
                title : title,
                descripiton:description,
                id: id,
                status:status,
            }
            let that = this
            axios.post('/updatetask' , stagedTask).then(function(response){
                if(response.status == 200){
                    that.setEdit(null)
                    that.getTasks(moment().lang("en").startOf('month').format('YYYY-MM-DD') , moment().lang("en").format('YYYY-MM-DD'))
                }
            })
        },
        setEdit(id) {
            this.edit = id
        },
        deleteTask(id){
            let record = {
                id : id,
            }
            let that = this
            axios.post('/deletetask' , record).then(function (response) {
                if(response.status == 200){
                    that.setEdit(null)
                    that.getTasks(moment().lang("en").startOf('month').format('YYYY-MM-DD') , moment().lang("en").format('YYYY-MM-DD'))
                }
            })
        }
    },
    created() {
        this.getTodayTasks()
        this.getTasks(moment().startOf('month').format('YYYY-MM-DD') , moment().format('YYYY-MM-DD'))
    },
    mounted() {
        moment.updateLocale("fa", {
        });
    },

}
</script>
<style scoped>
    .DoneDot {
        height: 25px;
        width: 25px;
        background-color: #68c943;
        border-radius: 50%;
        display: inline-block;
    }
    .ActiveDot {
        height: 25px;
        width: 25px;
        background-color: #14eaca;
        border-radius: 50%;
        display: inline-block;
    }
</style>
