import { createStore } from 'vuex';

export default createStore({
  state: {
    loading: false,
  },
  mutations: {
    setLoading(state, value) {
      state.loading = value;
    },
  }
});
