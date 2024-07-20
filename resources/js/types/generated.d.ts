declare namespace App.Data {
    export type CampaignComment = {
        name: string;
        comment: string;
        createdAt: string;
    };
    export type CampaignData = {
        id: string | null;
        title: string | null;
        description: string | null;
        goalAmount: number | null;
        currentAmount: number | null;
        startDate: string | null;
        endDate: string | null;
        status: App.Enums.CampaignEnum;
        priority: App.Enums.CampaignPriorityEnum;
        district: any | App.Data.DistrictData | null;
        cause: any | App.Data.CauseData | null;
        postedAt: string | null;
        postedBy: any | App.Data.UserData | null;
        media: any | any | null;
        comments: any;
        transactions: Array<App.Data.TransactionData>;
    };
    export type CauseData = {
        id: string | null;
        title: string | null;
        description: string | null;
    };
    export type DistrictData = {
        id: string | null;
        name: string | null;
        province: any | App.Data.ProvinceData | null;
    };
    export type OrganizationData = {
        id: string | null;
        name: string | null;
    };
    export type ProvinceData = {
        id: string | null;
        name: string | null;
    };
    export type RoleData = {
        id: string | null;
        name: string | null;
    };
    export type TransactionData = {
        id: string;
        name: string;
        amount: number;
        paymentMethod: App.Enums.CampaignPaymentMethodEnum;
        transactionId: string;
        createdAt: string;
    };
    export type UserData = {
        id: string | null;
        name: string | null;
        email: string | null;
        role: any | App.Data.RoleData | null;
        organization: any | App.Data.OrganizationData | null;
        isSuperAdmin: boolean;
    };
}
declare namespace App.Enums {
    export type CampaignEnum = "ACTIVA" | "PENDENTE" | "COMPLETA" | "SUSPENSA";
    export type CampaignPaymentMethodEnum = "M_PESA";
    export type CampaignPriorityEnum = "BAIXA" | "MEDIA" | "ALTA" | "URGENTE";
}
