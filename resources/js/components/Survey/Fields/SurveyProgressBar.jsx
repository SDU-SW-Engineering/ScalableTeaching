export default function SurveyProgressBar(props) {
    return (
        <div className={"flex justify-center items-center flex-shrink-0"}>
            <span className="flex-shrink-0 mr-2 text-light">
                {props.amount === undefined ? 0 : props.amount}
            </span>
            <div className="w-48 bg-gray-200 rounded-full h-4 dark:bg-gray-700 mr-2 text-center">
                <div
                    style={{
                        width: "fit-content",
                        minWidth:
                            props.amount === undefined
                                ? 0
                                : (props.amount / props.max) * 100 + "%",
                    }}
                    className={
                        "h-4 rounded-full text-gray-900 text-xs bg-lime-green-400 px-0.5"
                    }
                >
                    {props.amount === undefined
                        ? 0
                        : Number((props.amount / props.max) * 100).toFixed(2)}
                    %
                </div>
            </div>
            <span className="text-light text-lime-green-100">{props.max}</span>
        </div>
    );
}
