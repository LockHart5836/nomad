<!-- Floating Tire Chatbot Button -->
<div id="chatbot-container">
    <!-- Floating Tire Button -->
    <button id="chatbot-toggle" class="chatbot-toggle" onclick="toggleChatbot()">
        <img src="{{ asset('images/tire.png') }}" alt="Chat with us" class="tire-icon">
    </button>

    <!-- Chatbot Side Panel -->
    <div id="chatbot-panel" class="chatbot-panel">
        <!-- Header -->
        <div class="chatbot-header">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <img src="{{ asset('images/tire.png') }}" alt="StacyGarage" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--accent);">
                <div>
                    <h3 style="margin: 0; font-size: 1.1rem; color: white;">StacyGarage Assistant</h3>
                    <p style="margin: 0; font-size: 0.75rem; color: rgba(255,255,255,0.7);">
                        <span class="status-dot"></span> Online
                    </p>
                </div>
            </div>
            <button onclick="toggleChatbot()" class="close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Chat Messages -->
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="message bot-message">
                <div class="message-avatar">
                    <img src="{{ asset('images/tire.png') }}" alt="Bot">
                </div>
                <div class="message-content">
                    <p>Hello! I'm your StacyGarage assistant. How can I help you today?</p>
                    <span class="message-time">Just now</span>
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div id="typing-indicator" class="typing-indicator" style="display: none;">
            <div class="message-avatar">
                <img src="{{ asset('images/tire.png') }}" alt="Bot">
            </div>
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Input Area -->
        <div class="chatbot-input">
            <input 
                type="text" 
                id="chatbot-input-field" 
                placeholder="Type your message..." 
                onkeypress="handleKeyPress(event)"
            >
            <button onclick="sendMessage()" class="send-btn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>
    #chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }

    .chatbot-toggle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: transparent;
        border: none;
        cursor: pointer; 
      
        transition: all 0.3s ease;
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    .chatbot-toggle:hover {
        transform: scale(1.1) rotate(360deg);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
    }

    .tire-icon {
        width: 50px;
        height: 50px;
        object-fit: contain;
        animation: spin 20s linear infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .chatbot-panel {
        position: fixed;
        bottom: 100px;
        right: 20px;
        width: 400px;
        height: 600px;
        background: rgba(26, 31, 46, 0.98);
        border: 1px solid rgba(164, 30, 52, 0.3);
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        display: none;
        flex-direction: column;
        backdrop-filter: blur(10px);
        animation: slideIn 0.3s ease;
    }

    .chatbot-panel.active {
        display: flex;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .chatbot-header {
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        padding: 1rem;
        border-radius: 1rem 1rem 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        margin-right: 0.25rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .close-btn {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s;
    }

    .close-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    .chatbot-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .chatbot-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chatbot-messages::-webkit-scrollbar-track {
        background: rgba(10, 14, 26, 0.5);
    }

    .chatbot-messages::-webkit-scrollbar-thumb {
        background: rgba(164, 30, 52, 0.5);
        border-radius: 3px;
    }

    .message {
        display: flex;
        gap: 0.75rem;
        animation: messageSlideIn 0.3s ease;
    }

    @keyframes messageSlideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }

    .message-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .bot-message .message-avatar {
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        padding: 5px;
    }

    .user-message {
        flex-direction: row-reverse;
    }

    .user-message .message-content {
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        align-items: flex-end;
    }

    .message-content {
        flex: 1;
        background: rgba(10, 14, 26, 0.6);
        padding: 0.75rem;
        border-radius: 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        max-width: 100%;
        overflow: hidden;
    }

    .message-content p {
        margin: 0;
        color: var(--fg);
        line-height: 1.5;
        word-wrap: break-word;
    }
    
    .message-content div {
        color: var(--fg);
        line-height: 1.6;
        word-wrap: break-word;
    }
    
    .message-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0.5rem 0;
    }

    .message-time {
        font-size: 0.7rem;
        color: var(--muted);
        opacity: 0.7;
    }

    .typing-indicator {
        display: flex;
        gap: 0.75rem;
        padding: 0 1rem;
    }

    .typing-dots {
        background: rgba(10, 14, 26, 0.6);
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        display: flex;
        gap: 0.25rem;
    }

    .typing-dots span {
        width: 8px;
        height: 8px;
        background: var(--accent);
        border-radius: 50%;
        animation: typing 1.4s infinite;
    }

    .typing-dots span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dots span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
            opacity: 0.7;
        }
        30% {
            transform: translateY(-10px);
            opacity: 1;
        }
    }

    .chatbot-input {
        display: flex;
        gap: 0.5rem;
        padding: 1rem;
        border-top: 1px solid rgba(164, 30, 52, 0.2);
        background: rgba(10, 14, 26, 0.8);
        border-radius: 0 0 1rem 1rem;
    }

    #chatbot-input-field {
        flex: 1;
        padding: 0.75rem;
        background: rgba(26, 31, 46, 0.8);
        border: 1px solid rgba(164, 30, 52, 0.3);
        border-radius: 0.5rem;
        color: var(--fg);
        font-size: 0.9rem;
    }

    #chatbot-input-field:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(164, 30, 52, 0.1);
    }

    .send-btn {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        border: none;
        border-radius: 0.5rem;
        color: white;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .send-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(164, 30, 52, 0.4);
    }

    .send-btn:active {
        transform: scale(0.95);
    }

    @media (max-width: 768px) {
        .chatbot-panel {
            width: calc(100vw - 40px);
            height: calc(100vh - 140px);
            right: 20px;
            left: 20px;
        }
    }
