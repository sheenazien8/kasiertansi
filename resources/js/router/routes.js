import CategoryIndex from './../components/categories/Index.vue'
import CategoryCreate from './../components/categories/Create.vue'
import CategoryEdit from './../components/categories/Edit.vue'
import UnitIndex from './../components/units/Index.vue'
import UnitCreate from './../components/units/Create.vue'
import UnitEdit from './../components/units/Edit.vue'
import ItemIndex from './../components/items/Index.vue'
import ItemCreate from './../components/items/Create.vue'
import ItemEdit from './../components/items/Edit.vue'
import ItemEditStock from './../components/items/EditStock.vue'
import Dashboard from './../components/dashboard/Dashboard.vue'
import EmployeeIndex from './../components/employees/Index.vue'
import EmployeeCreate from './../components/employees/Create.vue'
import EmployeeEdit from './../components/employees/Edit.vue'
import SupplierIndex from './../components/suppliers/Index.vue'
import SupplierCreate from './../components/suppliers/Create.vue'
import SupplierEdit from './../components/suppliers/Edit.vue'
import PurchaseIndex from './../components/purchases/Index.vue'
import PurchaseCreate from './../components/purchases/Create.vue'
import PurchaseEdit from './../components/purchases/Edit.vue'
import ShowPurchasingDetail from './../components/purchasing_details/ShowPurchasingDetail.vue'
import AddPurchasingDetail from './../components/purchasing_details/Create.vue'
import EditPurchasingDetail from './../components/purchasing_details/Edit.vue'
import SpendingIndex from './../components/spendings/Index.vue'
import SpendingCreate from './../components/spendings/Create.vue'
import SpendingEdit from './../components/spendings/Edit.vue'
import SpendingShow from './../components/spendings/Show.vue'
import Cashier from './../components/cashiers/Index.vue'
import ManagementPermissionIndex from './../components/management_permission/Index.vue'
import ManagementPermissionCreate from './../components/management_permission/Create.vue'
import ManagementPermissionEdit from './../components/management_permission/Edit.vue'
import IncomeIndex from './../components/incomes/Index.vue'
import IncomeCreate from './../components/incomes/Create.vue'
import IncomeEdit from './../components/incomes/Edit.vue'
import IncomeShow from './../components/incomes/Show.vue'
import ShopIndex from './../components/shops/Index.vue'
import ShopCreate from './../components/shops/Create.vue'
import ShopEdit from './../components/shops/Edit.vue'
import Login from './../components/auth/Login.vue'
import Register from './../components/auth/Register.vue'
import PageNotFound  from './../components/layouts/404.vue';
import CabangIndex from './../components/subsidiaries/Index.vue'
import CabangCreate from './../components/subsidiaries/Create.vue'
import CabangEdit from './../components/subsidiaries/Edit.vue'
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
  {
      path: '/subsidiary',
      name: 'subsidiary',
      component: CabangIndex,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/subsidiary/create',
      name: 'subsidiary.create',
      component: CabangCreate,
      meta : {
        requiresAuth : true
      }
  },
  {
      path: '/subsidiary/edit/:id',
      name: 'subsidiary.edit',
      component: CabangEdit,
      meta : {
        requiresAuth : true
      }
  },
];
