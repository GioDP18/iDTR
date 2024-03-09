import { createStore } from 'vuex';

export default createStore({
  state: {
    loading: false,
    loginError: null,
  },
  mutations: {
    setLoading(state, value) {
      state.loading = value;
    },
    setLoginError(state, value) {
      state.loginError = value;
    }
  }
});
