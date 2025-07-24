declare namespace App.Data {
  export type InertiaRequestData = {
    errors: Record<string, string | Array<string>>;
    user: App.Data.UserData | null;
    can: Array<string>;
    ziggy: Record<string, string | Array<string>>;
    sidebarOpen: boolean;
  };
  export type UserData = {
    name: string;
    email: string;
    avatar: string | null;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
  };
}
