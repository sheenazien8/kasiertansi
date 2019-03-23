import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import CategoryIndex from './../views/categories/Index.vue'
import CategoryCreate from './../views/categories/Create.vue'
import CategoryEdit from './../views/categories/Edit.vue'
import UnitIndex from './../views/units/Index.vue'
import UnitCreate from './../views/units/Create.vue'
import UnitEdit from './../views/units/Edit.vue'
import ItemIndex from './../views/items/Index.vue'
import ItemCreate from './../views/items/Create.vue'
import ItemEdit from './../views/items/Edit.vue'
import ItemEditStock from './../views/items/EditStock.vue'
import Dashboard from './../components/Dashboard.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
        },
        {
            path: '/category',
            name: 'category',
            component: CategoryIndex,
        },
        {
            path: '/category/create',
            name: 'category.create',
            component: CategoryCreate,
        },
        {
            path: '/category/edit/:id',
            name: 'category.edit',
            component: CategoryEdit,
        },
        {
            path: '/unit',
            name: 'unit',
            component: UnitIndex,
        },
        {
            path: '/unit/create',
            name: 'unit.create',
            component: UnitCreate,
        },
        {
            path: '/unit/edit/:id',
            name: 'unit.edit',
            component: UnitEdit,
        },
        {
            path: '/item',
            name: 'item',
            component: ItemIndex,
        },
        {
            path: '/item/create',
            name: 'item.create',
            component: ItemCreate,
        },
        {
            path: '/item/edit/:id',
            name: 'item.edit',
            component: ItemEdit,
        },
        {
            path: '/item/edit/stock/:id',
            name: 'item.edit.stock',
            component: ItemEditStock,
        },
    ],
});


export default router;
