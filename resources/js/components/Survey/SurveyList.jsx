export default function SurveyList(props) {
    return <div className={"flex flex-col"}>
        {[...props.surveys].map(survey => <div key={survey.id} onClick={() => props.setSurvey(survey.id)}
                                           className={"flex first:rounded-t-lg cursor-pointer " +
                                               "last:rounded-b-lg w-full bg-gray-800 text-white px-4 py-4 border-b-2 items-center last:border-b-0 border-gray-600 hover:bg-gray-900"}>
            <div className={"flex flex-col w-2/5"}>
                <span className={"text-lg font-semibold"}>{survey.name}</span>
                <span className={"font-light flex items-center"}>
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 mr-1" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg> {survey.responses_count} responses</span>
            </div>
            <div className={"flex flex-col w-2/5"}>
                <span>Created 20 days ago</span>
                <span className={"flex font-light text-sm items-center"}>
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 mr-1 text-lime-green-300" fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor" strokeWidth="2">
                        <path strokeLinecap="round" strokeLinejoin="round"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg> Currently active</span>
            </div>
            <div className={"flex-grow flex justify-end"}>
                <svg xmlns="http://www.w3.org/2000/svg" className="h-7 w-7" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" strokeWidth="2">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </div>)}
    </div>
}
