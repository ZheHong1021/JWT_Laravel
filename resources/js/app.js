require('./bootstrap');

import Vue from 'vue';
import App from './src/App.vue' // 引入組件
import router from './src/router'
import vuetify from './src/plugins/vuetify' // path to vuetify export

const vm = new Vue({ // 建立 Vue Instance
    /* Options */
    el: '#app', // 掛載 Vue Instance的元素(等等會設定在html的標籤中)
    router,
    vuetify, 
    render: h => h(App), // (箭頭函式) 將App.vue組件進行渲染
})

// 透過 $mount 掛載至指定的網頁節點(上面已經有用 el，則這行可以不使用)
// vm.$mount( "#app" )