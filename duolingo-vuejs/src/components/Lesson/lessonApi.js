const apiUrl = import.meta.env.VITE_API_URL;

//Get answers
export const apiAnswers = {
    async fetchAnswers(questionId) {
      const apiUrl = apiUrl +'?question_id=' + questionId;
      const response = await fetch(apiUrl);
      const data = await response.json();
    //   localStorage.setItem('questions', JSON.stringify(data));
      return data;
    },
    getQuestions() {
      const data = localStorage.getItem('questions');
      return data ? JSON.parse(data) : null;
    }
};


  