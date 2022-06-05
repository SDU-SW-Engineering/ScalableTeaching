import SurveyResults from "./Survey/SurveyResults";
import { createRoot } from 'react-dom/client';
import React from 'react';

if (document.getElementById("survey")) {
    const container = document.getElementById('survey');
    const root = createRoot(container);
    root.render(<React.StrictMode><SurveyResults/></React.StrictMode>)
}
