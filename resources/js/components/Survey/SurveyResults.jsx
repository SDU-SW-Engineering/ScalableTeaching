import React, {useEffect, useState} from 'react'
import SurveyList from "./SurveyList";
import SurveyDetails from "./SurveyDetails";
import axios from "axios";

export default function SurveyResults() {

    const [selectedSurvey, setSelectedSurvey] = useState(0)

    const [surveys, setSurveys] = useState([])

    useEffect(() => {
        axios.get('/surveys/all').then(response => {
            setSurveys(response.data);
        })
    }, [])

    return <>
        {selectedSurvey === 0 ? <SurveyList surveys={surveys} setSurvey={setSelectedSurvey}/> : <SurveyDetails selectedSurvey={selectedSurvey} setSurvey={setSelectedSurvey} surveys={surveys}/>}
    </>
}
