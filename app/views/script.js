const query1 = (query, all) =>
    (all ? document.querySelectorAll(query) : document.querySelector(query));

const sendMsg = (event) => {
    event.preventDefault();
    post('/messages', {
        from: sender,
        to: recipient,
        body: query1('#content').value,
    }, (response) => {
        query1('#content').value = ""; //Clear the message text field
    })
}