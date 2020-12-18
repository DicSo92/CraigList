import Vue from 'vue'
import Vuex from 'vuex'

import departments from './departments'
import user from './user'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        departments,
        user,
    },
    strict: debug,
})
