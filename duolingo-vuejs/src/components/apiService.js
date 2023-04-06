const apiUrl = import.meta.env.VITE_API_URL;

export const apiService = {
    async fetchUnit(userCurrentCourse) {
        const responseUnit = await fetch(apiUrl + '?folder=units&course_id=' + userCurrentCourse);
        const dataUnit = await responseUnit.json();
        localStorage.setItem('unit', JSON.stringify(dataUnit));
    },

    async fetchLesson(userCurrentCourse) {
        const responseLesson = await fetch(apiUrl + '?folder=lessons&course_id=' + userCurrentCourse);
        const dataLesson = await responseLesson.json();
        localStorage.setItem('lesson', JSON.stringify(dataLesson));
    },


    getQuestions() {
        const data = localStorage.getItem('questions');
        return data ? JSON.parse(data) : null;
    }
};
