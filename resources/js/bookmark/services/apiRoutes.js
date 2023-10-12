const apiVersion = '/api/user';

const apiRoutes = {

    // Authentication

    register: apiVersion + '/auth/register',
    login: apiVersion + '/auth/login',
    forget: apiVersion + '/auth/forget',
    reset: apiVersion + '/auth/reset',

    // Profile

    profile_details: apiVersion + '/profile/details',
    profile_update: apiVersion + '/profile/update',
    profile_password: apiVersion + '/profile/password',
    profile_logout: apiVersion + '/profile/logout',

    // Media

    media: apiVersion + '/media/upload',

}

export default apiRoutes;
