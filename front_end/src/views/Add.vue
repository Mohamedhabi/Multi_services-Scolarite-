<template>
  <div class="login">
    <div class>
      <div class="col-md-4 offset-md-4">
        <h2 class="display-4 text-center mt-5">Add new student</h2>

        <form action="#">
          <div class="form-group">
            <label for="first_name">First name</label>
            <input type="text" name="first_name" id="first_name" v-model="first_name" class="form-control" />
          </div>
          <div class="form-group">
            <label for="last_name">Last name</label>
            <input type="text" name="last_name" id="last_name" v-model="last_name" class="form-control" />
          </div>
          <div class="form-group">
            <label for="birth_day">Birth day</label>
            <input type="date" name="birth_day" id="birth_day" v-model="birth_day" class="form-control" />
          </div>
          <div class="form-group">
            <label for="birth_place">Birth place</label>
            <input type="text" name="birth_place" id="birth_place" v-model="birth_place" class="form-control" />
          </div>
          <div class="form-group">
            <label for="adress">Adress</label>
            <input type="text" name="adress" id="adress" v-model="adress" class="form-control" />
          </div>
          <div class="form-group">
            
        
            <label for="level">Level</label>
            <select class="form-control" id="level" name="level" v-model="level">
              <option value="1CP">1CP</option> 
              <option value="2CP" >2CP</option>
              <option value="1CS">1CS</option>
              <option value="2CS">2CS</option>
              <option value="3CS">3CS</option>
            </select>
          </div>
           <br>
          <div style="color:red;" v-if="error">{{ error }}</div>
          <div class="form-group">
            <button type="submit" class="btn btn-info btn-block" @click.prevent="performAdd">Add</button>
          </div>
        </form>

        <circle-spin v-show="isLoading"></circle-spin>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name:"Add",
    data() {
      return {
        first_name: "",
        last_name: "",
        adress: "",
        birth_day:"",
        birth_place:"",
        level:"",
        isLoading: false,
        error: "",
        res:""
      }
    },
    methods: {
        performAdd() {
            this.$store
            .dispatch("performAddAction", {
              first_name: this.first_name,
              last_name: this.last_name,
              adress: this.adress,
              birth_day:this.birth_day,
              birth_place:this.birth_place,
              level:this.level,
            })
            .then(res => {
              this.res=res;
              this.isLoading = false;
              this.$router.push("/Students");
            })
            .catch(err => {
              this.isLoading = false;
              this.error = err.message;
              if(err.response && err.response.status==500) this.error = err.response.data.message;
            });
        }
    }
}
</script>

<style>

</style>






            