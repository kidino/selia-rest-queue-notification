const API_BASE_URL = 'http://app-02.test/api';
const AUTH_TOKEN = 'Bearer 2|hrgDdbmpZLXtq6H23O37zUJpoHUgyRoruhZ2ZExq1392cbf4';

async function fetchVacancies() {
    const response = await fetch(`${API_BASE_URL}/vacancies`, {
        headers: {
            'Authorization': AUTH_TOKEN,
            'Accept': 'application/json'
        }
    });
    const vacancies = await response.json();
    const vacanciesList = document.getElementById('vacancies-list');
    vacancies.forEach(vacancy => {
        const vacancyItem = document.createElement('div');
        vacancyItem.className = 'vacancy-item';
        vacancyItem.innerHTML = `<a href="vacancy.html?id=${vacancy.id}" class="text-decoration-none text-dark">${vacancy.title}</a>`;
        vacanciesList.appendChild(vacancyItem);
    });
}

async function fetchVacancyDetails() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const response = await fetch(`${API_BASE_URL}/vacancies/${id}`, {
        headers: {
            'Authorization': AUTH_TOKEN,
            'Accept': 'application/json'
        }
    });
    const vacancy = await response.json();

    if (vacancy.error) {
        document.body.innerHTML = `<h1>${vacancy.error}</h1>`;
        return;
    }

    document.getElementById('title').textContent = vacancy.title;
    document.getElementById('description').textContent = vacancy.description;
    document.getElementById('apply-link').href = `apply.html?id=${vacancy.id}`;
}

async function submitApplication(event) {
    event.preventDefault();
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    const formData = new FormData(event.target);
    const response = await fetch(`${API_BASE_URL}/vacancies/${id}/apply`, {
        method: 'POST',
        headers: {
            'Authorization': AUTH_TOKEN,
            'Accept': 'application/json'
        },
        body: formData
    });

    const result = await response.json();
    if (response.ok) {
        alert('Application submitted successfully!');
        window.location.href = 'index.html';
    } else {
        alert(result.error || 'Failed to submit application.');
    }
}
