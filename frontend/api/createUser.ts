import axios from '@/libs/request';

export type UserRegisterDataType = {
  name: string;
  password: string;
  passwordConfirmation: string;
}

export default (data: UserRegisterDataType) => {
  return axios({
    method: 'get',
    url: `/hoge`,
    data
  });
}
