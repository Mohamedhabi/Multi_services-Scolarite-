<template>
  <div id="app">
    <div id="nav">
      <navbar></navbar>
    </div>
    <router-view />
  </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.min.css'
import Navbar from './components/Navbar'
export default {
  components:{
      navbar:Navbar

  }
}
</script>
