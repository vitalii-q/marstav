let sidebar = document.getElementById('sidebar');
let contacts = document.getElementById('contacts');
//let stub = document.getElementById('contacts_stub');
contacts.style.height = sidebar.getBoundingClientRect().height -110 + 'px';

let contacts_list = document.getElementById('contacts_list');
contacts_list.style.height = sidebar.getBoundingClientRect().height -110 -45 -39 -90 + 'px';

let contacts_right = document.getElementById('contacts_right');
contacts_right.style.height = sidebar.getBoundingClientRect().height -134 + 'px';
//stub.style.height = sidebar.getBoundingClientRect().height -134 + 'px!important';
contacts_right.scrollTop = contacts_right.scrollHeight;
