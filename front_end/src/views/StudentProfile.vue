<template>
  
<div class="container py-4 my-2">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <img class="w-100 " src="../assets/Std.png" />
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <h2 class="font-weight-bold m-0">
                    {{student.last_name}} {{student.first_name}}
                </h2>
                <address class="m-0 pt-2 pl-0 pl-md-4 font-weight-light text-secondary">
                    <i class="fa fa-map-marker"></i>
                    {{student.adress}}
                </address>
            </div>
            <p class="h5 text-primary mt-2 d-block font-weight-light">
                Student
            </p>
            <section class="mt-4">
                <div class="tab-content py-4" id="myTabContent">
                    <div class="tab-pane py-3 fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h6 class="text-uppercase font-weight-light text-secondary">
                            Contact Information
                        </h6>
                        <dl class="row mt-4 mb-4 pb-3">
                            <dt class="col-sm-5">First name</dt>
                            <dd class="col-sm-7">{{student.first_name}}</dd>

                            <dt class="col-sm-5">Last name</dt>
                            <dd class="col-sm-7">{{student.last_name}}</dd>
                                
                             <dt class="col-sm-5">Level</dt>
                            <dd class="col-sm-7">{{student.level}}</dd>

                            <dt class="col-sm-5">Email address</dt>
                            <dd class="col-sm-7 text-primary">{{student.email}}</dd>                            
                            
                        </dl>
                        
                        <h6 class="text-uppercase font-weight-light text-secondary">
                            Personal Information
                        </h6>
                        <dl class="row mt-4 mb-4 pb-3">
                            
                            <dt class="col-sm-5">Home address</dt>
                            <dd class="col-sm-7">
                                <address class="mb-0">
                                    {{student.adress}}
                                </address>
                            </dd>

                            <dt class="col-sm-5">Birthday</dt>
                            <dd class="col-sm-7">{{student.birth_day}}</dd>
                            
                            <dt class="col-sm-5">Birthplace</dt>
                            <dd class="col-sm-7">{{student.birth_place}}</dd>
                        </dl>
                    </div>
                </div>
            </section>
        </div>
    </div>
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