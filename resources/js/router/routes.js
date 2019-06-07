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
import Dashboard from './../views/dashboard/Dashboard.vue'
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
import ManagementPermissionIndex from './../views/management_permission/Index.vue'
import ManagementPermissionCreate from './../views/management_permission/Create.vue'
import ManagementPermissionEdit from './../views/management_permission/Edit.vue'
import IncomeIndex from './../views/incomes/Index.vue'
import IncomeCreate from './../views/incomes/Create.vue'
import IncomeEdit from './../views/incomes/Edit.vue'
import IncomeShow from './../views/incomes/Show.vue'
import ShopIndex from './../views/shops/Index.vue'
import ShopCreate from './../views/shops/Create.vue'
import ShopEdit from './../views/shops/Edit.vue'
import Login from './../views/auth/Login.vue'
import Register from './../views/auth/Register.vue'
import PageNotFound  from './../views/layouts/404.vue';

export const routes = [
  {
    path: "*",
    component: PageNotFound
  },
  {
      path: '/login',
      name: 'login',
      component: Login,
    },
  {
      path: '/register',
      name: 'register',
      component: Register
  },
  {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/category',
      name: 'category',
      component: CategoryIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/category/create',
      name: 'category.create',
      component: CategoryCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/category/edit/:id',
      name: 'category.edit',
      component: CategoryEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/unit',
      name: 'unit',
      component: UnitIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/unit/create',
      name: 'unit.create',
      component: UnitCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/unit/edit/:id',
      name: 'unit.edit',
      component: UnitEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/item',
      name: 'item',
      component: ItemIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/item/create',
      name: 'item.create',
      component: ItemCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/item/edit/:id',
      name: 'item.edit',
      component: ItemEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/item/edit/stock/:id',
      name: 'item.edit.stock',
      component: ItemEditStock,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/employee',
      name: 'employee',
      component: EmployeeIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/employee/create',
      name: 'employee.create',
      component: EmployeeCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/employee/edit/:id',
      name: 'employee.edit',
      component: EmployeeEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/supplier',
      name: 'supplier',
      component: SupplierIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/supplier/create',
      name: 'supplier.create',
      component: SupplierCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/supplier/edit/:id',
      name: 'supplier.edit',
      component: SupplierEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/purchase',
      name: 'purchase',
      component: PurchaseIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/purchase/create',
      name: 'purchase.create',
      component: PurchaseCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/purchase/edit/:id',
      name: 'purchase.edit',
      component: PurchaseEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/purchase/:id/purchasing_detail',
      name: 'purchasing_detail.index',
      component: ShowPurchasingDetail,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/purchase/:id/purchasing_detail/create',
      name: 'purchasing_detail.create',
      component: AddPurchasingDetail,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/purchase/:id/purchasing_detail/:id_purchasing_detail/edit',
      name: 'purchasing_detail.edit',
      component: AddPurchasingDetail,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/spending',
      name: 'spending',
      component: SpendingIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/spending/create',
      name: 'spending.create',
      component: SpendingCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/spending/edit/:id',
      name: 'spending.edit',
      component: SpendingEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/spending/:date',
      name: 'spending.show',
      component: SpendingShow,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/cashier',
      name: 'cashier',
      component: Cashier,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/management_permission',
      name: 'management_permission',
      component: ManagementPermissionIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/management_permission/create',
      name: 'management_permission.create',
      component: ManagementPermissionCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/management_permission/edit/:id',
      name: 'management_permission.edit',
      component: ManagementPermissionEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/income',
      name: 'income',
      component: IncomeIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/income/create',
      name: 'income.create',
      component: IncomeCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/income/edit/:id',
      name: 'income.edit',
      component: IncomeEdit,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/income/:date',
      name: 'income.show',
      component: IncomeShow,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/shop',
      name: 'shop',
      component: ShopIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/shop/create',
      name: 'shop.create',
      component: ShopCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/shop/edit/:id',
      name: 'shop.edit',
      component: ShopEdit,
      meta : {
        requiresAuth : true
      }
  },
];
