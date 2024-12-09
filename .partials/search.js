// Utility function to sanitize URL
function sanitizeURL(url) {
    const urlPattern = /^(https?:\/\/[^\s/$.?#].[^\s]*)$/i;
    return urlPattern.test(url) ? encodeURI(url) : '#';  // Fallback to '#' if invalid
}

// Function to escape potentially dangerous HTML characters
function escapeHTML(str) {
    const element = document.createElement('div');
    if (str) {
        element.innerText = str;
        element.textContent = str;
    }
    return element.innerHTML;
}

async function searchDuckDuckGo() {
    const query = searchInput.value;

    if (query.length === 0) {
        searchResults.innerHTML = ''; // Clear results if no query
        return;
    }

    try {
        const response = await fetch(`https://api.duckduckgo.com/?q=${encodeURIComponent(query)}&format=json`);
        const data = await response.json();

        if (data.Results && data.Results.length > 0) {
            // Using a safer method to generate HTML
            const resultsHTML = data.Results.map(result => {
                const sanitizedURL = sanitizeURL(result.FirstURL);
                const sanitizedTitle = escapeHTML(result.Text);  // Escape any HTML tags in title
                return `<li><a href="${sanitizedURL}" target="_blank">${sanitizedTitle}</a></li>`;
            }).join('');

            // Set the results with sanitized HTML
            searchResults.innerHTML = resultsHTML;
        } else {
            searchResults.innerHTML = '<li>No results found.</li>';
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// const searchInput = document.getElementById('ahz-duckgo');
// const searchResults = document.getElementById('searchResults');

// searchInput.addEventListener('input', debounce(searchDuckDuckGo, 500));

// async function searchDuckDuckGo() {
//     const query = searchInput.value;

//     if (query.length === 0) {
//         searchResults.innerHTML = '';
//         return;
//     }

//     try {
//         const response = await fetch(`https://api.duckduckgo.com/?q=${query}&format=json`);
//         const data = await response.json();

//         if (data.Results && data.Results.length > 0) {
//             const resultsHTML = data.Results.map(result => `<li>${result.FirstURL}</li>`).join('');
//             searchResults.innerHTML = resultsHTML;
//         } else {
//             searchResults.innerHTML = '<li>No results found.</li>';
//         }
//     } catch (error) {
//         console.error('Error:', error);
//     }
// }

// // Debounce function to delay search while typing
// function debounce(func, delay) {
//     let timer;
//     return function () {
//         clearTimeout(timer);
//         timer = setTimeout(func, delay);
//     };
// }
