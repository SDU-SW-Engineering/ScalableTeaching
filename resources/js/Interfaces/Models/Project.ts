export interface Project {
    id: number;
    ownable_type: "App\\Models\\Group" | "App\\Models\\User";
    status: "finished" | "overdue";
}
