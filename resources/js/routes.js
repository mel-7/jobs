import Dashboard from './components/admin/Dashboard';
import PostList from './components/admin/posts/PostList';
import CreatePost from './components/admin/posts/CreatePost';
import CategoryList from './components/admin/posts/CategoryList';
import CustomFields from './components/admin/posts/CustomFields';
import EditPost from './components/admin/posts/EditPost';
import UserList from './components/admin/users/UserList';
import UserForm from './components/admin/users/UserForm';

import Cv from './components/applicants/Cv';
import Account from './components/applicants/Account';
import MyApplications from './components/applicants/MyApplications';
import MyMessages from './components/applicants/MyMessages';

import Jobs from './components/employer/Jobs';
import EmployerDashboard from './components/employer/EmployerDashboard';

export const routes = [
    {
        path: '/admin/dashboard',
        component: Dashboard,
    },
    {
        path: '/admin/posts',
        component: PostList,
    },
    {
        path: '/admin/post/create',
        component: CreatePost,
    },
    {
        path: '/admin/post/edit/:id',
        name: 'EditPost',
        component: EditPost,
        props: true
    },
    {
        path: '/admin/post/categories',
        component: CategoryList,
    },
    {
        path: '/admin/post/customfields',
        component: CustomFields,
    },
    {
        path: '/admin/users',
        component: UserList,
    },
    {
        path: '/admin/user/create',
        component: UserForm,
    },

    /**
     * Applicants Route
     */
    {
        path: '/u',
        name: 'Account',
        component: Account,
    },
    {
        path: '/u/account',
        name: 'Account',
        component: Account,
        props: true
    },
    {
        path: '/u/cv',
        name: 'Cv',
        component: Cv,
    },
    {
        path: '/u/my-applications',
        name: 'MyApplications',
        component: MyApplications,
    },
    {
        path: '/u/my-messages',
        name: 'MyMessages',
        component: MyMessages,
        props: true
    },

    /**
     * Employer Routes
     */
    {
        path: '/e/jobs',
        name: 'Jobs',
        component: Jobs,
        props: true
    },
    {
        path: '/e/dashboard',
        name: 'EmployerDashboard',
        component: EmployerDashboard,
        props: true
    },
]
