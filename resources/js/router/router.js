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
import Login from './../views/auth/Login.vue'
import EmployeeIndex from './../views/employees/Index.vue'
import EmployeeCreate from './../views/employees/Create.vue'
import EmployeeEdit from './../views/employees/Edit.vue'
import SupplierIndex from './../views/suppliers/Index.vue'
import SupplierCreate from './../views/suppliers/Create.vue'
import SupplierEdit from './../views/suppliers/Edit.vue'
import PurchaseIndex from './../views/purchases/Index.vue'
import PurchaseCreate from './../views/purchases/Create.vue'
import PurchaseEdit from './../views/purchases/Edit.vue'
import ShowPurchasingDetail from './../views/purchasing_details/ShowPurchasingDetail.vue'
import AddPurchasingDetail from './../views/purchasing_details/Create.vue'
import EditPurchasingDetail from './../views/purchasing_details/Edit.vue'
import SpendingIndex from './../views/spendings/Index.vue'
import SpendingCreate from './../views/spendings/Create.vue'
import SpendingEdit from './../views/spendings/Edit.vue'
import SpendingShow from './../views/spendings/Show.vue'
import Cashier from './../views/cashiers/Index.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/dashboard',
            name: 'dashboard',
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
        {
            path: '/employee',
            name: 'employee',
            component: EmployeeIndex,
        },
        {
            path: '/employee/create',
            name: 'employee.create',
            component: EmployeeCreate,
        },
        {
            path: '/employee/edit/:id',
            name: 'employee.edit',
            component: EmployeeEdit,
        },
        {
            path: '/supplier',
            name: 'supplier',
            component: SupplierIndex,
        },
        {
            path: '/supplier/create',
            name: 'supplier.create',
            component: SupplierCreate,
        },
        {
            path: '/supplier/edit/:id',
            name: 'supplier.edit',
            component: SupplierEdit,
        },
        {
            path: '/purchase',
            name: 'purchase',
            component: PurchaseIndex,
        },
        {
            path: '/purchase/create',
            name: 'purchase.create',
            component: PurchaseCreate,
        },
        {
            path: '/purchase/edit/:id',
            name: 'purchase.edit',
            component: PurchaseEdit,
        },
        {
            path: '/purchase/:id/purchasing_detail',
            name: 'purchasing_detail.index',
            component: ShowPurchasingDetail,
        },
        {
            path: '/purchase/:id/purchasing_detail/create',
            name: 'purchasing_detail.create',
            component: AddPurchasingDetail,
        },
        {
            path: '/purchase/:id/purchasing_detail/:id_purchasing_detail/edit',
            name: 'purchasing_detail.edit',
            component: AddPurchasingDetail,
        },
        {
            path: '/spending',
            name: 'spending',
            component: SpendingIndex,
        },
        {
            path: '/spending/create',
            name: 'spending.create',
            component: SpendingCreate,
        },
        {
            path: '/spending/edit/:id',
            name: 'spending.edit',
            component: SpendingEdit,
        },
        {
            path: '/spending/:date',
            name: 'spending.show',
            component: SpendingShow,
        },
        {
            path: '/cashier',
            name: 'cashier',
            component: Cashier,
        },
    ],
});


export default router;
