import axios from 'axios';
// Create axios instance
const service = axios.create({
    baseURL: base_url,
    timeout: 10000, // Request timeout
});


service.interceptors.request.use(
    config => {
        /*if(getDeviceHash()){
            config.headers['Device-hash'] = getDeviceHash(); // Set JWT token
        }*/
        return config;
    },
    error => {
        // Do something with request error
        Promise.reject(error);
    }
);

// response pre-processing
service.interceptors.response.use(
    response => {
        return response.data;
    },
    (error, data) => {
        /* if(error.response && error.response.data.message){
             if(error.response.data.message == 'Unauthenticated.'){
                 removeToken();
                 router.push('/login');
             }
             if(!(error.response.headers.showfronterror && error.response.headers.showfronterror == "0")){
                 Message({
                     message: error.response.data.message,
                     type: 'error',
                     duration: 5 * 1000
                 })
             }

         }else{
             let message = error.message;
             if(error.response){
                 if (error.response.data && error.response.data.errors) {
                     message = error.response.data.errors;
                 } else if (error.response.data && error.response.data.error) {
                     message = error.response.data.error;
                 }
             }

             if(message == 'Unauthenticated.'){
                 removeToken();
                 router.push('/login');
             }
             if(!(error.response.headers.showfronterror && error.response.headers.showfronterror == "0")) {
                 Message({
                     message: message,
                     type: 'error',
                     duration: 5 * 1000,
                 });
             }
         }*/
        return Promise.reject(error);
    },
);

export default service;
