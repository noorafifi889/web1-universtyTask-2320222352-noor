  var tasks = [];
  var currentFilter = 'all';
 
  function addTask() {
    var input = document.getElementById('taskInput');
    var text = input.value.trim();
 
    if (text === '') return;
 
    var newTask = {
      id: Date.now(),
      text: text,
      done: false
    };
 
    tasks.push(newTask);
    input.value = '';
    renderTasks();
  }
 
  function deleteTask(id) {
    tasks = tasks.filter(function(task) {
      return task.id !== id;
    });
    renderTasks();
  }
 
  function toggleTask(id) {
    tasks = tasks.map(function(task) {
      if (task.id === id) {
        task.done = !task.done;
      }
      return task;
    });
    renderTasks();
  }
 
  function clearCompleted() {
    tasks = tasks.filter(function(task) {
      return task.done === false;
    });
    renderTasks();
  }
 
  function setFilter(filter) {
    currentFilter = filter;
 
    document.getElementById('btn-all').classList.remove('active');
    document.getElementById('btn-active').classList.remove('active');
    document.getElementById('btn-completed').classList.remove('active');
    document.getElementById('btn-' + filter).classList.add('active');
 
    renderTasks();
  }
 
  function renderTasks() {
    var list = document.getElementById('taskList');
    var emptyState = document.getElementById('emptyState');
 
    var filtered = tasks.filter(function(task) {
      if (currentFilter === 'active') return task.done === false;
      if (currentFilter === 'completed') return task.done === true;
      return true;
    });
 
    if (filtered.length === 0) {
      emptyState.style.display = 'block';
    } else {
      emptyState.style.display = 'none';
    }
 
    list.innerHTML = '';
 
    filtered.forEach(function(task) {
      var item = document.createElement('div');
      item.className = 'task-item';
 
      item.innerHTML =
        '<input type="checkbox" class="task-checkbox" ' + (task.done ? 'checked' : '') + ' onchange="toggleTask(' + task.id + ')" />' +
        '<span class="task-text ' + (task.done ? 'done' : '') + '">' + task.text + '</span>' +
        '<button class="btn-delete" onclick="deleteTask(' + task.id + ')">✕</button>';
 
      list.appendChild(item);
    });
 
    var remaining = tasks.filter(function(t) { return t.done === false; }).length;
    document.getElementById('countNum').textContent = remaining;
  }
 
  document.getElementById('taskInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') addTask();
  });
 
  renderTasks();