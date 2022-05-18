import SurveyProgressBar from "./SurveyProgressBar";

export default function SurveySingleSelectionField(props) {
    const values = props.responses.reduce((previous, current) => {
        if (current.values.value in previous) previous[current.values.value]++;
        else previous[current.values.value] = 1;
        return previous;
    }, {});

    function environmentData() {
        let items = [];
        for (let v in values) {
            let amount = values[v];
            items.push(
                <div
                    className={
                        "text-gray-200 hover:bg-gray-600 rounded-md py-1.5 flex justify-between mt-1 px-1"
                    }
                    key={v}
                >
                    <span>{v}</span>
                    <SurveyProgressBar
                        max={Object.values(values).reduce((a, b) => a + b)}
                        amount={amount}
                    />
                </div>
            );
        }

        return items;
    }

    return (
        <div
            className={
                "bg-gray-900 shadow-md rounded-md py-2 px-3 mb-4 last:mb-0"
            }
        >
            <h2 className={"text-gray-300 text-xl font-light"}>
                {props.field.question}
            </h2>
            {props.field.type === "environment"
                ? environmentData()
                : props.field.items.map((item) => (
                      <div
                          className={
                              "text-gray-200 hover:bg-gray-600 rounded-md py-1.5 flex justify-between mt-1 px-1"
                          }
                          key={item.id}
                      >
                          <span>{item.name}</span>
                          <SurveyProgressBar
                              max={Object.values(values).reduce(
                                  (a, b) => a + b
                              )}
                              amount={values[item.id]}
                          />
                      </div>
                  ))}
        </div>
    );
}
