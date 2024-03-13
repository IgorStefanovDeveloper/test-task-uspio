document.addEventListener('DOMContentLoaded', function() {
    var input = document.querySelector('input[name="js-map"]');
    var suggestionsList =  document.querySelector('.suggestions-list');
    var maphistory =  document.querySelector('.map-history');

    var timeoutId;

    input.addEventListener('input', function() {
        clearTimeout(timeoutId);
        var inputValue = this.value.trim();

        // Если введено более 3 символов, отправляем AJAX запрос
        if (inputValue.length > 3) {
            timeoutId = setTimeout(function() {
                sendAjaxRequest(inputValue);
            }, 300);
        } else {
            suggestionsList.innerHTML = ''; // Очищаем список подсказок
        }
    });

    function sendAjaxRequest(inputValue) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '?action=help&query=' + inputValue, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    renderSuggestions(JSON.parse(xhr.responseText));
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };

        xhr.send();
    }

    function renderSuggestions(suggestions) {
        suggestionsList.innerHTML = ''; // Очищаем список подсказок

        if (suggestions.length > 0) {
            suggestions.forEach(function(item) {
                let li = document.createElement('li');
                li.textContent = item;
                li.addEventListener('click', function() {
                    input.value = item;
                    sendAjaxRequestForSaleAndUpdateList();
                    suggestionsList.innerHTML = ''; // Очищаем список подсказок
                });
                suggestionsList.appendChild(li);
            });
        }
    }

    function renderMapHistory(suggestions) {
        maphistory.innerHTML = ''; // Очищаем список подсказок

        if (suggestions.length > 0) {
            suggestions.forEach(function(item) {
                let li = document.createElement('li');
                li.textContent = item.address;
                maphistory.appendChild(li);
            });
        }
    }

    document.addEventListener('click', function(event) {
        if (!suggestionsList.contains(event.target)) {
            suggestionsList.innerHTML = '';
        }
    });

    function sendAjaxRequestForSaleAndUpdateList() {
        let xhrSale = new XMLHttpRequest();
        xhrSale.open('GET', '?action=save&address=' + input.value, true);
        xhrSale.send();

        let xhrUpdateList = new XMLHttpRequest();
        xhrUpdateList.open('GET', '?action=updatelist', true);

        xhrUpdateList.onreadystatechange = function() {
            if (xhrUpdateList.readyState === XMLHttpRequest.DONE) {
                if (xhrUpdateList.status === 200) {
                    renderMapHistory(JSON.parse(xhrUpdateList.responseText));
                } else {
                    console.error('Error:', xhrUpdateList.statusText);
                }
            }
        };

        xhrUpdateList.send();
    }
});
