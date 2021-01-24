import axios from '@/libs/request';

export type LoginDataType = {
  email: string;
  password: string;
}

export default (data: LoginDataType) => {
  return axios({
    method: 'post',
    url: `/login`,
    data
  });
}
