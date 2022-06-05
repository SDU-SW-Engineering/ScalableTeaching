import SurveyProgressBar from "./SurveyProgressBar";
import { useState } from "react";

export default function SurveyMultiSelectionField(props) {
    const values = props.responses.reduce((previous, current) => {
        let reduced = current.values.reduce((previousInner, currentInner) => {
            if (currentInner.value in previousInner)
                previousInner[currentInner.value]++;
            else previousInner[currentInner.value] = 1;

            return previousInner;
        }, {});

        for (const [key, value] of Object.entries(reduced)) {
            if (key in previous) previous[key] = previous[key] + value;
            else previous[key] = value;
        }

        return previous;
    }, {});

    const comments = props.responses
        .reduce((previous, current) => {
            return [
                ...previous,
                ...current.values
                    .filter((x) => x.extras !== null)
                    .map((x) => x.extras),
            ];
        }, [])
        .sort();

    const [showCommentsFor, setShowCommentsFor] = useState([]);

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
                      <div key={item.id}>
                          <div
                              className={
                                  "text-gray-200 hover:bg-gray-600 rounded-md py-1.5 flex justify-between mt-1 px-1"
                              }
                          >
                              <span>
                                  {item.name}{" "}
                                  {item.allow_input &&
                                      !showCommentsFor.includes(item.id) && (
                                          <a
                                              onClick={() =>
                                                  setShowCommentsFor([
                                                      ...showCommentsFor,
                                                      item.id,
                                                  ])
                                              }
                                              className={
                                                  "text-lime-green-400 cursor-pointer"
                                              }
                                          >
                                              Show comments ({comments.length})
                                          </a>
                                      )}
                                  {item.allow_input &&
                                      showCommentsFor.includes(item.id) && (
                                          <a
                                              onClick={() =>
                                                  setShowCommentsFor(
                                                      showCommentsFor.filter(
                                                          (c) => c !== item.id
                                                      )
                                                  )
                                              }
                                              className={
                                                  "text-lime-green-400 cursor-pointer"
                                              }
                                          >
                                              Hide comments
                                          </a>
                                      )}
                              </span>
                              <SurveyProgressBar
                                  max={props.responses.length}
                                  amount={values[item.id]}
                              />
                          </div>
                          {item.allow_input &&
                              showCommentsFor.includes(item.id) && (
                                  <ul>
                                      {comments.map((comment, i) => (
                                          <li
                                              className={
                                                  "text-gray-200 text-sm ml-4 mb-0.5"
                                              }
                                              key={i}
                                          >
                                              <span className={"text-gray-400"}>
                                                  {i + 1}.
                                              </span>{" "}
                                              {comment}
                                          </li>
                                      ))}
                                  </ul>
                              )}
                      </div>
                  ))}
        </div>
    );
}
