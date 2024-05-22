const Login = () => import('../Views/Login.vue');
const Register = () => import('../Views/Register.vue');
const Products = () => import('../Views/Products.vue');
const Welcome = () => import('../Views/Welcome.vue')

export default [{
    path: '/',
    component: Welcome,
    name: 'welcome',
},
{
    path: '/products',
    component: Products,
    name: 'products',
    meta: {
        guard: 'auth'
    }
},
{
    path: '/login',
    component: Login,
    name: 'login',
    meta: {
        guard: 'guest'
    }
},
{
    path: '/register',
    component: Register,
    name: 'register',
    meta: {
        guard: 'guest'
    }
},
{
    path: '/:pathMatch(.*)*',
    redirect: '/home',

}
];
