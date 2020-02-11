import request from '../utilies/request';
export function getBankLists() {
    return request({
        url: base_url+'/bank_lists',
        method: 'get',
    })
}
export function storeOrder(data) {
    return request({
        url: base_url+'/orders',
        method: 'post',
        data: data
    })
}
