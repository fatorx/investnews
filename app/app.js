
let HOST = 'http://localhost:8007/api';
if (document.URL !== 'http://localhost:8081/') {
    HOST = 'https://api.edug.com.br/api';
}

console.log(document.URL)

const MESSAGE_RESPONSE_NOK = 'Network response was not ok ';
const MESSAGE_PROBLEM_FETCH = 'There was a problem with the fetch operation:';

async function fetchNews(keyword = '', category_id = '') {
    try {
        const response = await fetch(`${HOST}/news?keyword=${keyword}&category_id=${category_id}`);
        if (!response.ok) {
            throw new Error(MESSAGE_RESPONSE_NOK + response.statusText);
        }
        const newsData = await response.json();
        displayNews(newsData);
    } catch (error) {
        console.error(MESSAGE_PROBLEM_FETCH, error);
    }
}

function displayNews(newsData) {
    const newsContainer = document.getElementById('newsContainer');
    newsContainer.innerHTML = '';

    newsData.forEach(news => {
        const newsElement = document.createElement('div');
        newsElement.className = 'noticia';
        newsElement.innerHTML = `
                    <h2>${news.title}</h2>
                    <p>${news.content.substring(0, 100)}...</p>
                    <button class="view-item" onclick="viewNews(${news.id})">Acessar</button>
                    <button class="delete-item" onclick="confirmDeleteNews(${news.id})">Excluir</button>
                `;
        newsContainer.appendChild(newsElement);
    });
}

async function viewNews(id) {
    try {
        const response = await fetch(`${HOST}/news/${id}`);
        if (!response.ok) {
            throw new Error(MESSAGE_RESPONSE_NOK + response.statusText);
        }
        const news = await response.json();
        document.getElementById('detailsTitle').textContent = news.title;
        document.getElementById('detailsContent').textContent = news.content;
        document.getElementById('newsDetails').style.display = 'block';
    } catch (error) {
        console.error(MESSAGE_PROBLEM_FETCH, error);
    }
}

function hideNewsDetails() {
    document.getElementById('newsDetails').style.display = 'none';
}

async function searchNews() {
    const searchInput = document.getElementById('searchInput').value;
    const categorySelect = document.getElementById('categorySelect').value;
    await fetchNews(searchInput, categorySelect);
}

async function fetchCategories() {
    try {
        const response = await fetch(`${HOST}/categories`);
        if (!response.ok) {
            throw new Error(MESSAGE_RESPONSE_NOK + response.statusText);
        }
        const categoriesData = await response.json();
        populateCategorySelect(categoriesData);
    } catch (error) {
        console.error(MESSAGE_PROBLEM_FETCH, error);
    }
}

function populateCategorySelect(categoriesData) {
    const categorySelect = document.getElementById('categorySelect');
    const newsCategory = document.getElementById('newsCategory');
    categorySelect.innerHTML = '<option value="">Todas Categorias</option>';
    newsCategory.innerHTML = '';

    categoriesData.forEach(category => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        categorySelect.appendChild(option);
        newsCategory.appendChild(option.cloneNode(true));
    });
}

function showCategoryForm() {
    document.getElementById('categoryForm').style.display = 'block';
}

function hideCategoryForm() {
    document.getElementById('categoryForm').style.display = 'none';
}

function showNewsForm() {
    document.getElementById('newsForm').style.display = 'block';
}

function hideNewsForm() {
    document.getElementById('newsForm').style.display = 'none';
}

async function createCategory() {
    const categoryName = document.getElementById('categoryName').value;
    try {
        const response = await fetch(`${HOST}/categories`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({name: categoryName})
        });
        if (!response.ok) {
            throw new Error(MESSAGE_RESPONSE_NOK + response.statusText);
        }
        hideCategoryForm();
        fetchCategories(); // Refresh categories after adding a new one
    } catch (error) {
        console.error(MESSAGE_PROBLEM_FETCH, error);
    }
}

async function createNews() {
    const newsTitle = document.getElementById('newsTitle').value;
    const newsContent = document.getElementById('newsContent').value;
    const newsCategory = document.getElementById('newsCategory').value;
    try {
        const response = await fetch(`${HOST}/news`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({title: newsTitle, content: newsContent, category_id: newsCategory})
        });
        if (!response.ok) {
            throw new Error(MESSAGE_RESPONSE_NOK + response.statusText);
        }
        hideNewsForm();
        await fetchNews();
    } catch (error) {
        console.error(MESSAGE_PROBLEM_FETCH, error);
    }
}

async function confirmDeleteNews(id) {
    if (confirm("Tem certeza de que deseja excluir esta notícia?")) {
        await deleteNews(id);
    }
}

async function deleteNews(id) {
    try {
        const response = await fetch(`${HOST}/news/${id}`, {
            method: 'DELETE'
        });
        if (!response.ok) {
            throw new Error(MESSAGE_RESPONSE_NOK + response.statusText);
        }
        await fetchNews();
    } catch (error) {
        console.error(MESSAGE_PROBLEM_FETCH, error);
    }
}

window.onload = () => {
    fetchNews();
    fetchCategories();
};
