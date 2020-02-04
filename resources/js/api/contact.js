import request from '../utilies/request';
export function sendMessage(data) {
    return request({
        url: base_url+'/message',
        method: 'post',
        data: data
    })
}
