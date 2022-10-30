import { GroupedSubTaskListGroup } from "./GroupedSubTaskListGroup";

export interface GroupedSubTaskList {
    gradeDelegations: [
        {
            by: string;
            identifier: string;
        }
    ];
    list: [GroupedSubTaskListGroup];
}
