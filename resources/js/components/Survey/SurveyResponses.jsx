import SurveyProgressBar from "./Fields/SurveyProgressBar";
import { useEffect } from "react";
import SurveySingleSelectionField from "./Fields/SurveySingleSelectionField";
import SurveyMultiSelectionField from "./Fields/SurveyMultiSelectionField";
import SurveyEnvironmentField from "./Fields/SurveyEnvironmentField";

export default function SurveyResponses(props) {
    function responsesForField(fieldId) {
        return props.survey.responses
            .map((responses) =>
                responses.response.filter(
                    (response) => response.field === fieldId
                )
            )
            .flat();
    }

    function renderField(field) {
        let responses = responsesForField(field.id);
        switch (true) {
            case field.allowed_selections === 1:
                return (
                    <SurveySingleSelectionField
                        responses={responses}
                        key={field.id}
                        field={field}
                    />
                );
            case field.allowed_selections === 0:
                return (
                    <SurveyMultiSelectionField
                        responses={responses}
                        key={field.id}
                        field={field}
                    />
                );
        }
    }

    return (
        <div className={"bg-gray-800 rounded-md p-4 mt-2"}>
            <div className={"flex justify-between items-start"}>
                <h2 className={"text-white font-thin text-4xl mb-4"}>
                    Responses
                </h2>
                <div className={"flex"}>
                    <a
                        className={
                            "mr-8 bg-gray-700 rounded-sm transition-colors hover:bg-gray-600 text-gray-300 px-4 py-1"
                        }
                    >
                        <span>Export</span>
                    </a>
                    <a
                        className={
                            "bg-lime-green-500 px-4 py-1 rounded-l-md text-white font-light"
                        }
                    >
                        Aggregated
                    </a>
                    <a
                        className={
                            "border border-gray-600 px-4 py-1 rounded-r-md hover:bg-gray-700 text-white font-light"
                        }
                    >
                        Individual
                    </a>
                </div>
            </div>
            {props.survey.fields.map((field) => renderField(field))}
        </div>
    );
}
