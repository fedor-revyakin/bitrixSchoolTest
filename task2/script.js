let form;
let messageElements;

window.addEventListener("load", (event) => {
    messageElements = {
        "email": document.querySelector("#email"),
        "name": document.querySelector("#name"),
        "rating": document.querySelector("#rating"),
        "text": document.querySelector("#text"),
        "errorResult": document.querySelector("#errorResult"),
        "successResult": document.querySelector("#successResult"),
    }

    form = document.querySelector("#addCommentForm");

    const addCommentButton = document.querySelector("#addComment");
    addCommentButton.addEventListener("click", addComment);

    hideAllMessages();
});


async function addComment(event) {

    event.preventDefault();
    
    hideAllMessages();
    
    let response = await fetch('/addComment.php', {
        method: 'POST',
        body: new FormData(form),
    });

    if (response.ok) {

        let result = await response.json();

        printMessages(result.messages);

        if (result.success !== undefined) {
            if (result.success === true) {
                printMessages({"successResult": "Отзыв сохранен"});
            } else {
                printMessages({"errorResult": "Не удалось добавить отзыв"});
            }
        }
    
    } else {
        printErrorResult();
    }
}

function printMessages(messages = {}) {
    for (const key of Object.keys(messages)) {
        messageElements[key].innerHTML = messages[key];
        messageElements[key].style.display = 'block';
    }
}

function hideAllMessages() {
    for (const key of Object.keys(messageElements)) {
        messageElements[key].style.display = 'none';
    }
}
