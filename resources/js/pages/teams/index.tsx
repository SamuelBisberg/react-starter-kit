import AppLayout from '@/layouts/app-layout';

type Props = {
  teams: App.Paginator<App.Data.TeamData>;
};

function Index({ teams }: Props) {
  return (
    <AppLayout>
      <pre>{JSON.stringify(teams, null, 2)}</pre>
    </AppLayout>
  );
}

export default Index;
