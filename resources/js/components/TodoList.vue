<template>
    <div>    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1 class="text-center">todos</h1></div>

                    <div class="card-body">                    
                        <new-todo @created_1="add" @created_2="TaskAll"></new-todo>
                        <todo @created_1="TaskAll" v-for="todos in todoItems" :todoItems="todos" :list="list" :key="todos.id"></todo>
                        <div v-if="todoItems.length>0" class="row border-top mt-2 pt-2">
                            <div class="col-3">
                                {{ TaskRemain }} 
                            </div>
                            <div class="col-6 text-center">
                                <a @click="list = 'all'" type="button" class="btn text-decoration-none" :class="classes_1">All</a>
                                <a @click="list = 'incomplete'" type="button" class="btn text-decoration-none" :class="classes_2">Active</a>
                                <a @click="list = 'complete'" type="button" class="btn text-decoration-none" :class="classes_3">Completed</a>
                            </div>
                            <div class="col-3 text-right">
                                <a @click="destroy" class="btn text-muted text-decoration-none">Clear Completed</a>
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

        props: ['todo'],

        data(){
            return {
                todoItems: [],
                counts: 0,
                list: 'all',
                id: 'complete'
            }
        },

        created(){
            this.todoItems = this.todo;
        },

        methods: { 
            destroy(){
                axios.delete(`/todos/${this.id}`)
                .catch(err => {
                    alert(err.response.data.message);
                })
                .then(({data})=>{
                    this.todoItems = data.todoList;                 
                });
            },           
            add(NewTask){
                this.todoItems.push(NewTask);
            },

            TaskAll(todoList){
                this.todoItems = todoList;
            }
        },

        computed: {
            TaskRemain(){
                let counts = 0
                for (let index = 0; index < this.todoItems.length; index++) {
                    if(this.todoItems[index]['complete'] != 'Yes'){
                        counts++
                    }
                    
                }
                return counts + " " + (counts > 1 ? 'items left' : 'item left');
            },

            classes_1(){
                return[ 
                    this.list == 'all' ? 'font-weight-bold text-success' : 'text-muted'
                ]
            },

            classes_2(){
                return[ 
                    this.list == 'incomplete' ? 'font-weight-bold text-success' : 'text-muted'
                ]
            },

            classes_3(){
                return[ 
                    this.list == 'complete' ? 'font-weight-bold text-success' : 'text-muted'
                ]
            }
        }
    }
</script>