const apiVersion = '/api/admin';

const apiRoutes = {

    // Authentication

    register: apiVersion + '/auth/register',
    login: apiVersion + '/auth/login',
    forgot: apiVersion + '/auth/forgot',
    reset: apiVersion + '/auth/reset',

    // Profile

    profile_details: apiVersion + '/profile/details',
    profile_update: apiVersion + '/profile/update',
    profile_password: apiVersion + '/profile/password',
    profile_logout: apiVersion + '/profile/logout',

}

export default apiRoutes;
