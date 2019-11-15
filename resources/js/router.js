import Vue from 'vue'
import Router from 'vue-router'
import TaskList from './components/TaskList'
import CreateTask from './components/CreateTask'

Vue.use(Router)


export default new Router({
    routes: [
        {
            path: '/',
            component: TaskList
        },
        {
            path: '/create-task',
            component: CreateTask
        }
    ]
})