import request from '../utilies/request';
export function getBrands() {
    return request({
        url: base_url+'/api/brands',
        method: 'get',
    })
}
