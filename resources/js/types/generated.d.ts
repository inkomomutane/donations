declare namespace App.Data {
    export type CampaignData = {
        id: string | null;
        title: string | null;
        description: string | null;
        content: string | null;
        goalAmount: number | null;
        currentAmount: number | null;
        startDate: string | null;
        endDate: string | null;
        status: App.Enums.CampaignEnum;
        priority: App.Enums.CampaignPriorityEnum;
        province: any | App.Data.ProvinceData | null;
        cause: any | App.Data.CauseData | null;
        postedAt: string | null;
        postedBy: any | App.Data.UserData | null;
    };
    export type CauseData = {
        id: string | null;
        title: string | null;
        description: string | null;
    };
    export type ProvinceData = {
        id: string | null;
        name: string | null;
    };
    export type UserData = {
        id: string | null;
        name: string | null;
        email: string | null;
    };
}
declare namespace App.Enums {
    export type CampaignEnum = "ACTIVE" | "PENDING" | "COMPLETED" | "SUSPENDED";
    export type CampaignPaymentMethodEnum = "M_PESA";
    export type CampaignPriorityEnum = "LOW" | "MEDIUM" | "HIGH" | "URGENT";
}
