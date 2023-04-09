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

    async fetchSkills() {
        const responseSkills = await fetch(apiUrl + '?folder=skills');
        const dataSkills = await responseSkills.json();
        return dataSkills;
    },

    async getRandomQuestions(unitId, lessonId, skillId, count) {
        const responseQuestion = await fetch(apiUrl + '?folder=questions&unit_id=' + unitId + '&lesson_id=' + lessonId + '&skill_id=' + skillId + '&count=' + count);
        const dataQuestion = await responseQuestion.json();
        return dataQuestion;
    },

    getQuestions() {
        const data = localStorage.getItem('questions');
        return data ? JSON.parse(data) : null;
    }
};
