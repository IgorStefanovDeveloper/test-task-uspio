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

    // Функция для отправки AJAX запроса
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

    // Функция для отображения подсказок
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

    // Функция для отображения подсказок
    function renderMapHistory(suggestions) {
        maphistory.innerHTML = ''; // Очищаем список подсказок

        if (suggestions.length > 0) {
            suggestions.forEach(function(item) {
                let li = document.createElement('li');
                li.textContent = item;
                li.addEventListener('click', function() {
                    input.value = item;
                    sendAjaxRequestForSaleAndUpdateList();
                    maphistory.innerHTML = ''; // Очищаем список подсказок
                });
                maphistory.appendChild(li);
            });
        }
    }

    // Проверка клика вне списка подсказок для скрытия списка
    document.addEventListener('click', function(event) {
        if (!suggestionsList.contains(event.target)) {
            suggestionsList.innerHTML = '';
        }
    });

    // Функция для отправки AJAX запросов при выборе элемента из списка
    function sendAjaxRequestForSaleAndUpdateList() {
        let xhrSale = new XMLHttpRequest();
        xhrSale.open('GET', '?ajax=sale&address=' + input.value, true);
        xhrSale.send();

        let xhrUpdateList = new XMLHttpRequest();
        xhrUpdateList.open('GET', '?ajax=updatelist', true);

        xhrUpdateList.onreadystatechange = function() {
            if (xhrUpdateList.readyState === XMLHttpRequest.DONE) {
                if (xhrUpdateList.status === 200) {
                    renderMapHistory(JSON.parse(xhr.responseText));
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };

        xhrUpdateList.send();
    }
});
