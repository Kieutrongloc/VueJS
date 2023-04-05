const apiUrl = import.meta.env.VITE_API_URL;

//Get answers
export const apiAnswers = {
    async fetchAnswers(questionId) {
      const answersResponse = apiUrl + '?folder=answers';
      const response = await fetch(answersResponse);
      const data = await response.json();
      return data;
    },
    getQuestions() {
      const data = localStorage.getItem('questions');
      return data ? JSON.parse(data) : null;
    }
};


  