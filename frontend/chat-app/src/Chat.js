import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Chat = () => {
  const [messages, setMessages] = useState([]);
  const [input, setInput] = useState('');

  useEffect(() => {
    axios.get('http://localhost/chat/backend/index.php?cls=login&mtd=get_label')
      .then(response => {
        if (response.data.status === 0) {
          setMessages(response.data.data);
        } else {
          console.error('No data found:', response.data.message);
        }
      })
      .catch(error => {
        console.error('Error fetching messages:', error);
      });
  }, []);

  const handleSend = () => {
    if (input.trim()) {
      const newMessage = { label: input };

      axios.post(
          'http://localhost/chat/backend/index.php?cls=login&mtd=set_label',
          JSON.stringify(newMessage),
          { headers: { 'Content-Type': 'application/json' }}
        )
        .then(response => {
          if (response.data.status === 0) {
            setMessages([...messages, response.data.data]);
            setInput('');
          } else {
            console.error('Error sending message:', response.data.message);
          }
        })
        .catch(error => {
          console.error('Error sending message:', error);
        });
    }
  };

  return (
    <div style={styles.container}>
      <div style={styles.chatBox}>
        {messages.map((message) => (
          <div key={message.id} style={styles.message}>
            <strong>{message.user.name}:</strong> {message.content}
          </div>
        ))}
      </div>
      <div style={styles.inputContainer}>
        <input
          type="text"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          placeholder="Type a message..."
          style={styles.input}
        />
        <button onClick={handleSend} style={styles.button}>
          Send
        </button>
      </div>
    </div>
  );
};

const styles = {
  container: {
    display: 'flex',
    flexDirection: 'column',
    width: '300px',
    margin: '0 auto',
    border: '1px solid #ccc',
    borderRadius: '5px',
    padding: '10px',
  },
  chatBox: {
    flex: 1,
    maxHeight: '200px',
    overflowY: 'auto',
    marginBottom: '10px',
    border: '1px solid #e0e0e0',
    padding: '10px',
    borderRadius: '5px',
    backgroundColor: '#f9f9f9',
  },
  message: {
    margin: '5px 0',
    padding: '8px',
    borderRadius: '5px',
    backgroundColor: '#e0e0e0',
  },
  inputContainer: {
    display: 'flex',
  },
  input: {
    flex: 1,
    padding: '8px',
    borderRadius: '5px',
    border: '1px solid #ccc',
    marginRight: '5px',
  },
  button: {
    padding: '8px 12px',
    borderRadius: '5px',
    border: 'none',
    backgroundColor: '#007bff',
    color: 'white',
    cursor: 'pointer',
  },
};

export default Chat;
