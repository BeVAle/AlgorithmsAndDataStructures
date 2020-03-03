document.querySelector('.rabinSearch_search').onclick = function (event) {
    sendDataSearch("rabinSearch");
};

document.querySelector('.MooreSearch_search').onclick = function (event) {
    sendDataSearch("MooreSearch");
};

document.querySelector('.KMPSearch_search').onclick = function (event) {
    sendDataSearch("KMPSearch");
};


function sendDataSearch(sort = "") {
    let text = document.querySelector("#" + sort + "_text").value;
    let pattern = document.querySelector("#" + sort + "_pattern").value;

    postDataSearch( text,pattern, sort)
        .then(function (response) {
            console.log(response);
            document.querySelector("#" + sort + "_finish").value = response;
        })
        .catch(error => console.error(error));
}


function postDataSearch( text = "", pattern = "" ,sort = "") {
    return fetch('/ru/do-search', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: "searchType=" + sort + "&text=" + text+ "&pattern=" + pattern,
    })
        .then(response => response.json());
}