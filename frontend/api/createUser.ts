import axios from '@/libs/request';

export type UserRegisterDataType = {
  name: string;
  email: string;
  password: string;
  passwordConfirmation: string;
}

export default (data: UserRegisterDataType) => {
  return axios({
    method: 'post',
    url: `/register`,
    data
  });
}
