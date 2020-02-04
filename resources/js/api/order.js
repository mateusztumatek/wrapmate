import request from '../utilies/request';
export function storeOrder(data) {
    return request({
        url: base_url+'/orders',
        method: 'post',
        data: data
    })
}
