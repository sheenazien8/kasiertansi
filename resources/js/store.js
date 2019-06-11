import {getLocalUser}  from './helpers/auth';

const user = getLocalUser();

export default {
  state: {
    currentUser : user,
    isLoggedIn:!!user,
    loading: false,
    auth_error: null,
    customers : []
  },
  getters: {
    isLoading(state){
      return state.loading;
    },
    isLoggedIn(state){
      return state.isLoggedIn;
    },
    currentUser(state){
      return state.currentUser;
    },
    authError(state){
      return state.auth_error;
    },
    customers(state){
      return state.auth_error;
    }
  },
  mutations:{
    login(state){
      state.loading = true;
      state.auth_error = null;
    },
    loginSuccess(state, payload){
      state.auth_error = null;
      state.isLoggedIn = true;
      state.loading = false;
      state.currentUser = Object.assign({},
        payload.user,
        {
          token: payload.token,
          permissions: payload.permissions,
          token_type : payload.token_type,
          expires_in : payload.expires_in,
        }
      );

      window.axios.defaults.headers.common['Authorization'] = state.currentUser.token_type +
      ' '+ state.currentUser.token;
      window.axios.defaults.headers.post['Content-Type'] = 'application/json';

      localStorage.setItem('user', JSON.stringify(state.currentUser), {
        expires : state.currentUser.expires_in ? 365 : 1
      });
    },
    loginFailed(state, payload){
      state.loading = false;
      state.auth_error = payload.error;
    },
    register(state){
      state.loading = true;
      state.auth_error = null;
    },
    registerSuccess(state, payload){
      // state.auth_error = null;
      // state.isLoggedIn = true;
      // state.loading = false;
      // state.currentUser = Object.assign({},
      //   payload.success.user,
      //   {
      //     token: payload.success.token,
      //     permissions: payload.success.permissions
      //   });

      // window.axios.defaults.headers.common['Authorization'] = 'Bearer '+ state.currentUser.token;
      // window.axios.defaults.headers.post['Content-Type'] = 'application/json';

      localStorage.setItem('user', JSON.stringify(state.currentUser));
    },
    registerFailed(state, payload){
      state.loading = false;
      state.auth_error = payload.error;
    },
    logout(state){
      localStorage.removeItem('user');
      state.isLoggedIn = false;
      state.currentUser = null;
    }
  },
  actions:{
    login(context){
      context.commit('login');
    },
    register(context){
      context.commit('register');
    }
  }
}
