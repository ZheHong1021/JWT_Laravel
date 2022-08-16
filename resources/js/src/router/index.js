import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// 用來載入 view的函式(可以省下打很多程式碼的時間)
function loadView(view) {
    return () => import(`../views/${view}.vue`);
}

const routes = [
    { // 路由一
        path: '/',
        name: 'Home',
        component: loadView("Home"),
    },
    { // 路由二
        path: '/about',
        name: 'About',
        component: loadView("About")
    },
]

const router = new VueRouter({ // 定義一個 VueRouter實例
    routes // 將剛剛設定的路由載入進去
})

export default router // 回傳