import AppLayout from '@/layouts/app-layout';

type Props = {
  team: App.Data.TeamData;
};

function Show({ team }: Props) {
  return (
    <AppLayout>
      <pre>{JSON.stringify(team, null, 2)}</pre>
    </AppLayout>
  );
}

export default Show;
