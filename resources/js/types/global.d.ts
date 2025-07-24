import type { route as routeFn } from 'ziggy-js';

declare global {
  const route: typeof routeFn;

  // Props for pages that use Inertia
  type PageProps<T = unknown> = App.Data.InertiaRequestData & T;

  // Props for authenticated pages
  type AuthenticatedPageProps<T = unknown> = App.Data.InertiaRequestData &
    T & {
      user: App.Data.UserData;
    };
}
