import { useEffect, useState } from "react";
import SurveyQuestions from "./SurveyQuestions";
import SurveyResponses from "./SurveyResponses";
import SurveyListSmall from "./SurveyListSmall";
import axios from "axios";

export default function SurveyDetails(props) {
    const [tab, setTab] = useState(0);
    const [surveyDetails, setSurveyDetails] = useState(null);

    useEffect(() => {
        axios.get(`/surveys/${props.selectedSurvey}`).then((response) => {
            setSurveyDetails(response.data);
        });
    }, [props.selectedSurvey]);

    return (
        <div>
            <div className={"flex gap-4"}>
                <SurveyListSmall
                    selected={props.selectedSurvey}
                    setSurvey={props.setSurvey}
                    surveys={props.surveys}
                />
                <div className={"w-9/12"}>
                    <div className={"flex"}>
                        <a
                            onClick={() => setTab(1)}
                            className={
                                "px-2 py-1 flex cursor-pointer rounded-md items-center mr-2 " +
                                (tab === 0
                                    ? "text-gray-400 hover:bg-gray-600"
                                    : "text-white bg-gray-800")
                            }
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-5 w-5 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                strokeWidth="2"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            <span>Questions</span>
                        </a>
                        <a
                            onClick={() => setTab(0)}
                            className={
                                "px-2 py-1 flex cursor-pointer rounded-md items-center " +
                                (tab === 1
                                    ? "text-gray-400 hover:bg-gray-600"
                                    : "text-white bg-gray-800")
                            }
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-5 w-5 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                strokeWidth="2"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                                />
                            </svg>
                            <span>Responses</span>
                        </a>
                    </div>
                    {surveyDetails !== null ? (
                        tab === 1 ? (
                            <SurveyQuestions />
                        ) : (
                            <SurveyResponses survey={surveyDetails} />
                        )
                    ) : (
                        <div>Loading</div>
                    )}
                </div>
            </div>
        </div>
    );
}
