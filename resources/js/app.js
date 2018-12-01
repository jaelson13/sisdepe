
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('login-component', require('./components/user/Login.vue'));
Vue.component('logout-component', require('./components/user/Logout.vue'));
Vue.component('users-component', require('./components/user/Users.vue'));
Vue.component('newuser-component', require('./components/user/NewUser.vue'));
Vue.component('edituser-component', require('./components/user/EditUser.vue'));
//Type of Ocurrence
Vue.component('typeofocurrence-component', require('./components/ocurrence_type/TypeOfOcurrence.vue'));
Vue.component('newtypeofocorrence-component', require('./components/ocurrence_type/NewTypeOfOcorrence.vue'));
Vue.component('edittypeofocorrence-component', require('./components/ocurrence_type/EditTypeOfOcorrence.vue'));
//Courses
Vue.component('courses-component', require('./components/course/Courses.vue'));
Vue.component('newcourse-component', require('./components/course/NewCourse.vue'));
Vue.component('editcourse-component', require('./components/course/EditCourse.vue'));
//Grades
Vue.component('grades-component', require('./components/grades/Grades.vue'));
Vue.component('newgrade-component', require('./components/grades/NewGrade.vue'));
Vue.component('editgrade-component', require('./components/grades/EditGrade.vue'));
//Course Users
Vue.component('courseusers-component', require('./components/course_users/CourseUsers.vue'));
Vue.component('courseaddusers-component', require('./components/course_users/CourseAddUsers.vue'));
//Sidebar
Vue.component('sidebar-component', require('./components/layout/Sidebar.vue'));
//Ocurrences
Vue.component('ocurrences-component', require('./components/ocurrence/Ocurrences.vue'));
Vue.component('newocurrence-component', require('./components/ocurrence/NewOcurrence.vue'));
Vue.component('editocurrence-component', require('./components/ocurrence/EditOcurrence.vue'));
//Projects
Vue.component('projects-component', require('./components/project/Projects.vue'));
Vue.component('newproject-component', require('./components/project/NewProject.vue'));
//Ocurrences Coordinator
Vue.component('ocurrencescoordinator-component', require('./components/ocurrence_coordinator/Ocurrences.vue'));



// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
