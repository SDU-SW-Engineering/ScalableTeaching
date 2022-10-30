import { SubTaskListItem } from "./SubTaskListItem";

export interface GroupedSubTaskListGroup {
    group: string;
    tasks: [SubTaskListItem];
}
