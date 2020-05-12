<template>
<div>    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1 class="text-center">todos</h1></div>

                <div class="card-body">                    
                    <form @submit.prevent="create">
                        <div class=" form-group">
                            <input name="name" id="name" v-on:keyup.enter="handleSubmit" v-on:keyup.esc="clearText" v-model="todoItem" type="text" class="form-control" placeholder="What needs to be done?">
                        </div>
                    </form> 
                    <ul class="list-group mb-3">
                        <li v-for="todos in todo" :key="todos.id" class="list-group-item d-flex justify-content-between align-items-center">
                            {{ todos.name }}
                        </li>
                    </ul>
                </div>               
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['todo'],
        data(){
            return {
                todoItem: ''
            }
        },
        methods: {
            create(){
                axios.post(`/todos`, {
                    name: this.name
                })
                .catch(error => {
                console.log(error);
            })
            },
            handleSubmit () {
                if (this.todoItem.trim()) {
                    this.todo.push({
                        name: this.todoItem
                    });
                    this.todoItem = ''
                }
            },
            clearText () {
                this.todoItem = ''
            }
        }
    }
</script>