
import identity from '@/api/identity';

export default async ({redirect}) => {
  await identity()
    .then((response) => {
      if (response.user) {
        redirect('/');
      }
    }).catch(() => {

    })
};
