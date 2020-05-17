<template>
    <div>    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1 class="text-center">todos</h1></div>

                    <div class="card-body">                    
                        <new-todo @created="add"></new-todo>
                        <todo v-for="todos in todoItems" :todoItems="todos" :key="todos.id"></todo>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                {{ TaskRemain }} 
                            </div>
                            <div class="col-6 text-center">
                                <a href="" class="text-muted text-decoration-none">All |</a>
                                <a href="" class="text-muted text-decoration-none">| Active |</a>
                                <a href="" class="text-muted text-decoration-none">| Completed</a>
                            </div>
                            <div class="col-3 text-right">
                                <a href="" class="text-muted text-decoration-none">Clear Completed</a>
                            </div>
                        </div>
                    </div>               
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Todo from './Todo.vue';
import NewTodo from './NewTodo.vue';
    export default {
        components: {Todo, NewTodo},

        props: ['todo', 'todoremain'],

        data(){
            return {
                todoItems: [],
                count: 0,
            }
        },

        created(){
            this.todoItems = this.todo;
            this.count = this.todoremain.length;
        },

        methods: {            
            add(NewTask){
                this.todoItems.push(NewTask);
            },
        },

        computed: {
            TaskRemain(){
                return this.count + " " + (this.count > 1 ? 'items left' : 'item left');
            }
        }
    }
</script>