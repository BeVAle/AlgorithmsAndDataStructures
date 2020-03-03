document.querySelector('.bubbleSort').onclick = function (event) {
    sendData("bubbleSort");
};

document.querySelector('.selectSort').onclick = function (event) {
    sendData("selectSort");
};

document.querySelector('.insertSort').onclick = function (event) {
    sendData("insertSort");
};

document.querySelector('.quickSort').onclick = function (event) {
    sendData("quickSort");
};

document.querySelector('.radixSort').onclick = function (event) {
    sendData("radixSort");
};


function sendData(sort = "") {
    postData('/ru/sortBubble', document.querySelector("#" + sort + "_begin").value, sort)
        .then(function (response) {
            console.log(response);
            document.querySelector("#" + sort + "_finish").value = response;
        })
        .catch(error => console.error(error));
}


function postData(url = '', data = "", sort = "") {
    return fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded',},
        body: "sort=" + sort + "&sequence=" + data,
    })
        .then(response => response.json());
}