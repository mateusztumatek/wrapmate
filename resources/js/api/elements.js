import request from '../utilies/request';
export function getElements(params) {
    return request({
        url: base_url+'/elements',
        method: 'get',
        params: params
    })
}
