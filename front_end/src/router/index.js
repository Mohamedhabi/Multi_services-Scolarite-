import Vue from "vue";
import VueRouter from "vue-router";
import Students from "../components/Students.vue";
import  Home  from "../views/Home.vue";
import  Login  from "../views/Login.vue";
import  StudentsLogin  from "../views/StudentLogin.vue";
import  StudentProfile  from "../views/StudentProfile.vue";
import  Add  from "../views/Add.vue";
import store from "../store";




Vue.use(VueRouter);


const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes:[
    {
      path: "/",
      name: "Home",
      component: Home,
    },
    {
      path: "/Login",
      name: "Login",
      component:Login,
      meta:{
        guest:true
      }
    },
    {
      path: "/Add",
      name: "Add",
      component:Add,
      meta:{
        secure:true
      }
    },
    {
      path: "/Students",
      name: "Students",
      component: Students,
      meta:{
        secure:true
      }
    },
    {
      path: "/Student/Login",
      name: "Student/Login",
      component: StudentsLogin,
      meta:{
        guest:true
      }
    },
    {
      path: "/Student/Profile",
      name: "Student/Profile",
      component: StudentProfile,
      meta:{
        requiresAuth:true
      }
    }
  ]
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.secure)) {
    if(store.state.StudentloggedIn){
      next({
        path: "/Student/Profile"
      });
    }else if (!store.state.loggedIn) {
      next({
        path: "/Login"
      });
    } else {
      next();
    }
  } 
  else if (to.matched.some(record => record.meta.requiresAuth)) {
    if(store.state.loggedIn){
      next({
        path: "/Students"
      });
    }else if (!store.state.StudentloggedIn) {
      next({
        path: "/Student/Login"
      });
    } else {
      next();
    }
  }
  else if (to.matched.some(record => record.meta.guest)) {
    if (store.state.loggedIn) {
      next({
        path: "/Students"
      });
    }else if (store.state.StudentloggedIn){
      next({
        path: "/Student/Profile"
      });
    }else{
      next();
    }
  } else {
      if (store.state.loggedIn) {
        next({
          path: "/Students"
        });
      }else if (store.state.StudentloggedIn){
        next({
          path: "/Student/Profile"
        });
      }else {
        next({
          path: "/Login"
        });
      }
    }
});

export default router;