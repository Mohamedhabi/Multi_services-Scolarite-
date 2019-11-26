<template>
  <div>
    <h3>{{student.last_name}} {{student.first_name}} </h3>
    <p class="ml-7">  {{student.email}}</p>
    <p class="ml-4">       {{student.level}}</p>
</div>
</template>

<script>
export default {
    data() {
        return {
         student: null,
        }
    },
    created(){
        this.student=this.$store.getters.get_Student;
    }
}
</script>

<style>

</style>