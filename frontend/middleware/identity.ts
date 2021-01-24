
import identity from '@/api/identity';

export default async ({redirect}) => {
  await identity()
    .then((response) => {
      if (!response.user) {
        redirect('/sessions/new');
      }
    })
    .catch(() => {
      redirect('/sessions/new');
      return;
    });
};
