<template>
<div>
    <h3>{{student.last_name}} {{student.first_name}} </h3>
    <p class="ml-7">  {{student.email}}</p>
    <p class="ml-4">       {{student.level}}</p>
    <div class="text-right">
        <button @click="deleteStudent" class="btn btn-danger brn-sm">Delete</button>
    </div>
</div>
</template>

<script>

export default {
    data(){
        return {
            res: "",
        }
    },
    props:['student'],
    methods:{
        deleteStudent(){
            this.$emit('deleteStudent',this.student.id)
        }

    }
}
</script>

<style>

</style>