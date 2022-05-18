import SurveyProgressBar from "./SurveyProgressBar";

export default function SurveyEnvironmentField(props) {
    const values = props.responses.reduce((previous, current) => {
        if (current.values.value in previous) previous[current.values.value]++;
        else previous[current.values.value] = 0;
        return previous;
    }, {});

    console.log(values);
    return (
        <div
            className={
                "bg-gray-900 shadow-md rounded-md py-2 px-3 mb-4 last:mb-0"
            }
        >
            <h2 className={"text-xl font-light flex items-center"}>
                <span className={"text-lime-green-300"}>
                    Environment Variable
                </span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-6 w-6 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    strokeWidth="2"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        d="M9 5l7 7-7 7"
                    />
                </svg>
                <span className={"text-gray-300"}>{props.field.question}</span>
            </h2>
        </div>
    );
}
