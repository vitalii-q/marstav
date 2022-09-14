let sidebar = document.getElementById('sidebar');
let chat = document.getElementById('chat');
chat.style.height = sidebar.getBoundingClientRect().height -110 + 'px';

let chat_dialogs = document.getElementById('chat_dialogs');
chat_dialogs.style.height = sidebar.getBoundingClientRect().height -110 -45 -39 -40 + 'px';

let chat_right = document.getElementById('chat_right');
chat_right.style.height = sidebar.getBoundingClientRect().height -134 + 'px';
console.log(chat_right);
chat_right.scrollTop = chat_right.scrollHeight;

//let chat_header = document.getElementById('chat_header');
//let chat_dialog = document.getElementById('chat_dialog');
//chat_dialog.style.height = chat.getBoundingClientRect().height -70 -148 + 'px';
