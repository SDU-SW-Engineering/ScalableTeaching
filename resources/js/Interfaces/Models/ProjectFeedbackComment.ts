import { CodeLine } from "../CodeLine";
import { User } from "./User";
import { ProjectFeedback } from "./ProjectFeedback";

export interface ProjectFeedbackComment {
    id: number;
    code: CodeLine[];
    code_all: CodeLine[];
    line: number;
    feedback: ProjectFeedback;
    comment: string;
    filename: string;
    time_since: string;
    reviewer_feedback: string;
    reviewed_time_since: string;
    reviewer: User;
    owner: string;
}
