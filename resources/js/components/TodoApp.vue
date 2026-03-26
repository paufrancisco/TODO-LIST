<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

const todos = ref([])
const newTitle = ref('')

onMounted(async () => {
  const res = await axios.get('/api/todos')
  todos.value = res.data
})

const remaining = computed(() =>
  todos.value.filter(t => !t.is_done).length
)

const addTodo = async () => {
  if (!newTitle.value.trim()) return

  const res = await axios.post('/api/todos', {
    title: newTitle.value
  })

  todos.value.unshift(res.data)
  newTitle.value = ''
}

const toggleTodo = async (todo) => {
  const res = await axios.put(`/api/todos/${todo.id}`, {
    is_done: !todo.is_done
  })

  todo.is_done = res.data.is_done
}

const deleteTodo = async (id) => {
  await axios.delete(`/api/todos/${id}`)
  todos.value = todos.value.filter(t => t.id !== id)
}
</script>

<template>
  <div class="container">
    <h2>Todo List</h2>
    <p>{{ remaining }} task(s) remaining</p>

    <div class="add-form">
      <input
        v-model="newTitle"
        @keyup.enter="addTodo"
        placeholder="Add a new task..."
      />
      <button @click="addTodo">Add</button>
    </div>

    <ul>
      <li
        v-for="todo in todos"
        :key="todo.id"
        :class="{ done: todo.is_done }"
      >
        <input
          type="checkbox"
          :checked="todo.is_done"
          @change="toggleTodo(todo)"
        />
        <span>{{ todo.title }}</span>
        <button class="delete-btn" @click="deleteTodo(todo.id)">Delete</button>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.container {
  max-width: 500px;
  margin: 40px auto;
  font-family: sans-serif;
}

.add-form {
  display: flex;
  gap: 8px;
  margin-bottom: 16px;
}

.add-form input {
  flex: 1;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border-bottom: 1px solid #eee;
}

li.done span {
  text-decoration: line-through;
  color: #aaa;
}

.delete-btn {
  margin-left: auto;
  background: #e74c3c;
  color: white;
  border: none;
  padding: 4px 10px;
  border-radius: 4px;
  cursor: pointer;
}
</style>