import Dashboard from './components/admin/Dashboard'
import PostList from './components/admin/posts/PostList'
import CreatePost from './components/admin/posts/CreatePost'
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
    }
]