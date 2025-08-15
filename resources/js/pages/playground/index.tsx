import AppLayout from '@/layouts/app-layout';
import AuthLayout from '@/layouts/auth-layout';

type Props = PageProps<{
  data: unknown;
}>;

function Index({ data, user }: Props) {
  const Layout = user ? AppLayout : AuthLayout;

  return (
    <Layout title="Playground" description="Playground for testing and experimenting with features">
      <pre>{JSON.stringify(data, null, 2)}</pre>
    </Layout>
  );
}

export default Index;
