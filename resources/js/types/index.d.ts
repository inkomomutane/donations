import UserData = App.Data.UserData;

export interface PaginatedData {
    data: Array;
    links: Array;
    meta: {
        current_page?: number;
        first_page_url?: String;
        from?: Number;
        last_page?: number;
        last_page_url?: String;
        next_page_url?: String;
        path?: String;
        per_page?: Number;
        prev_page_url?: String;
        to?: Number;
        total?: Number;
    };
}

export enum FlahserType {
    success = "success",
    error = "error",
    warning = "warning",
    info = "info",
}

export enum OrderDataBy {
    asc = "asc",
    desc = "desc",
}
export interface Provinces extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.ProvinceData>;
}
export interface Causes extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.CauseData>;
}

export interface Districts extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.DistrictData>;
}

export interface Campaigns extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.CampaignData>;
}
//Organizations
export interface Organizations extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.OrganizationData>;
}
export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    userData: UserData
};
