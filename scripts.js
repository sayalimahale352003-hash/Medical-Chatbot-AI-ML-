$(document).ready(function() {
    function getCurrentTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    function appendMessage(sender, text) {
        const timestamp = getCurrentTime();
        const messageElement = `
            <div class="message ${sender}">
                <div class="text">${text}</div>
                <span class="timestamp">${timestamp}</span>
            </div>
        `;
        $('#chat-body').append(messageElement);
        $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
    }

    $('#send-btn').click(function() {
        const userInput = $('#input-prompt').val().trim();
        if (userInput) {
            appendMessage('user', userInput);
            $('#input-prompt').val('');
            $('#loading-indicator').addClass('active');

            $.ajax({
                type: "POST",
                url: "/chat", // Ensure this URL is correct
                contentType: "application/json",
                data: JSON.stringify({ input: userInput }),
                success: function(response) {
                    $('#loading-indicator').removeClass('active');
                    appendMessage('bot', response.response);

                    // Save the search query to the server
                    $.post('/save_search_history.php', {
                        query: userInput
                    });
                },
                error: function(error) {
                    $('#loading-indicator').removeClass('active');
                    appendMessage('bot', 'Sorry, there was an error processing your request.');
                }
            });
        }
    });

    $('#input-prompt').keypress(function(event) {
        if (event.which === 13) {
            $('#send-btn').click();
        }
    });

    // Fetch and display search history on page load
    $.getJSON('/fetch_search_history.php', function(history) {
        history.forEach(function(entry) {
            appendMessage('user', entry.search_query + ' (History)');
        });
    });

    // Speech-to-Text feature
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    $('#microphone-btn').click(function() {
        recognition.start();
    });

    recognition.onresult = function(event) {
        const transcript = event.results[0][0].transcript;
        $('#input-prompt').val(transcript);
        $('#send-btn').click();
    };

    recognition.onspeechend = function() {
        recognition.stop();
    };

    recognition.onerror = function(event) {
        appendMessage('bot', 'Speech recognition error: ' + event.error);
    };
});
