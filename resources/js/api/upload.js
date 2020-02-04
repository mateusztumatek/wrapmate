import request from '../utilies/request';
export function upload(data, path = 'default') {
    return request({
        url: base_url+'/upload/'+path,
        method: 'post',
        data: data
    })
}
