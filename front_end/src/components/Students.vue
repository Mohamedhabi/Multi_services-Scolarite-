<template>
<div>
    <h2 class="display-4 text-center mt-5">List of students</h2>
    <circle-spin id="circle" v-show="isLoading"></circle-spin>
    <div class="col-md-6 offset-md-3">   
        <ul  class="list-group">
            <li class="list-group-item" v-bind:key="student.id" v-for="student in students">
                <Student v-bind:student="student" v-on:deleteStudent="deleteOneStudent"/>
            </li>
        </ul>
    </div>
    
</div>
  
</template>

<script>
import Student from './Student'
import axios from 'axios'

export default {
    name:"Students",
    components:{
        Student,
    },
    data(){
        return {
            error: "",
            isLoading: true,
            students:[
            ]
        }
    },
    methods:{
        getStudents(){
             axios.get("http://localhost:8000/api/auth/student", {
                 headers:{
                    Authorization:"Bearer"+this.$store.getters.get_token
                 }
             })
            .then(res => {
                this.isLoading = false;
                this.students=res.data.data
            })  .catch(err => {
                this.isLoading = false;
                this.error=err
            })
        },
        deleteOneStudent(id){
            if(confirm('Are you sure to delete this student ('+id+')?')){
                axios.delete("http://localhost:8000/api/auth/student/"+id, {
                 headers:{
                    Authorization:"Bearer"+this.$store.getters.get_token
                 }
                })
                .then(res => {
                    this.students=this.students.filter(student=>student.id!=id)
                    this.res=res
                    this.$router.push("/Students");

                })  .catch(err => {
                    this.error=err
                })
            }
        }
    },
    created(){
        this.getStudents();
    }
}
</script>

<style>

</style>