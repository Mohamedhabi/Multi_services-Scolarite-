import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios'
import VuexPersistence from 'vuex-persist'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    token:null,
    loggedIn:false,
    user:null,
    StudentloggedIn:false,
    Student:null,
  },
  plugins: [new VuexPersistence().plugin],
  mutations: {
    SET_user(state, payload) {
      state.user = payload;
    },
    SET_token(state, payload) {
      state.token = payload;
    },
    SET_loggedIn(state, payload) {
      state.loggedIn = payload;
    },
    SET_StudentloggedIn(state, payload) {
      state.StudentloggedIn = payload;
    },
    SET_Student(state, payload) {
      state.Student = payload;
    }
  },
  actions: {
    performLoginAction({ commit }, payload) {
      return new Promise((resolve, reject) => {
        axios
          .post("http://localhost:8000/api/auth/login", {
            email: payload.email,
            password: payload.password
          })
          .then(res => {
            commit("SET_token", res.data.access_token);
            commit("SET_user", res.data.user);
            commit("SET_loggedIn", true);
            commit("SET_StudentloggedIn", false);
            commit("SET_Student", null);
            resolve(res);
          })
          .catch(err => {
            reject(err);
          });
      });
    },
    performStudentLoginAction({ commit }, payload) {
      return new Promise((resolve, reject) => {
        axios
          .post("http://127.0.0.1:9000/api/login", {
            email: payload.email,
            password: payload.password
          })
          .then(res => {
            commit("SET_token", null);
            commit("SET_loggedIn", false);
            commit("SET_user", null);
            commit("SET_StudentloggedIn", true);
            commit("SET_Student", res.data.data);
            resolve(res);
          })
          .catch(err => {
            reject(err);
          });
      });
    },
    performAddAction({state},payload) {
      return new Promise((resolve, reject) => {
        axios
          .post("http://127.0.0.1:8000/api/auth/student", {
            token:state.token,
            first_name: payload.first_name,
            last_name: payload.last_name,
            adress: payload.adress,
            birth_day:payload.birth_day,
            birth_place:payload.birth_place,
            level:payload.level,
          })
          .then(res => {
            resolve(res);
          })
          .catch(err => {
            reject(err);
          });
      });
    },
    performLogoutAction({ commit, state }) {
      return new Promise((resolve, reject) => {
        axios
          .post("http://localhost:8000/api/auth/logout", {
            token: state.token
          })
          .then(res => {
            commit("SET_token", null);
            commit("SET_loggedIn", false);
            commit("SET_user", null);
            resolve(res);
          })
          .catch(err => {
            commit("SET_token", null);
            commit("SET_loggedIn", false);
            commit("SET_user", null);
            reject(err);
          });
      });
    },
  },
  modules: {},
  getters:{
    get_StudentloggedIn(state) {
      return state.StudentloggedIn;
    },
    get_loggedIn(state) {
      return state.loggedIn;
    },
    get_user(state) {
      return state.user;
    },
    get_token(state) {
      return state.token;
    },
    get_Student(state) {
      return state.Student;
    },
  }
});