</style>

<script>
    function toggleChatbot() {
        const panel = document.getElementById('chatbot-panel');
        panel.classList.toggle('active');
        
        if (panel.classList.contains('active')) {
            document.getElementById('chatbot-input-field').focus();
        }
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }

    async function sendMessage() {
        const input = document.getElementById('chatbot-input-field');
        const message = input.value.trim();
        
        if (!message) return;
        
        // Add user message to chat
        addMessage(message, 'user');
        input.value = '';
        
        // Show typing indicator
        showTypingIndicator();
        
        try {
            // Get CSRF token
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            if (!csrfToken) {
                // Fallback to Laravel blade token
                csrfToken = '{{ csrf_token() }}';
            }
            
            console.log('Sending message to chatbot...', { message, csrfToken: csrfToken ? 'present' : 'missing' });
            
            // Send message to backend
            const response = await fetch('/chatbot/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });
            
            console.log('Response status:', response.status);
            
            // Check if response is ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Response data:', data);
            
            // Hide typing indicator
            hideTypingIndicator();
            
            // Add bot response
            if (data.success && data.response) {
                addMessage(data.response, 'bot');
            } else {
                addMessage(data.response || 'Sorry, I encountered an error. Please try again.', 'bot');
            }
        } catch (error) {
            hideTypingIndicator();
            console.error('Chatbot error:', error);
            addMessage('Sorry, I\'m having trouble connecting. Please try again later.', 'bot');
        }
    }

    function addMessage(text, type) {
        const messagesContainer = document.getElementById('chatbot-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}-message`;
        
        const time = new Date().toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
        
        if (type === 'user') {
            messageDiv.innerHTML = `
                <div class="message-content">
                    <p>${escapeHtml(text)}</p>
                    <span class="message-time">${time}</span>
                </div>
                <div class="message-avatar">
                    <i class="fas fa-user" style="color: white; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; height: 100%;"></i>
                </div>
            `;
        } else {
            // Process text to convert image URLs to actual images
            const formattedText = formatMessageWithImages(text);
            
            messageDiv.innerHTML = `
                <div class="message-avatar">
                    <img src="{{ asset('images/tire.png') }}" alt="Bot">
                </div>
                <div class="message-content">
                    ${formattedText}
                    <span class="message-time">${time}</span>
                </div>
            `;
        }
        
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function formatMessageWithImages(text) {
        // Check if text contains image URLs
        const imageRegex = /Image: (https?:\/\/[^\s\n]+)/g;
        let formattedText = escapeHtml(text);
        
        // Find all image URLs
        const matches = [...text.matchAll(imageRegex)];
        
        if (matches.length > 0) {
            matches.forEach(match => {
                const imageUrl = match[1];
                const escapedUrl = escapeHtml(imageUrl);
                const imageTag = `<div style="margin: 0.75rem 0;"><img src="${escapedUrl}" alt="Car Image" style="max-width: 100%; height: auto; border-radius: 0.5rem; border: 1px solid rgba(164, 30, 52, 0.3); box-shadow: 0 2px 8px rgba(0,0,0,0.2);" onerror="this.style.display='none'"></div>`;
                
                // Replace the text "Image: URL" with the actual image
                formattedText = formattedText.replace(escapeHtml(match[0]), imageTag);
            });
        }
        
        // Convert newlines to <br> for proper formatting
        formattedText = formattedText.replace(/\n/g, '<br>');
        
        return `<div>${formattedText}</div>`;
    }

    function showTypingIndicator() {
        document.getElementById('typing-indicator').style.display = 'flex';
        const messagesContainer = document.getElementById('chatbot-messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function hideTypingIndicator() {
        document.getElementById('typing-indicator').style.display = 'none';
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
</script>
