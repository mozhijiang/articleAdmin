import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login.vue'

import Main from "@/views/Main.vue"

import MyMessage from "@/views/Main/MyMessage"
import ArticleList from "@/views/Main/ArticleList"
import ArticleAdd from "@/views/Main/ArticleAdd"
import ArticleDetail from "@/views/Main/article/ArticleDetail"
import ArticleType from "@/views/Main/articleAdmin/ArticleType"
import CommentAdmin from "@/views/Main/articleAdmin/CommentAdmin"
import UserAdmin from "@/views/Main/articleAdmin/UserAdmin"
Vue.use(Router)
const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'main',
      component: Main,
      redirect : "/article-list",
      children : [
        {
          path: '/article-list',
          component: ArticleList,
        },
        {
          path: "/article-detail",
          component: ArticleDetail
        },
        {
          path: "/article-add",
          component: ArticleAdd,
        },
        {
          path: "/article-type",
          component: ArticleType
        },
        {
          path: "/comment-admin",
          component: CommentAdmin
        },
        {
          path: "/user-admin",
          component: UserAdmin
        }
      ]
    },
    {
      path: "/my-message",
      component: MyMessage
    },
    {
      path: "/login",
      component: Login
    }
  ]
})
export default router;