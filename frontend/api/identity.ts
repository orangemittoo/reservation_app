import axios from '@/libs/request';

export default () => {
  return axios({
    method: 'get',
    url: `/identity`
  });
}
