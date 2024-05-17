const searchInput = document.getElementById('ahz-duckgo');
const searchResults = document.getElementById('searchResults');

searchInput.addEventListener('input', debounce(searchDuckDuckGo, 500));

async function searchDuckDuckGo() {
    const query = searchInput.value;

    if (query.length === 0) {
        searchResults.innerHTML = '';
        return;
    }

    try {
        const response = await fetch(`https://api.duckduckgo.com/?q=${query}&format=json`);
        const data = await response.json();

        if (data.Results && data.Results.length > 0) {
            const resultsHTML = data.Results.map(result => `<li>${result.FirstURL}</li>`).join('');
            searchResults.innerHTML = resultsHTML;
        } else {
            searchResults.innerHTML = '<li>No results found.</li>';
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Debounce function to delay search while typing
function debounce(func, delay) {
    let timer;
    return function () {
        clearTimeout(timer);
        timer = setTimeout(func, delay);
    };
}
