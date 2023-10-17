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
    profile_userLog: apiVersion + '/profile/list',

    //bookmark
    bookmarkCreate: apiVersion + '/bookmark/create',
    bookmarkList: apiVersion + '/bookmark/list',
    bookmarkSingle: apiVersion + '/bookmark/single',
    bookmarkUpdate: apiVersion + '/bookmark/update',
    bookmarkDelete: apiVersion + '/bookmark/delete',

    // Media
    media: apiVersion + '/media/upload',

}

export default apiRoutes;
